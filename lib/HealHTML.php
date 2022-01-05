<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
require_once __DIR__."/HealDocument.php";
define('HEAL_COMPARE_STRICT',1); // used in HealHTMLElement->options

trait HealHTMLNodeParent {
	protected static function createElementHeal($name){
		return new HealHTMLElement($name);
	}

	public function form($action = '', $method = 'get'){
		$attr = [];
		if(!empty($action)){
			$attr['action'] = $action;
			$attr['method'] = $method;
		} else {
			$attr['onsubmit'] = 'return false;';
		}
		return $this->el('form', $attr);
	}

	public function head($title = null, $charset = 'UTF-8'){
		$head = $this->el('head');
		if(!empty($title)) $head->el('title')->te($title);
		$head->el('meta',['charset'=>$charset]);
		return $head;
	}

	public function metadata($name, $content){
		return $this->el('meta',['name'=>$name,'content'=>$content]);
	}

	public function link($rel, $href){
		return $this->el('link',['rel'=>$rel,'href'=>$href]);
	}

	public function css($path){
		return $this->link('stylesheet',$path);
	}

	public function p($text, $text_options = 0){
		return $this->el('p')->te($text, $text_options);
	}

	public function a($href, $text = ''){
		$a = $this->el('a');
		if($href) $a->at(['href'=>$href]);
		if(!empty($text)) $a->te($text);
		return $a;
	}

	public function img($src, $alt){
		return $this->el('img',['src'=>$src,'alt'=>$alt]);
	}

	public function label($text = null, $for = null){
		$label = $this->el('label', isset($for) ? ['for'=>$for] : []);
		if(isset($for)) $label->at(['for'=>$for]);
		if(isset($text)) $label->te($text);
		return $label;
	}

	public function input($name, $value = null){
		$input = $this->el('input',['type'=>'text','name'=>$name,'id'=>$name]);
		if(isset($value)) $input->at(['value'=>$value]);
		return $input;
	}

	public function password($name){
		$input = $this->el('input', ['type'=>'password','name'=>$name,'id'=>$name]);
		if(isset($id)) $input->at(['id'=>$id]);
		return $input;
	}

	public function hidden($name, $value){
		return $this->el('input',['type'=>'hidden','name'=>$name,'value'=>$value,'id'=>$name]);
	}

	public function select($name){
		return $this->el('select',['name'=>$name,'id'=>$name]);
	}

	public function option($text, $value = null, $selected = false){
		$option = $this->el('option')->te($text);
		if($selected) $option->at(['selected']);
		if(isset($value)) $option->at(['value'=>$value]);
		return $option;
	}

	public function options($iterable, $selected = null, $compare_options = 0){
		$options = [];
		if(is_a($iterable, 'mysqli_result')){
			foreach($iterable as $row){
				$is_selected = isset($selected) && ($compare_options & HEAL_COMPARE_STRICT ? $selected === $row['id'] : $selected == $row['id']);
				$options[] = $this->option($row['name'],$row['id'],$is_selected);
			}
		} else {
			foreach($iterable as $value => $text){
				$is_selected = isset($selected) && ($compare_options & HEAL_COMPARE_STRICT ? $selected === $value : $selected == $value);
				$options[] = $this->option($text, $value, $is_selected);
			}
		}
		return $options;
	}

	public function checkbox($name, $checked = false, $value = 'on'){
		$input = $this->el('input',['type'=>'checkbox','name'=>$name,'id'=>$name]);
		if($checked) $input->at(['checked']);
		if($value != 'on') $input->at(['value'=>$value]);
		return $input;
	}

	public function radio($name, $value, $checked = false){
		$id = "$name:$value";
		$input = $this->el('input',['type'=>'radio','name'=>$name,'id'=>$id]);
		$input->at(['value'=>$value]);
		if($checked) $input->at(['checked']);
		return $input;
	}

	public function textarea($name, $content = ''){
		return $this->el('textarea',['name'=>$name,'id'=>$name])->te($content);
	}

	public function file($name, $multiple = false){
		$input = $this->el('input',['type'=>'file','id'=>$name]);
		if($multiple) $input->at(['multiple'])->at(['name'=>$name.'[]']);
		else $input->at(['name'=>$name]);
		return $input;
	}

	public function submit($value = null){
		$submit = $this->el('input',['type'=>'submit']);
		if(isset($value)) $submit->at(['value'=>$value]);
		return $submit;
	}
}

class HealHTML extends HealDocument {
	use HealHTMLNodeParent;

	public function __toString(){
		return "<!DOCTYPE html>".PHP_EOL.$this->saveHTML();
	}

	public function showHTML(){
		echo "<pre>";
		echo str_replace(" ","&nbsp;",htmlspecialchars($this->__toString()));
		echo "</pre>";
	}

	public function html($title, $language=null, $charset='UTF-8'){
		$html = $this->el('html');
		if($language) $html->at(['lang'=>$language]);
		return [$html->head($title, $charset),$html->el('body')];
	}
}

class HealHTMLElement extends HealElement {
	use HealHTMLNodeParent;
}