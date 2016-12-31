<?php

namespace SimpleForum;

class User implements DataObject {
	use Commitable;
	use Getable;

	private /*string*/ $_username = null;
	private /*Group[]*/ $_groups = [];
	private /*string*/ $_avatar = null;
	private /*int*/ $_posts = 0;
	private /*int*/ $_paygrade = null;
	private /*bool*/ $_member = false;
	private /*DateTime*/ $_lastLogin = null;
	private /*DateTime*/ $_lastReadAll = null;
	private /*DateTime[int]*/ $_lastRead = [];

	public function __construct(/*string*/ $username, /*Group[]*/ $groups = [], /*string*/ $avatar = null, /*int*/ $posts = 0, /*int*/ $paygrade = null, /*bool*/ $member = false, /*DateTime*/ $lastLogin = null, /*DateTime*/ $lastReadAll = null, /*DateTime[int]*/ $lastRead = []) {
		$this->_username = $username;
		$this->_groups = $groups;
		$this->_posts = $posts;
		$this->_avatar = $avatar;
		$this->_paygrade = $paygrade;
		$this->_member = $member;
		$this->_lastLogin = $lastLogin;
		$this->_lastReadAll = $lastReadAll;
		$this->_lastRead = $lastRead;
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
