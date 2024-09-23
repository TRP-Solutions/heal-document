<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
declare(strict_types=1);
require_once "../lib/HealDocument.php";

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

$body->el('p')->te('This is a simple example of how a HTML document can be constructed.');

$body->el('img',['src'=>'heal-logo.php','alt'=>'heal-document logo']);

echo $doc;
