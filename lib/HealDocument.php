<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/

trait HealNodeParent {
	public function el($name, $attributes = [], $attr_options = 0){
		$element = static::createElementHeal($name);
		$this->appendChild($element);
		$element->at($attributes,$attr_options);
		return $element;
	}

	public function te($str, $break_on_newline = false){
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

	public function co($str){
		$this->appendChild(new DOMComment($str));
		// return $this to allow chaining
		return $this;
	}

	public function fr($str){
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

	protected static function createElementHeal($name){
		return new HealElement($name);
	}
}

class HealDocument extends DOMDocument {
	use HealNodeParent;

	private static $toStringFormat;

	public static function stringFormat($format){
		switch($format){
			case 'html': self::$toStringFormat = 'html'; break;
			default: self::$toStringFormat = 'xml';
		}
	}

	public function __toString(){
		if((!isset(self::$toStringFormat) || self::$toStringFormat == 'html') && strtolower($this->firstChild->nodeName) == 'html'){
			return "<!DOCTYPE html>".PHP_EOL.$this->saveHTML();
		} elseif(self::$toStringFormat=='html'){
			return $this->saveHTML();
		} else {
			$this->formatOutput = true;
			return $this->saveXML();
		}
	}
}

class HealElement extends DOMElement {
	use HealNodeParent;

	public function at($values, $append = false){
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