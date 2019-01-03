# HealSVG
```PHP
class HealSVG extends HealDocument {
	/* Methods */
	public HealSVGElement svg(string $width, string $height [, int $svg_options])

	/* Inherited from HealDocument */
	public HealSVGElement el(string $name [, array $attributes [, int $attr_options]])
	public HealSVG te(string $str [, int $text_options])
	public HealSVG co(string $str)
	public bool fr(string $str)
}
```

### `HealSVG->svg(...)`
```PHP
public HealSVGElement svg(string $width, string $height [, int $svg_options])
```
Creates a root `svg` element with correct namespace. Returns the newly created element..

Parameter | Description
--- | ---
`width` | The width of the SVG image.
`height` | The height of the SVG image.
`svg_options` | A bitmask of `HEAL_SVG_*` constants.

Constant | Description
--- | ---
`HEAL_SVG_XLINK` | Include the `xlink` namespace in the SVG element.

# HealSVGElement
```PHP
class HealSVGElement extends HealElement {
	/* Inherited from HealElement */
	public HealSVGElement el(string $name [, array $attributes [, int $attr_options]])
	public HealSVGElement te(string $str [, int $text_options])
	public HealSVGElement co(string $str)
	public bool fr(string $str)
	public HealSVGElement at(array $attributes [, int $options])
}
```
