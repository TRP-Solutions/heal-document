# heal-document
heal-document is a small library that extends `DOMDocument` and related classes in PHP.
It is intended to save developer time when generating HTML and XML markup in PHP.

The primary interaction with heal-document is through the [`Component`](#interface-component) interface.
This interface is implemented by the classes [`HealDocument`](#class-healdocument), [`Element`](#class-element), and [`Fragment`](#class-fragment) and the abstract class [`Wrapper`](#abstract-class-wrapper).

Custom components are supported through a plugin structure.
A plugin is any class that implements the [`PluginInterface`](#interface-plugininterface) interface.
Two abstract classes [`Wrapper`](#abstract-class-wrapper) and [`Plugin`](#abstract-class-plugin) are supplied to make it easy to implement a plugin structure that works for most cases.

---

## Interface: Component
```PHP
interface TRP\HealDocument\Component {
	/* Methods */
	public el(string $name, array $attributes = [], bool $append = false): Component;
	public at(array $values, bool $append = false): Component;
	public te(string $str, bool $break_on_newline = false): Component;
	public co(string $str): Component;
	public fr(string|TRP\HealDocument\Fragment $contents): bool;
}
```

### `Component::el`
#### Description
```PHP
public TRP\HealDocument\Component::el(string $name, array $attributes = [], bool $append = false): Component
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

### `Component::at`
#### Description
```PHP
public TRP\HealDocument\Component::at(array $values, bool $append = false): Component
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

### `Component::te`
#### Description
```PHP
public TRP\HealDocument\Component::te(string $str, bool $break_on_newline = false): Component
```
Create a new text node and appends it to the parent.

#### Parameters
Parameter | Description
--- | ---
`str` | The text content of the new text node.
`break_on_newline` | If `true`, converts newline characters to `br` elements. Defaults to `false`. Recognized newline character sequences are `\n` and `\n\r`.

#### Return Values
Returns the element it is called on to allow chaining.

### `Component::co`
#### Description
```PHP
public TRP\HealDocument\Component::co(string $str): Component
```
Creates a comment node and appends it to the parent. 

#### Parameters
Parameter | Description
--- | ---
`str` | The text content of the comment node.

#### Return Values
Returns the parent to allow chaining.

### `Component::fr`
#### Description
```PHP
public TRP\HealDocument\Component::fr(string|TRP\HealDocument\Fragment $contents): bool
```
If the input is a string it is parsed as XML and appends it to the parent.
If can't be parsed, an error message is appended to the parent.
If the input is a `Fragment` all its nodes are imported into the document and appended to the parent.

#### Parameters
Parameter | Description
--- | ---
`contents` | A string containing XML to be parsed or a [`Fragment`](#class-fragment) object.

#### Return Values
Returns `true` on success or `false` on failure.

---

## Class: HealDocument
```PHP
class TRP\HealDocument\HealDocument extends DOMDocument implements TRP\HealDocument\Component {
	/* Static Methods */
	public static register_plugin(string $classname, ?string $prefix = null): void;
	public static try_plugin(TRP\HealDocument\Component $parent, string $fullname, array $arguments): TRP\HealDocument\Component;

	/* Methods */
	public __construct(string $version = 'html', string $encoding = '');
	public el(string $name, array $attributes = [], bool $append = false): TRP\HealDocument\Component;
	public te(string $str, bool $break_on_newline = false): TRP\HealDocument\Component;
	public co(string $str): TRP\HealDocument\Component;
	public fr(string|TRP\HealDocument\Fragment $contents): bool;
	public __call(string $name, array $arguments): TRP\HealDocument\Component;

	/* Unsupported Method */
	public at(array $values, bool $append = false): TRP\HealDocument\Component;
}
```
The `el`, `te`, `co` and `fr` methods are implemented as described in the `Component` interface.

### `HealDocument::register_plugin`
#### Description
```PHP
public static TRP\HealDocument\HealDocument::register_plugin(string $classname, ?string $prefix = null): void
```
Registers a plugin and enables calling the methods supplied by that plugin through any `HealDocument` object, `Element` object, or `Wrapper` implementing object.

#### Parameters
Parameter | Description
--- | ---
`classname` | The name of a class implementing `TRP\HealDocument\PluginInterface`. Attempts to autoload the class if it doesn't exist.
`prefix` | An optional prefix for the methods available in the plugin. Allows distinguishing between plugins supplying methods with overlapping names.

#### Return Values
Doesn't return anything.

### `HealDocument::try_plugin`
#### Description
```PHP
public static TRP\HealDocument\HealDocument::try_plugin(Component $parent, string $fullname, array $arguments): TRP\HealDocument\Component
```

#### Parameters

#### Return Values

### `HealDocument::__construct`
#### Description
```PHP
public TRP\HealDocument\HealDocument::__construct(string $version = 'html', string $encoding = '')
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
public TRP\HealDocument\HealDocument::__call(string $name, array $arguments): ?Component
```
Allows calling methods supplied by plugins to create complex elements and components easily.
It is a shorthand for `HealDocument::try_plugin($this, $name, $arguments);`.

These two statements are equivalent:
```PHP
$element->prefix_component($argument1, $argument2);
\TRP\HealDocument\HealDocument::try_plugin($element, 'prefix_component', [$argument1, $argument2]);
```

#### Return Values
Returns an object implementing Component created by the plugin.

#### Exceptions
If the named plugin isn't registered an exception is thrown.

### `HealDocument::at`
#### Exceptions
This method always throws an exception when called on the `HealDocument` class.

---

## Class: Element
```PHP
class TRP\HealDocument\Element extends DOMElement implements TRP\HealDocument\Component {
	/* Methods */
	public el(string $name, array $attributes = [], bool $append = false): TRP\HealDocument\Component;
	public at(array $values, bool $append = false): TRP\HealDocument\Component;
	public te(string $str, bool $break_on_newline = false): TRP\HealDocument\Component;
	public co(string $str): TRP\HealDocument\Component;
	public fr(string|TRP\HealDocument\Fragment $contents): bool;
	public __call(string $name, array $arguments): ?TRP\HealDocument\Component;
}
```
The `el`, `at`, `te`, `co` and `fr` methods are implemented as described in the [`Component`](#interface-component) interface.

The `__call` method is implemented as described in the [`HealDocument`](#class-healdocument) class.

---

## Class: Fragment
```PHP
class TRP\HealDocument\Fragment implements TRP\HealDocument\Component {
	/* Properties */
	protected DOMDocumentFragment $fragment;

	/* Methods */
	public __construct(protected ?HealDocument $doc = null);
	public appendTo(DOMNode $parent): bool
	public el(string $name, array $attributes = [], bool $append = false): TRP\HealDocument\Component;
	public at(array $values, bool $append = false): TRP\HealDocument\Component;
	public te(string $str, bool $break_on_newline = false): TRP\HealDocument\Component;
	public co(string $str): TRP\HealDocument\Component;
	public fr(string|TRP\HealDocument\Fragment $contents): bool;
	public __call(string $name, array $arguments): ?TRP\HealDocument\Component;
}
```
The `el`, `te`, `co` and `fr` methods are implemented as described in the [`Component`](#interface-component) interface.

The `__call` method is implemented as described in the [`HealDocument`](#class-healdocument) class.

### `Fragment::__construct`
#### Description
```PHP
public TRP\HealDocument\Fragment::__construct(protected ?TRP\HealDocument\HealDocument $doc = null)
```
Creates a new `Fragment`. If `$doc` is supplied, the internal `DOMDocumentFragment` is created using the that.

#### Parameters
Parameter | Description
--- | ---
`doc` | The document the fragment should be created from. If none is supplied, an internal [`HealDocument`](#class-healdocument) is created.

### `Fragment::appendTo`
#### Description
```PHP
public TRP\HealDocument\Fragment::appendTo(DOMNode $parent): bool
```
Appends all children of the fragment to the supplied parent element.
This method is called when calling `$parent->fr($fragment);` which is the intended use.

#### Parameters
Parameter | Description
--- | ---
`parent` | The new parent node of the nodes in the fragment.

#### Return Values
Returns `true` on success or `false` on failure.

### `Fragment::at`
#### Exceptions
This method always throws an exception when called on the `Fragment` class.

---

## Abstract Class: Wrapper
```PHP
abstract class TRP\HealDocument\Wrapper implements TRP\HealDocument\Component {
	/* Properties */
	protected TRP\HealDocument\Component $primary_element;

	/* Methods */
	public el(string $name, array $attributes = [], bool $append = false): TRP\HealDocument\Component;
	public at(array $values, bool $append = false): TRP\HealDocument\Component;
	public te(string $str, bool $break_on_newline = false): TRP\HealDocument\Component;
	public co(string $str): TRP\HealDocument\Component;
	public fr(string|TRP\HealDocument\Fragment $contents): bool;
	public __call(string $name, array $arguments): ?TRP\HealDocument\Component;
```
A wrapper around an internal [`Component`](#interface-component) implementing object stored in the protected attribute `$primary_element`.
It is meant to aid in implementing plugins for heal-document.
The methods from `Component` is implemented as plain wrappers calling the equivalent methods on the internal `$primary_element`.

An implementing class can generate complex structures in the constructor, and additional methods can be defined that is only available on those specific components.

---

## Interface: PluginInterface
```PHP
interface TRP\HealDocument\PluginInterface {
	public static can_create(string $name): bool;
	public static create(Component $parent, string $name, ...$arguments): Component;
}
```
The basic interface a plugin for HealDocument is required to implement.

### PluginInterface::can_create
```PHP
public static TRP\HealDocument\PluginInterface::can_create(string $name): bool
```
Called by `HealDocument::try_plugin` to check whether a plugin can create a component of the given `$name`. If it returns false `HealDocument::try_plugin` looks for other plugins to create the component.

### PluginInterface::create
```PHP
public static TRP\HealDocument\PluginInterface::create(Component $parent, string $name, ...$arguments): Component
```
Called by `HealDocument::try_plugin` when the plugin must create a component of the given `$name`.

---

## Abstract Class: Plugin
```PHP
abstract class TRP\HealDocument\Plugin extends TRP\HealDocument\Wrapper implements TRP\HealDocument\PluginInterface {
	public static Plugin::can_create(string $name): bool;
	public static Plugin::create(TRP\HealDocument\Component $parent, string $name, ...$arguments): TRP\HealDocument\Component;
}
```
### Plugin::can_create
#### Description
```PHP
public static TRP\HealDocument\PluginInterface::can_create(string $name): bool
```

#### Return Values
Returns `true` if the class has a static method of the given `$name`.

### HealPlugin::create
#### Description
```PHP
public static TRP\HealDocument\Plugin::create(TRP\HealDocument\Component $parent, string $name, ...$arguments): TRP\HealDocument\Component
```
Attempts to create a component by calling the static method named `$name` on itself with `$parent` and `...$arguments` as parameters: `static::$name($parent, ...$arguments)`;
If the created component is an instance of the class this method is called on and `$primary_element` isn't defined, then the `$parent` object is assigned to `$primary_element`.

#### Parameters
Parameters | Description
--- | ---
`$parent` | A [`Component`](#interface-component) intended to be the parent node of the created component.
`$name` | The name of the static method to call to create the component.
`$arguments` | Additional arguments for the static method creating the component.

#### Return Values
Returns the newly created component as an object implementing `Component`.

#### Exceptions
An exception is thrown if the static method `$name` doesn't exist or it fails to return an object implementing `Component`.
