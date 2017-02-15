# HealElement
```PHP
class HealElement extends DOMElement {
	/* Methods */
	public HealElement el(string $name [, array $attributes [, int $attr_options]])
	public HealElement te(string $str [, int $text_options])
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
