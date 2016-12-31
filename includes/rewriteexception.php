<?php

namespace SimpleForum;

class RewriteException extends \Exception {
	use Commitable;

	public function __construct(/*string*/ $parameterName, /*bool*/ $isProperty = false, /*string*/ $class = null, /*int*/ $code = 0, \Exception $previous = null) {
		/*string*/ $message = 'The ';
		if ($isProperty) {
			$message .= "property $class::";
		}
		else {
			$message .= 'parameter ';
		}
		$message .= "$parameterName cannot be overwritten but a new value has been assigned to it.";
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
}
