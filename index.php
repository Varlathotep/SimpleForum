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
