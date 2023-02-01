<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/

trait HealNodeParent {
	public function el($name, $attributes = [], $append = false) : HealComponent {
		$element = static::createElementHeal($name);
		$this->appendChild($element);
		$element->at($attributes,$append);
		return $element;
	}

	public function te($str, $break_on_newline = false) : HealComponent {
		if($break_on_newline){
			$lines = explode("\n",$str);
			$firstline = true;
			foreach($lines as $line){
				if(!$firstline){
					$this->el('br');
				} else {
					$firstline = false;
				}
				$this->appendChild(new DOMText($line));
			}
		} else {
			$this->appendChild(new DOMText($str));
		}
		// return $this to allow chaining
		return $this;
	}

	public function co($str) : HealComponent {
		$this->appendChild(new DOMComment($str));
		// return $this to allow chaining
		return $this;
	}

	public function fr($str) : bool {
		$fragment = $this->ownerDocument->createDocumentFragment();
		if(@$fragment->appendXML($str)) {
			$this->appendChild($fragment);
			return true;
		}
		else {
			$this->te("Error in: \"".$str."\"");
			return false;
		}
	}

	public function __call($name, $arguments){
		return HealDocument::try_plugin($this, $name, $arguments);
	}

	protected static function createElementHeal($name) : HealComponent {
		return new HealElement($name);
	}
}

class HealDocument extends DOMDocument {
	use HealNodeParent;

	private static $plugins = [], $plugin_name_cache = [], $has_prefixed_plugins = false;

	private $toStringFormat;

	public function __construct($version = 'html', $encoding = ''){
		if($version == 'html'){
			$this->toStringFormat = 'html';
			parent::__construct('1.0',$encoding);
		} else {
			$this->toStringFormat = 'xml';
			parent::__construct($version, $encoding);
		}
	}

	public function __toString(){
		$this->formatOutput = true;
		if($this->toStringFormat == 'html'){
			if(isset($this->firstChild->nodeName) && strtolower($this->firstChild->nodeName) == 'html'){
				return "<!DOCTYPE html>".PHP_EOL.$this->saveHTML();
			} else {
				return $this->saveHTML();
			}
		} else {
			return $this->saveXML();
		}
	}

	public static function register_plugin($classname, $prefix = null){
		if(!class_exists($classname)){
			throw new \Exception("HealDocument can't find class '$classname'");
		}
		if(!is_subclass_of($classname, 'HealPluginInterface')){
			throw new \Exception("HealDocument can't register plugin '$classname', because it doesn't implement HealPluginInterface or extend the HealPlugin abstract class.");
		}

		if(isset($prefix)){
			self::$has_prefixed_plugins = true;
			self::$plugins[$prefix] = $classname;
		} else {
			self::$plugins[] = $classname;
		}
		if(!empty(self::$plugin_name_cache)){
			self::$plugin_name_cache = [];
		}
	}

	public static function try_plugin($parent, $fullname, $arguments){
		if(isset(self::$plugin_name_cache[$fullname])){
			return self::$plugin_name_cache[$fullname]::create($parent, $fullname, ...$arguments);
		}
		if(self::$has_prefixed_plugins){
			$split_name = explode('_',$fullname,2);
			if(count($split_name) == 2){
				list($prefix,$name) = $split_name;
			} else {
				$prefix = null;
				$name = $split_name[0];
			}
			if(!empty($prefix) && isset(self::$plugins[$prefix])){
				$classname = self::$plugins[$prefix];
				if($classname::can_create($name)){
					self::$plugin_name_cache[$name] = $classname;
					return $classname::create($parent, $name, ...$arguments);
				}
			}
		}
		foreach(self::$plugins as $plugin){
			if($plugin::can_create($fullname)){
				self::$plugin_name_cache[$fullname] = $plugin;
				return $plugin::create($parent, $fullname, ...$arguments);
			}
		}
	}
}

class HealElement extends DOMElement implements HealComponent {
	use HealNodeParent;

	public function at($values, $append = false) : HealComponent {
		foreach($values as $name => $value){
			if(is_numeric($name)){
				$attr = $this->ownerDocument->createAttribute($value);
			} else {
				$attr = $this->ownerDocument->createAttribute($name);
				if(isset($value)){
					$value = htmlspecialchars($value);

					if($append && $this->hasAttribute($name)){
						$value = $this->getAttribute($name).' '.$value;
					}
					$attr->value = $value;
				} else {
					if($append && $this->hasAttribute($name)){
						continue;
					}
				}
			}
			$this->appendChild($attr);
		}

		// return $this to allow chaining
		return $this;
	}
}

interface HealComponent {
	public function el($name, $attributes = [], $append = false) : HealComponent;
	public function at($values, $append = false) : HealComponent;
	public function te($str, $break_on_newline = false) : HealComponent;
	public function co($str) : HealComponent;
	public function fr($str) : bool;
}

interface HealPluginInterface {
	public static function can_create($name) : bool;
	public static function create($parent, $name, ...$arguments) : HealComponent;
}

abstract class HealPlugin implements HealPluginInterface, HealComponent {
	public static function can_create($name) : bool{
		return method_exists(static::class, $name);
	}

	public static function create($parent, $name, ...$arguments) : HealComponent {
		if(method_exists(static::class, $name)){
			$object = static::$name($parent, ...$arguments);
			if(is_a($object, static::class) && !isset($object->primary_element)){
				$object->primary_element = $parent;
			}
			return $object;
		} else {
			throw new \Exception("HealPlugin failed to find method '$name'");
		}
	}

	protected $primary_element;

	public function el($name, $attributes = [], $append = false) : HealComponent {
		return $this->primary_element->el($name, $attributes, $append);
	}

	public function at($values, $append = false) : HealComponent {
		return $this->primary_element->at($values, $append);
	}
	public function te($str, $break_on_newline = false) : HealComponent {
		return $this->primary_element->te($str, $break_on_newline);
	}
	public function co($str) : HealComponent {
		return $this->primary_element->co($str);
	}
	public function fr($str) : bool {
		return $this->primary_element->fr($str);
	}
}
