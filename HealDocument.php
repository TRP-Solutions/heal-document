<?php
define('HEAL_ATTR_APPEND',1);
define('HEAL_ATTR_ESCAPE',2);

trait HealNodeParent {
	public function el($name, $attributes = [], $attr_options = 0){
		$element = static::createElementHeal($name);
		$this->appendChild($element);
		foreach($attributes as $name => $value){
			$element->at($name, $value, $attr_options);
		}
		return $element;
	}

	public function te($str){
		$this->appendChild(new DOMText($str));
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
			$escape = $options & HEAL_ATTR_ESCAPE;
			$value = $escape ? htmlspecialchars($value) : $value;

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