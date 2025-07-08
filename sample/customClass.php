<?php
/*
HealDocument is licensed under the Apache License 2.0 license
https://github.com/TRP-Solutions/heal-document/blob/master/LICENSE.txt
*/
declare(strict_types=1);
require_once __DIR__.'/../lib/HealDocument.php';
use \TRP\HealDocument\{HealDocument, Element, Component};

trait htmlDesignTrait {
	// Added function
	public function button($value, $onclick = null) {
		$input = $this->el('input',['type'=>'button','value'=>$value]);
		if($onclick) {
			$input->at(['onclick'=>$onclick]);
		}
		return $input;
	}

	// Required precedence
	protected static function createElementHeal($name) : Component {
		return new htmlDesignElement($name);
	}
}

class htmlDesign extends HealDocument {
	use htmlDesignTrait;
}

class htmlDesignElement extends Element {
	use htmlDesignTrait;
}

$doc = new htmlDesign();
$doc->button('Test',"alert('click!');");
echo $doc;
