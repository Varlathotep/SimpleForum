<?php
namespace SimpleForum;
if (empty($_GET['q'])) {
	$_GET['q'] = '';
}
function autoload(/*string*/ $name) {
	/*string*/ $workingFileName = \strToLower($name) . '.php';
	/*int*/ $pos = strpos($workingFileName, '\\');
	if ($pos !== false) {
		$workingFileName = substr($workingFileName, $pos + 1);
	}
	if (\file_exists('bases/' . $workingFileName)) {
		require_once('bases/' . $workingFileName);
	}
	else if (\file_exists('includes/' . $workingFileName)) {
		require_once('includes/' . $workingFileName);
	}
	else {
		throw new AutoloadException($name);
	}
}

\spl_autoload_register('SimpleForum\autoload');

/*Router*/ $router = Router::getSingleton($_GET['q']);

//I don't normally do this but this class is used to signify when autoload has failed.
class AutoloadException extends \Exception {
	public function __construct(/*string*/ $className, /*int*/ $code = 0, \Exception $previous = null) {
		/*string*/ $message = "The class $className couldn't be found. No file existed that defines it. Please verify that the class is defined and is located in either the 'bases', 'includes' or 'modules' directories.";
		parent::__construct($message, $code, $previous);
	}

	public function __toString() {
		return __CLASS__ . " : [{$this->code}]: {$this->message}\n";
	}
}

$test = new Post();
