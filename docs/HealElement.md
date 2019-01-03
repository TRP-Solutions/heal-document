# HealElement
```PHP
class HealElement extends DOMElement {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealElement te(string $str [, int $text_options])
	public HealElement co(string $str)
	public bool fr(string $str)
	public HealElement at(array $attributes [, int $options])
}
```
The `el`, `te`, `co` and `fr` methods are shared with `HealDocument` and [documented there](HealDocument.md).

### `HealElement->at(...)`
```PHP
public HealElement at(array $attributes [, int $options])
```
Creates one or more new attribute nodes and adds them to the element.
If a key-value pair in `attributes` has a numerical index (such as when not specifying a key in literal array notation, or appending a value to an array), the value is used as the name of an empty attribute.
Returns the element to allow chaining.

Parameter | Description
--- | ---
`attributes` | An array containing attributes to be added to the element as key-value pairs.
`options` | A bitmask of `HEAL_ATTR_*` constants.

Constant | Description
--- | ---
`HEAL_ATTR_APPEND` | Switches behavior of the method to append the given value to the previous value separated by a space. Default behaviour is overwriting previous value.
`HEAL_ATTR_NO_ESCAPE` | Disables the automatic call to `htmlspecialchars`, that escapes the value before being written.
