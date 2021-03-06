<?php

namespace SimpleForum;

class TypeException extends \Exception {
	use Commitable;

	public function __construct(/*string*/ $parameterName, /*string*/ $expectedType, /*string*/ $foundType, /*bool*/ $isProperty = false, /*string*/ $class = null, /*int*/ $code = 0, \Exception $previous = null) {
		/*string*/ $message = 'The ';
		if ($isProperty) {
			$message .= "property $class::";
		}
		else {
			$message .= 'parameter ';
		}
		$message .= "$parameterName expected the type $expectedType but $foundType was used instead. Please verify that the correct type is being passed.";
		parent::__construct($message, $code, $previous);
	}

	public function __toString() {
		return __CLASS__ . " : [{$this->code}]: {$this->message}\n";
	}

	public function insert() {

	}

	public function update() {

	}

	public function delete() {

	}

}
