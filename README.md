# heal-document

heal-document is a small library that extends the standard DOM interface in PHP.
It is intended to save developer time when generating HTML and XML markup in PHP.

The library supplies two classes:

* HealDocument
* HealElement

## HealDocument
```PHP
class HealDocument extends DOMDocument {
	/* Methods */
	public __construct([string $version [, string $encoding]])
	public HealElement el(string $name [, array $attributes [, bool $append]])
	public HealDocument te(string $str [, bool $break_on_newline])
	public HealDocument co(string $str)
	public bool fr(string $str)
}
```
### `new HealDocument(...)`
```PHP
public __construct([string $version [, string $encoding]])
```
Extends the DOMDocument constructor with a special `$version` case. If version is `"html"`, the `__toString` function will output the document as a HTML document, rather than an XML document.

Parameter | Description
--- | ---
`version` | Either `"html"` or the version number of the document as part of the XML declaration. 
`encoding` | The encoding of the document as part of the XML declaration. 

### `HealDocument->el(...)`
```PHP
public HealElement el(string $name [, array $attributes [, bool $append]])
```
Creates a new element node and appends it to the parent.
If a key-value pair in `attributes` has a numerical index (such as when not specifying a key in literal array notation, or appending a value to an array), the value is used as the name of an empty attribute.
Returns the newly created element.

Parameter | Description
--- | ---
`name` | The name of the element.
`attributes` | An array containing attributes to be added to the element as key-value pairs.
`append` | If `true`, switches behavior of the method to append the given attributes to the previous attribute values separated by a space. Default behaviour (`false`) is overwriting previous values.

### `HealDocument->te(...)`
```PHP
public HealDocument te(string $str [, bool $break_on_newline])
```
Create a new text node and appends it to the parent. Returns the parent to allow chaining.

Parameter | Description
--- | ---
`str` | The text content of the new node.
`break_on_newline` | If `true`, converts newlines characters to `br` elements. Defaults to `false`.

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
Returns `true` on success or `false` on failure.

Parameter | Description
--- | ---
`str` | A string containing XML to be parsed.

## HealElement
```PHP
class HealElement extends DOMElement {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, bool $append]])
	public HealElement te(string $str [, bool $break_on_newline])
	public HealElement co(string $str)
	public bool fr(string $str)
	public HealElement at(array $attributes [, bool $append])
}
```
The `el`, `te`, `co` and `fr` methods are shared with `HealDocument` and documented above.

### `HealElement->at(...)`
```PHP
public HealElement at(array $attributes [, bool $append])
```
Creates one or more new attribute nodes and adds them to the element.
If a key-value pair in `attributes` has a numerical index (such as when not specifying a key in literal array notation, or appending a value to an array), the value is used as the name of an empty attribute.
Returns the element to allow chaining.

Parameter | Description
--- | ---
`attributes` | An array containing attributes to be added to the element as key-value pairs.
`append` | If `true`, switches behavior of the method to append the given value to the previous value separated by a space. Default behaviour (`false`) is overwriting previous value.
