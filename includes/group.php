<?php

namespace SimpleForum;

class Group implements DataObject {
	use Commitable;
	use Getable;

	private /*string*/ $_name = null;
	private /*string*/ $_description = null;
	private /*User*/ $_owner = null;
	private /*Forum[]*/ $_accessibleForums = [];

	public function __construct(/*string*/ $name, /*string*/ $description, User $owner, /*Forum[]*/ $accessibleForums = []) {
		$this->_name = $name;
		$this->_description = $description;
		$this->_owner = $owner;
		$this->_accessibleForums = $accessibleForums;
	}

	public function insert() {

	}

	public function update() {

	}

	public function delete() {

	}

	public static function select(/*int[]*/ $ids = []) /*: Getable*/ {
		
	}
}
