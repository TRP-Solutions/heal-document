<?php
require_once __DIR__."/HealDocument.php";

define('HEAL_SVG_XLINK',1); // used in HealSVG->svg

trait HealSVGNodeParent {
	protected static function createElementHeal($name){
		return new HealSVGElement($name);
	}
}

class HealSVG extends HealDocument {
	use HealSVGNodeParent;

	public function __toString(){
		$this->formatOutput = true;
		return $this->saveXML();
	}

	public function svg($width, $height, $svg_options = 0){
		$attr = [
			'width'=>$width,
			'height'=>$height,
			'xmlns'=>'http://www.w3.org/2000/svg'
		];
		if($svg_options & HEAL_SVG_XLINK) $attr['xmlns:xlink'] = 'http://www.w3.org/1999/xlink';
		$svg = $this->el('svg', $attr);
		return $svg;
	}
}

class HealSVGElement extends HealElement {
	use HealSVGNodeParent;
}