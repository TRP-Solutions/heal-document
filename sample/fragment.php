<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/trp-solutions/HealDocument/blob/main/LICENSE
*/
declare(strict_types=1);
require_once "../lib/HealDocument.php";
use \TRP\HealDocument\{HealDocument,Fragment};

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

$fragment = new Fragment();

$fragment->el('h1')->te('Hello World');

$fragment->el('p')->te('This is a simple example of how a fragment of HTML can be created and then inserted in the document.');

$fragment->el('img',['src'=>'heal-logo.php','alt'=>'heal-document logo']);

$body->fr($fragment);

$html_fragment = <<<HTML
	<p>And this paragraph is XML-compatible HTML that is inserted as a string.</p>
	HTML;

$body->fr($html_fragment);

echo $doc;
