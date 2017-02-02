# heal-document

heal-document is a small library that extends the standard DOM interface in PHP.
It is intended to save developer time when generating HTML and XML markup in PHP.

The library supplies four classes `HealDocument`, `HealElement`, `HealHTML`, and `HealHTMLElement`.

# HealDocument
```PHP
class HealDocument extends DOMDocument {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealDocument te(string $str)
	public HealDocument co(string $str)
	public bool fr(string $str)
}
```
### `HealDocument->el(...)`
```PHP
public HealElement el(string $name [, array $attributes [, int $attr_options]])
```
Creates a new element node and appends it to the parent. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the element.
`attributes` | An array containing attributes to be added to the element as key-value pairs.
`attr_options` | A bitmask of `HEAL_ATTR_*` constants.

### `HealDocument->te(...)`
```PHP
public HealDocument te(string $str)
```
Create a new text node and appends it to the parent. Returns the parent to allow chaining.

Parameter | Description
--- | ---
`str` | The text content of the new node.

### `HealDocument->co(...)`
```PHP
public HealDocument co(string $str)
```
Creates a comment node and appends it to the parent. Returns the parent to allow chaining.

### `HealDocument->fr(...)`
```PHP
public bool fr(string $str)
```
Parses the input as XML and appends it to the parent.
If the string can't be parsed, an error message is appended to the parent.
Returns `TRUE` on success or `FALSE` on failure.

Parameter | Description
--- | ---
`str` | A string containing XML to be parsed.

# HealElement
```PHP
class HealElement extends DOMElement {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealElement te(string $str)
	public HealElement co(string $str)
	public bool fr(string $str)
	public HealElement at(string $name [, string $value [, int $options]])
}
```
The `el`, `te`, `co` and `fr` methods are shared with `HealDocument` and documented there.

### `HealElement->at(...)`
```PHP
public HealElement at(string $name [, string $value [, int $options]])
```
Creates a new attribute node and adds it to the element. Returns the element to allow chaining.

Parameter | Description
--- | ---
`name` | The name of the attribute.
`value` | The value of the attribute.
`options` | A bitmask of `HEAL_ATTR_*` constants.

Constant | Description
--- | ---
`HEAL_ATTR_APPEND` | Switches behavior of the method to append the given value to the previous value separated by a space. Default behaviour is overwriting previous value.
`HEAL_ATTR_NO_ESCAPE` | Disables the automatic call to `htmlspecialchars`, that escapes the value before being written.

# HealHTML
```PHP
class HealHTML extends HealDocument {
	/* Methods */
	public void showHTML()
	public array html(string $title [, string $charset])
	public HealHTMLElement head(string $title [, string $charset])
	public HealHTMLElement metadata(string $name, string $content)
	public HealHTMLElement link(string $rel, string $href [, array $attr])
	public HealHTMLElement css(string $path)
	public HealHTMLElement p(string $text)
	public HealHTMLElement a(string $href, string $text)
	public HealHTMLElement form([string $action [, string $method]])
	public HealHTMLElement label([string $text [, string $for]])
	public HealHTMLElement input(string $name [, string $value])
	public HealHTMLElement password(string $name)
	public HealHTMLElement hidden(string $name, string $value)
	public HealHTMLElement select(string $name)
	public HealHTMLElement option(string $text [, string $value [, bool $selected]])
	public array options(mixed $iterable)
	public HealHTMLElement checkbox(string $name [, bool $checked [, string $value]])
	public HealHTMLElement radio(string $name, string $value [, bool $checked])
	public HealHTMLElement textarea(string $name [, string $content])
	public HealHTMLElement file(string $name [, bool $multiple])
	public HealHTMLElement button(string $value, string $onclick)
	public HealHTMLElement submit([string $value])

	/* Inherited from HealDocument */
	public HealHTMLElement el(string $name [, array $attributes [, int $attr_options]])
	public HealHTML te(string $str)
	public HealHTML co(string $str)
	public bool fr(string $str)
}
```
### `HealHTML->showHTML()`
```PHP
public void showHTML()
```
Echoes the HTML document inside a `<pre>` tag. This is meant as a debugging helper.

### `HealHTML->html(...)`
```PHP
public array html(string $title [, string $charset])
```
Creates a minimal element tree with the `head` element prefilled with charset `meta` element and a `title` element. Returns an array of the `head` element and the `body` element.

Parameter | Description
--- | ---
`title` | The documents title.
`charset` | The documents charset.

### `HealHTML->head(...)`
```PHP
public HealHTMLElement head(string $title [, string $charset])
```
Creates a `head` element prefilled with charset `meta` element and a `title` element. Returns the `head` element.

Parameter | Description
--- | ---
`title` | The documents title.
`charset` | The documents charset.

### `HealHTML->metadata(...)`
```PHP
public HealHTMLElement metadata(string $name, string $content)
```
Creates a `meta` element and sets the `name` and `content` attributes. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The value of the `name` attribute.
`content` | The value of the `content` attribute.

### `HealHTML->link(...)`
```PHP
public HealHTMLElement link(string $rel, string $href [, array $attr])
```
Creates a `link` element and sets the `rel` and `href` attributes. Returns the newly created element.

Parameter | Description
--- | ---
`rel` | The relation to the external document.
`href` | A reference to an external document.
`attr` | An associative array of additional attributes.

### `HealHTML->css(...)`
```PHP
public HealHTMLElement css(string $path)
```
Creates a `link` element that links to an external stylesheet. Returns the newly created element.

Parameter | Description
--- | ---
`path` | The path to the external stylesheet.

### `HealHTML->p(...)`
```PHP
public HealHTMLElement p(string $text)
```
Creates a `p` element with the given text as content. Returns the newly created element.

