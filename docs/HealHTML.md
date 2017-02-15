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
public HealHTMLElement a(string $href [, string $text])
```
Creates an `a` element with the given text as content. Returns the newly created element.

Parameter | Description
--- | ---
`href` | The address of the linked content.
`text` | The text content of the element.

### `HealHTML->img(...)`
```PHP
public HealHTMLElement img(string $src, string $alt)
```
Creates an `img` element with the given src and alt text. Returns the newly created element.

Parameter | Description
--- | ---
`src` | The address of the image.
`alt` | The alternative text; should provide a description or placeholder for the image.

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
public array options(mixed $iterable [, string $selected [, int $compare_options]])
```
Creates an number of `option` elements, one for each entry in the iterable. Return an array of the newly created elements.

Parameter | Description
--- | ---
`iterable` | Either an associative array with key-value pairs or a `mysqli_result` object with `id` and `name` columns.
`selected` | The key or `id` of the selected pair or row.
`compare_options` | A bitmask of `HEAL_COMPARE_*` constants.

Constant | Description
--- | ---
`HEAL_COMPARE_STRICT` | Use strict equals when determining if the key or `id` is equal to the `selected` argument.

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
