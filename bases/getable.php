<?php

namespace SimpleForum;

trait Getable {
	public static function get(/*int[]*/ $ids = []) /*: Getable[]*/ {
		/*int*/ $count = \count($ids);
		/*bool*/ $isSingleId = \is_numeric($ids);
		/*Getable[]*/ $resultSet = null;
		if ($isSingleId) {
			$resultSet = self::select([$ids]);
		}
		else {
			$resultSet = self::select($ids);
		}
		return $resultSet;
	}
}
