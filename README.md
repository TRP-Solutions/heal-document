# heal-document

heal-document is a small library that extends the standard DOM interface in PHP.
It is intended to save developer time when generating HTML and XML markup in PHP.

The library supplies four classes in two files:

* HealDocument.php
	* [HealDocument](docs/HealDocument.md)
	* [HealElement](docs/HealElement.md)
* HealHTML.php
	* [HealHTML](docs/HealHTML.md)
	* [HealHTMLElement](docs/HealHTMLElement.md)

An overview of the classes and their functions are included here.
```PHP
class HealDocument extends DOMDocument {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealDocument te(string $str [, int $text_options])
	public HealDocument co(string $str)
	public bool fr(string $str)
}

class HealElement extends DOMElement {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealElement te(string $str [, int $text_options])
	public HealElement co(string $str)
	public bool fr(string $str)
	public HealElement at(string $name [, string $value [, int $options]])
}

class HealHTML extends HealDocument {
	/* Methods */
	public void showHTML()
	public array html(string $title [, string $charset])
	public HealHTMLElement head(string $title [, string $charset])
	public HealHTMLElement metadata(string $name, string $content)
	public HealHTMLElement link(string $rel, string $href [, array $attr])
	public HealHTMLElement css(string $path)
	public HealHTMLElement p(string $text)
	public HealHTMLElement a(string $href [, string $text])
	public HealHTMLElement img(string $src, string $alt)
	public HealHTMLElement form([string $action [, string $method]])
	public HealHTMLElement label([string $text [, string $for]])
	public HealHTMLElement input(string $name [, string $value])
	public HealHTMLElement password(string $name)
	public HealHTMLElement hidden(string $name, string $value)
	public HealHTMLElement select(string $name)
	public HealHTMLElement option(string $text [, string $value [, bool $selected]])
	public array options(mixed $iterable [, string $selected [, int $compare_options]])
	public HealHTMLElement checkbox(string $name [, bool $checked [, string $value]])
	public HealHTMLElement radio(string $name, string $value [, bool $checked])
	public HealHTMLElement textarea(string $name [, string $content])
	public HealHTMLElement file(string $name [, bool $multiple])
	public HealHTMLElement button(string $value, string $onclick)
	public HealHTMLElement submit([string $value])

	/* Inherited from HealDocument */
	public HealHTMLElement el(string $name [, array $attributes [, int $attr_options]])
	public HealHTML te(string $str [, int $text_options])
	public HealHTML co(string $str)
	public bool fr(string $str)
}

class HealHTMLElement extends HealElement {
	/* Methods */
	public HealHTMLElement head(string $title [, string $charset])
	public HealHTMLElement metadata(string $name, string $content)
	public HealHTMLElement link(string $rel, string $href [, array $attr])
	public HealHTMLElement css(string $path)
	public HealHTMLElement p(string $text)
	public HealHTMLElement a(string $href [, string $text])
	public HealHTMLElement img(string $src, string $alt)
	public HealHTMLElement form([string $action [, string $method]])
	public HealHTMLElement label([string $text [, string $for]])
	public HealHTMLElement input(string $name [, string $value])
	public HealHTMLElement password(string $name)
	public HealHTMLElement hidden(string $name, string $value)
	public HealHTMLElement select(string $name)
	public HealHTMLElement option(string $text [, string $value [, bool $selected]])
	public array options(mixed $iterable [, string $selected [, int $compare_options]])
	public HealHTMLElement checkbox(string $name [, bool $checked [, string $value]])
	public HealHTMLElement radio(string $name, string $value [, bool $checked])
	public HealHTMLElement textarea(string $name [, string $content])
	public HealHTMLElement file(string $name [, bool $multiple])
	public HealHTMLElement button(string $value, string $onclick)
	public HealHTMLElement submit([string $value])

	/* Inherited from HealElement */
	public HealHTMLElement el(string $name [, array $attributes [, int $attr_options]])
	public HealHTMLElement te(string $str [, int $text_options])
	public HealHTMLElement co(string $str)
	public bool fr(string $str)
	public HealHTMLElement at(string $name [, string $value [, int $options]])
}
```
