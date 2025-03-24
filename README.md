# heal-document
heal-document is a small library that extends `DOMDocument` and related classes in PHP.
It is intended to save developer time when generating HTML and XML markup in PHP.

The primary interaction with heal-document is through the [`HealComponent`](#interface-healcomponent) interface.
This interface is implemented by the classes [`HealDocument`](#class-healdocument) and [`HealElement`](#class-healelement) and the abstract class [`HealWrapper`](#abstract-class-healwrapper).

Custom components are supported through a plugin structure.
A plugin is any class that implements the [`HealPluginInterface`](#interface-healplugininterface) interface.
Two abstract classes [`HealWrapper`](#abstract-class-healwrapper) and [`HealPlugin`](#abstract-class-healplugin) are supplied to make it easy to implement a plugin structure that works for most cases.

---

## Interface: HealComponent
```PHP
interface HealComponent {
	/* Methods */
	public el(string $name, array $attributes = [], bool $append = false): HealComponent
	public at(array $values, bool $append = false): HealComponent
	public te(string $str, bool $break_on_newline = false): HealComponent
	public co(string $str): HealComponent
	public fr(string $str): bool
}
```

### `HealComponent::el`
#### Description
```PHP
public HealComponent::el(string $name, array $attributes = [], bool $append = false): HealComponent
```
Creates a new element node and appends it to the parent.

Using the second and third argument is equivalent to calling the `at` method like this:
```->el($name)->at($attributes,$append);```

#### Parameters
Parameter | Description
--- | ---
`name` | The name of the element.
`attributes` | An array containing attributes to be added to the element as key-value pairs.
`append` | If `true`, switches behavior of the method to append the given attributes to the previous attribute values separated by a space. Default behaviour (`false`) is overwriting previous values.

#### Return Values
Return the newly created element.

### `HealComponent::at`
#### Description
```PHP
public HealComponent::at(array $values, bool $append = false): HealComponent
```
Creates one or more new attribute nodes and adds them to the element.
If a key-value pair in `attributes` has a numerical index (such as when not specifying a key in literal array notation, or appending a value to an array), the value is used as the name of an empty attribute.

#### Parameters
Parameter | Description
--- | ---
`attributes` | An array containing attributes to be added to the element as key-value pairs.
`append` | If `true`, switches behavior of the method to append the given value to the previous value separated by a space. Default behaviour (`false`) is overwriting previous value.

#### Return Values
Returns the element it is called on to allow chaining.

### `HealComponent::te`
#### Description
```PHP
public HealComponent::te(string $str, bool $break_on_newline = false): HealComponent
```
Create a new text node and appends it to the parent.

#### Parameters
Parameter | Description
--- | ---
`str` | The text content of the new text node.
`break_on_newline` | If `true`, converts newline characters to `br` elements. Defaults to `false`. Recognized newline character sequences are `\n` and `\n\r`.

#### Return Values
Returns the element it is called on to allow chaining.

### `HealComponent::co`
#### Description
```PHP
public HealComponent::co(string $str): HealComponent
```
Creates a comment node and appends it to the parent. 

#### Parameters
Parameter | Description
--- | ---
`str` | The text content of the comment node.

#### Return Values
Returns the parent to allow chaining.

### `HealComponent::fr`
#### Description
```PHP
public HealComponent::fr(string $str): bool
```
Parses the input as XML and appends it to the parent.
If the string can't be parsed, an error message is appended to the parent.

#### Parameters
Parameter | Description
--- | ---
`str` | A string containing XML to be parsed.

#### Return Values
Returns `true` on success or `false` on failure.

---

## Class: HealDocument
```PHP
class HealDocument extends DOMDocument implements HealComponent {
	/* Static Methods */
	public static register_plugin(string $classname, ?string $prefix = null): void
	public static try_plugin(HealComponent $parent, string $fullname, array $arguments): HealComponent

	/* Methods */
	public __construct(string $version = 'html', string $encoding = '')
	public el(string $name, array $attributes = [], bool $append = false): HealComponent
	public te(string $str, bool $break_on_newline = false): HealComponent
	public co(string $str): HealComponent
	public fr(string $str): bool
	public __call(string $name, array $arguments): HealComponent

	/* Unsupported Method */
	public at(array $values, bool $append = false): HealComponent
}
```
The `el`, `te`, `co` and `fr` methods are implemented as described in the `HealComponent` interface.

### `HealDocument::register_plugin`
#### Description
```PHP
public static HealDocument::register_plugin(string $classname, ?string $prefix = null): void
```
Registers a plugin and enables calling the methods supplied by that plugin through any `HealDocument` object, `HealElement` object, or `HealWrapper` implementing object.

#### Parameters
Parameter | Description
--- | ---
`classname` | The name of a class implementing `HealPluginInterface`. Attempts to autoload the class if it doesn't exist.
`prefix` | An optional prefix for the methods available in the plugin. Allows distinguishing between plugins supplying methods with overlapping names.

#### Return Values
Doesn't return anything.

### `HealDocument::try_plugin`
#### Description
```PHP
public static HealDocument::try_plugin(HealComponent $parent, string $fullname, array $arguments): HealComponent
```

#### Parameters

#### Return Values

### `HealDocument::__construct`
#### Description
```PHP
public HealDocument::__construct(string $version = 'html', string $encoding = '')
```
Extends the DOMDocument constructor with a special `$version` case. If version is `"html"`, the `__toString` function will output the document as a HTML document, rather than an XML document.

#### Parameters
Parameter | Description
--- | ---
`version` | Either `"html"` or the version number of the document as part of the XML declaration.
`encoding` | The encoding of the document as part of the XML declaration.

### `HealDocument::__call`
#### Description
```PHP
public HealDocument::__call(string $name, array $arguments): ?HealComponent
```
Allows calling methods supplied by plugins to create complex elements and components easily.
It is a shorthand for `HealDocument::try_plugin($this, $name, $arguments);`.

These two statements are equivalent:
```PHP
$element->prefix_component($argument1, $argument2);
HealDocument::try_plugin($element, 'prefix_component', [$argument1, $argument2]);
```

#### Return Values
Returns an object implementing HealComponent created by the plugin.

#### Exceptions
If the named plugin isn't registered an exception is thrown.

### `HealDocument::at`
#### Exceptions
This method always throws an exception when called on the `HealDocument` class.

---

## Class: HealElement
```PHP
class HealElement extends DOMElement implements HealComponent {
	/* Methods */
	public el(string $name, array $attributes = [], bool $append = false): HealComponent
	public at(array $values, bool $append = false): HealComponent
	public te(string $str, bool $break_on_newline = false): HealComponent
	public co(string $str): HealComponent
	public fr(string $str): bool
	public __call(string $name, array $arguments): ?HealComponent
}
```
The `el`, `at`, `te`, `co` and `fr` methods are implemented as described in the `HealComponent` interface.

---

## Abstract Class: HealWrapper
```PHP
abstract class HealWrapper implements HealComponent {
	/* Properties */
	protected HealComponent $primary_element;

	/* Methods */
	public el(string $name, array $attributes = [], bool $append = false): HealComponent
	public at(array $values, bool $append = false): HealComponent
	public te(string $str, bool $break_on_newline = false): HealComponent
	public co(string $str): HealComponent
	public fr(string $str): bool
	public __call(string $name, array $arguments): ?HealComponent
```
A wrapper around an internal `HealComponent` implementing object stored in the protected attribute `$primary_element`.
It is meant to aid in implementing plugins for heal-document.
The methods from `HealComponent` is implemented as plain wrappers calling the equivalent methods on the internal `$primary_element`.

An implementing class can generate complex structures in the constructor, and additional methods can be defined that is only available on those specific components.

---

## Interface: HealPluginInterface
```PHP
interface HealPluginInterface {
	public static can_create(string $name): bool
	public static create(HealComponent $parent, string $name, ...$arguments): HealComponent
}
```
The basic interface a plugin for heal-document is required to implement.

### HealPluginInterface::can_create
```PHP
public static HealPluginInterface::can_create(string $name): bool
```
Called by `HealDocument::try_plugin` to check whether a plugin can create a component of the given `$name`. If it returns false `HealDocument::try_plugin` looks for other plugins to create the component.

### HealPluginInterface::create
```PHP
public static HealPluginInterface::create(HealComponent $parent, string $name, ...$arguments): HealComponent
```
Called by `HealDocument::try_plugin` when the plugin must create a component of the given `$name`.

---

## Abstract Class: HealPlugin
```PHP
abstract class HealPlugin extends HealWrapper implements HealPluginInterface {
	public static HealPlugin::can_create(string $name): bool
	public static HealPlugin::create(HealComponent $parent, string $name, ...$arguments): HealComponent
}
```
### HealPlugin::can_create
#### Description
```PHP
public static HealPluginInterface::can_create(string $name): bool
```

#### Return Values
Returns `true` if the class has a static method of the given `$name`.

### HealPlugin::create
#### Description
```PHP
public static HealPlugin::create(HealComponent $parent, string $name, ...$arguments): HealComponent
```
Attempts to create a component by calling the static method named `$name` on itself with `$parent` and `...$arguments` as parameters: `static::$name($parent, ...$arguments)`;
If the created component is an instance of the class this method is called on and `$primary_element` isn't defined, then the `$parent` object is assigned to `$primary_element`.

#### Parameters
Parameters | Description
--- | ---
`$parent` | A `HealComponent` intended to be the parent node of the created component.
`$name` | The name of the static method to call to create the component.
`$arguments` | Additional arguments for the static method creating the component.

#### Return Values
Returns the newly created component as an object implementing `HealComponent`.

#### Exceptions
An exception is thrown if the static method `$name` doesn't exist or it fails to return an object implementing `HealComponent`.