Parameter | Description
--- | ---
`text` | The text content of the element.

### `HealHTML->a(...)`
```PHP
public HealHTMLElement a(string $href, string $text)
```
Creates an `a` element with the given text as content. Returns the newly created element.

Parameter | Description
--- | ---
`href` | The address of the linked content.
`text` | The text content of the element.

### `HealHTML->form(...)`
```PHP
public HealHTMLElement form([string $action [, string $method]])
```
Creates a `form` element with the given action and method. If no action is given, the form will not react to a submission. Returns the newly created element.

Parameter | Description
--- | ---
`action` | The endpoint that the form sends data to when submitted.
`method` | The method of sending data; should be `get` or `post`. Default is `get`.

### `HealHTML->label(...)`
```PHP
public HealHTMLElement label([string $text [, string $for]])
```
Creates a `label` element with the given text as context. Returns the newly created element.

Parameter | Description
--- | ---
`action` | The endpoint that the form sends data to when submitted.
`method` | The method of sending data; should be `get` or `post`. Default is `get`.

### `HealHTML->input(...)`
```PHP
public HealHTMLElement input(string $name [, string $value])
```
Creates an `input` element with type `text`, the given name and an optional value. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the input field.
`value` | The default value in the input field.

### `HealHTML->password(...)`
```PHP
public HealHTMLElement password(string $name)
```
Creates an `input` element with type `password` and the given name. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the password field.

### `HealHTML->hidden(...)`
```PHP
public HealHTMLElement hidden(string $name, string $value)
```
Creates an `input` element with type `hidden`, the given name and value. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the hidden input field.
`value` | The value in the hidden input field.

### `HealHTML->select(...)`
```PHP
public HealHTMLElement select(string $name)
```
Creates an `select` element with the given name. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the select field.

### `HealHTML->option(...)`
```PHP
public HealHTMLElement option(string $text [, string $value [, bool $selected]])
```
Creates an `option` element with the given text content and an optional value. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`text` | The displayed text content of the option.
`value` | The value of the option.
`selected` | A boolean representing whether the option is selected.

### `HealHTML->options(...)`
```PHP
public array options(mixed $iterable)
```
Creates an number of `option` elements, one for each entry in the iterable. Return an array of the newly created elements.

Parameter | Description
--- | ---
`iterable` | Either an associative array with key-value pairs or a `mysqli_result` object with `id` and `name` columns.

### `HealHTML->checkbox(...)`
```PHP
public HealHTMLElement checkbox(string $name [, bool $checked [, string $value]])
```
Creates an `input` element with type `checkbox` and the given name. The `id` attribute is derived from the name and value. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the checkbox input field.
`checked` | A boolean indicating whether the checkbox is checked.
`value` | The value in the checkbox input field.

### `HealHTML->radio(...)`
```PHP
public HealHTMLElement radio(string $name, string $value [, bool $checked])
```
Creates an `input` element with type `radio` and the given name. The `id` attribute is derived from the name and value. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the radio input field.
`value` | The value in the radio input field.
`checked` | A boolean indicating whether the radio is checked.

### `HealHTML->textarea(...)`
```PHP
public HealHTMLElement textarea(string $name [, string $content])
```
Creates a `textarea` element with the given name. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the textarea input field.
`content` | The text content inside the textarea.

### `HealHTML->file(...)`
```PHP
public HealHTMLElement file(string $name [, bool $multiple])
```
Creates an `input` element with type `file` and the given name. The `id` attribute is also set to `$name`. Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the file input field.
`multiple` | A boolean indicating whether the input field should accept multiple files.

### `HealHTML->button(...)`
```PHP
public HealHTMLElement button(string $value, string $onclick)
```
Creates an `input` element with type `button`. Returns the newly created element.

Parameter | Description
--- | ---
`value` | The text on the button.
`onclick` | JavaScript code to be run when the button is clicked.

### `HealHTML->submit(...)`
```PHP
public HealHTMLElement submit([string $value])
```
Creates an `input` element with type `submit`. Returns the newly created element.

Parameter | Description
--- | ---
`value` | The text on the button.

# HealHTMLElement
```PHP
class HealHTMLElement extends HealElement {
	/* Methods */
	public HealHTMLElement head(string $title [, string $charset])
	public HealHTMLElement metadata(string $name, string $content)
	public HealHTMLElement link(string $rel, string $href [, array $attr])
	public HealHTMLElement css(string $path)
	public HealHTMLElement p(string $text)
	public HealHTMLElement a(string $href, string $text)
	public HealHTMLElement form([string $action [, string $method]])
	public HealHTMLElement label([string $text [, string $for]])
	public HealHTMLElement input(string $name [, string $value])
	public HealHTMLElement password(string $name)
	public HealHTMLElement hidden(string $name, string $value)
	public HealHTMLElement select(string $name)
	public HealHTMLElement option(string $text [, string $value [, bool $selected]])
	public array options(mixed $iterable)
	public HealHTMLElement checkbox(string $name [, bool $checked [, string $value]])
	public HealHTMLElement radio(string $name, string $value [, bool $checked])
	public HealHTMLElement textarea(string $name [, string $content])
	public HealHTMLElement file(string $name [, bool $multiple])
	public HealHTMLElement button(string $value, string $onclick)
	public HealHTMLElement submit([string $value])

	/* Inherited from HealElement */
	public HealHTMLElement el(string $name [, array $attributes [, int $attr_options]])
	public HealHTMLElement te(string $str)
	public HealHTMLElement co(string $str)
	public bool fr(string $str)
	public HealHTMLElement at(string $name [, string $value [, int $options]])
}
```
All non-inherited methods are shared with `HealHTML` and documented there.