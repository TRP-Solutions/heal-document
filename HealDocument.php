<?php
define('HEAL_ATTR_APPEND',1); // used in HealElement->at
define('HEAL_ATTR_NO_ESCAPE',2); // used in HealElement->at
define('HEAL_COMPARE_STRICT',1); // used in HealHTMLElement->options
define('HEAL_TEXT_NL2BR',1); // used in HealElement->te

trait HealNodeParent {
	public function el($name, $attributes = [], $attr_options = 0){
		$element = static::createElementHeal($name);
		$this->appendChild($element);
		foreach($attributes as $name => $value){
			$element->at($name, $value, $attr_options);
		}
		return $element;
	}

	public function te($str, $text_options = 0){
		if($text_options | HEAL_TEXT_NL2BR){
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

	public function __toString(){
		$this->formatOutput = true;
		return $this->saveXML();
	}
}

class HealElement extends DOMElement {
	use HealNodeParent;

	public function at($name, $value = null, $options = 0){
		$attr = $this->ownerDocument->createAttribute($name);
		if(isset($value)){
			$no_escape = $options & HEAL_ATTR_NO_ESCAPE;
			$value = $no_escape ? $value : htmlspecialchars($value);

			$append = $options & HEAL_ATTR_APPEND;
			if($append && $this->hasAttribute($name)){
				$value = $this->getAttribute($name).' '.$value;
			}
			$attr->value = $value;
		} 
		$this->appendChild($attr);
		
		// return $this to allow chaining
		return $this;
	}
}
?>