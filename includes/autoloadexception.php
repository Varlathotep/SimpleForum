<?php

namespace SimpleForum;

class AutoloadException extends \Exception {
	use Commitable;
	
	public function __construct(/*string*/ $className, /*int*/ $code = 0, \Exception $previous = null) {
		/*string*/ $message = "The class $className couldn't be found. No file existed that defines it. Please verify that the class is defined and is located in either the 'bases', 'includes' or 'modules' directories.";
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
