<?php

namespace SimpleForum;

interface DataObject {
	static function select(/*int[]*/ $ids = []) /*: Getable[]*/;
	function insert();
	function update();
	function delete();
}
