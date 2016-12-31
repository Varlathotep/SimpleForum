<?php
namespace SimpleForum;

class Router {
	private /*object*/ $_parsedRoute;
	private static /*Router*/ $_instance;

	/**
	  Returns a new Router object, either by checking to see if the instance exists, or by returning a new one if the instance doesn't exist.
	  @param $path string A parameter defaulted to null containing an unparsed path string.
	  @return Router An instance of the Router object.
	 */
	public static function getSingleton(/*string*/ $path = null) /*: Router*/ {
		if (empty(self::$_instance)) {
			self::$_instance = new Router($path);
		}
		return self::$_instance;
	}

	/**
	  Constructs the Router class.
	  @param $path string A parameter containing an unparsed path string.
	 */
	private function __construct(/*string*/ $path) {
		if (!empty($path)) {
			/*string*/ $workingPath = \trim($path, '/');
			/*string[]*/ $splitPath = \explode('/', $workingPath);
			/*string[]*/ $intermediatePath = [];
			foreach ($splitPath as /*string*/ $pathPart) {
				/*string*/ $workingPathPart = \trim($pathPart);
				if (!\is_empty($workingPathPart)) {
					$intermediatePath[] = $workingPathPart;
				}
			}
			//We're going to create the route here. Ye be fore warned, travella. Shit's about to get strange.
			/*int*/ $count = \count($intermediatePath);
			if ($count > 0) {
				/*string*/ $name = $intermediatePath[0];
				if ($name == 'index') {
					$this->_parsedRoute = new Index();
				}
				else if ($name == 'forum') {
					$this->_parsedRoute = new Forum();
				}
				else if ($name == 'topic') {
					$this->_parsedRoute = new Topic();
				}
				else if ($name == 'post') {
					$this->_parsedRoute = new Post();
				}
				else if ($name == 'admin') {
					$this->_parsedRoute = new Admin();
				}
				else {
					throw new \Exception('Unrecognized path was found!');
				}
				//We need to prepare the statement so we want to check to see if the intermediate path contains values. If it does, we're good to set up the prepared command.
				if ($count > 1) {
					$this->_parsedRoute->prepareCommand($intermediatePath[1]);
					if ($count > 2) {
						$this->_parsedRoute->prepareParameters(\array_slice($intermediatePath, 1));
					}
				}
			}
		}
		else {
			$this->_parsedRoute = new Index();
		}
	}
}
