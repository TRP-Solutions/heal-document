<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
declare(strict_types=1);
require_once "../lib/HealDocument.php";

class ExamplePlugin extends HealPlugin {
	public static function labelled_input($parent, $label, $value, $name = null, $placeholder = null){
		$div = $parent->el('div');
		$label = $div->el('label')->te($label);
		$input = $label->el('input',['type'=>'text','value'=>$value]);
		if(isset($name)){
			$input->at(['name'=>$name]);
		}
		if(isset($placeholder)){
			$input->at(['placeholder'=>$placeholder]);
		}
		return $input;
	}
}

HealDocument::register_plugin('ExamplePlugin');

$doc = new HealDocument('html');
$html = $doc->el('html',['lang'=>'en']);
$head = $html->el('head');
$head->el('meta',['charset'=>'utf-8']);
$head->el('title')->te('Hello World');
$body = $html->el('body');

$head->el('style')
	->te('body { width: 650px; border: 1px solid black; padding: 0 1em; box-sizing: border-box; }')
	->te('h1, p { font-family: sans-serif; }')
	->te('p { font-size: 1.2em; }');

$body->el('h1')->te('Hello World');

$body->el('p')->te('This is a simple example of how a plugins can be used. The following is an example plugin making labelled inputs.');

$body->labelled_input('Input with value', 'Value');
$body->labelled_input('Input with name', '', 'input_name');
$body->labelled_input('Input with placeholder', '', null, 'Placeholder');

echo $doc;
