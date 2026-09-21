<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/trp-solutions/HealDocument/blob/main/LICENSE
*/
declare(strict_types=1);
namespace TRP\HealDocument;

interface Component {
	public function el(string $name, array $attributes = [], bool $append = false): Component;
	public function at(array $values, bool $append = false): Component;
	public function te(string $str, bool $break_on_newline = false): Component;
	public function co(string $str): Component;
	public function fr(string|Fragment $contents): bool;
}
