<?php
require_once "../lib/HealHTML.php";

$doc = new HealHtml();
list($head,$body) = $doc->html('Hello World');

$head->el('style')
	->te('body { width: 650px; border: 1px solid black; padding: 0 1em; box-sizing: border-box; }')
	->te('h1, p { font-family: sans-serif; }')
	->te('p { font-size: 1.2em; }');

$body->el('h1')->te('Hello World');

$body->p('This is a simple example of how a HTML document can be constructed.');

$body->img('heal-logo.php','heal-document logo');

echo $doc;
?>