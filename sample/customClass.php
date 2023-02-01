<?php
require_once __DIR__.'/../lib/HealDocument.php';

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
	protected static function createElementHeal($name) : HealComponent {
		return new htmlDesignElement($name);
	}
}

class htmlDesign extends HealDocument {
	use htmlDesignTrait;
}

class htmlDesignElement extends HealElement {
	use htmlDesignTrait;
}

$doc = new htmlDesign();
$doc->button('Test',"alert('click!');");
echo $doc;
