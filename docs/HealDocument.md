# HealDocument
```PHP
class HealDocument extends DOMDocument {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealDocument te(string $str [, int $text_options])
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
public HealDocument te(string $str [, int $text_options])
```
Create a new text node and appends it to the parent. Returns the parent to allow chaining.

Parameter | Description
--- | ---
`str` | The text content of the new node.
`text_options` | A bitmask of `HEAL_TEXT_*` constants.

Constant | Description
--- | ---
`HEAL_TEXT_NL2BR` | Inserts `br` elements between every line of the input.

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
