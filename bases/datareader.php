<?php

namespace SimpleForum;

interface DataReader {
	static function select(/*int[]*/ $ids = []) /*: Getable[]*/;
}
