<?php
require_once __DIR__."/HealDocument.php";

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

	public function head($title, $charset='UTF-8'){
		$head = $this->el('head');
		$head->el('title')->te($title);
		$head->el('meta',['charset'=>$charset]);
		return $head;
	}

	public function metadata($name, $content){
		return $this->el('meta',['name'=>$name,'content'=>$content]);
	}

	public function link($rel, $href, $attr = []){
		return $this->el('link',['rel'=>$rel,'href'=>$href]+$attr);
	}

	public function css($path){
		return $this->link('stylesheet',$path);
	}

	public function p($text){
		return $this->el('p')->te($text);
	}

	public function a($href, $text){
		return $this->el('a', ['href'=>$href])->te($text);
	}

	public function label($text = null, $for = null){
		$label = $this->el('label', isset($for) ? ['for'=>$for] : []);
		if(isset($for)) $label->at('for',$for);
		if(isset($text)) $label->te($text);
		return $label;
	}

	public function input($name, $id = null, $value = null){
		$input = $this->el('input',['type'=>'text','name'=>$name]);
		if(isset($id)) $input->at('id',$id);
		if(isset($value)) $input->at('value', $value, HEAL_ATTR_ESCAPE);
		return $input;
	}

	public function password($name, $id = null){
		$input = $this->el('input', ['type'=>'password','name'=>$name]);
		if(isset($id)) $input->at('id',$id);
		return $input;
	}

	public function hidden($name, $value){
		return $this->el('input',['type'=>'hidden','name'=>$name,'value'=>$value], HEAL_ATTR_ESCAPE);
	}

	public function select($name, $id = null){
		$select = $this->el('select',['name'=>$name]);
		if(isset($id)) $select->at('id',$id);
		return $select;
	}

	public function option($text, $value = null, $selected = false){
		$option = $this->el('option')->te($text);
		if($selected) $option->at('selected');
		if(isset($value)) $option->at('value', $value, HEAL_ATTR_ESCAPE);
		return $option;
	}

	public function checkbox($name, $checked = false, $id = null, $value = 'on'){
		if(!isset($id)) $id = strpos($name,"[")===false ? $name : substr($name,0,strpos($name,"["))."_".$value;
		$input = $this->el('input',['type'=>'checkbox','name'=>$name,'id'=>$id]);
		if($checked) $input->at('checked');
		if($value != 'on') $input->at('value',$value, HEAL_ATTR_ESCAPE);
		return $input;
	}

	public function radio($name, $value, $checked = false, $id = null){
		if(!isset($id)) $id = "$name:$value";
		$input = $this->el('input',['type'=>'radio','name'=>$name,'id'=>$id]);
		$input->at('value',$value, HEAL_ATTR_ESCAPE);
		if($checked) $input->at('checked');
		return $input;
	}

	public function disabled($value = '', $id = null){
		$input = $this->el('input',['type'=>'text']);
		$input->at('disabled')->at('value', $value, HEAL_ATTR_ESCAPE);
		if(isset($id)) $input->at('id',$id);
	}

	public function textarea($name, $content = '', $id = null){
		$textarea = $this->el('textarea',['name'=>$name])->te($content);
		if(isset($id)) $textarea->at('id',$id);
	}

	public function file($name, $id = null, $multiple = false){
		$input = $this->el('input',['type'=>'file']);
		if(isset($id)) $input->at('id',$id);
		if($multiple) $input->at('multiple')->at('name',$name.'[]');
		else $input->at('name',$name);
		return $input;
	}

	public function button($value, $onclick){
		return $this->el('input',['type'=>'button','value'=>$value,'onclick'=>$onclick], HEAL_ATTR_ESCAPE);
	}

	public function submit($value = null){
		$submit = $this->el('input',['type'=>'submit']);
		if(isset($value)) $submit->at('value', $value, HEAL_ATTR_ESCAPE);
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
}

class HealHTMLElement extends HealElement {
	use HealHTMLNodeParent;
}
?>