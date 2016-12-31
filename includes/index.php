<?php

namespace SimpleForum;

class Index {
	use Commitable;
	use Getable;

	private /*Forum[]*/ $_forums = [];
	private /*User[]*/ $_admins = [];
	private /*int*/ $_activeUsers = 0;
	private /*int*/ $_totalForums = 0;
	private /*int*/ $_totalTopics = 0;
	private /*int*/ $_totalPosts = 0;
	private /*string*/ $_title = null;
	private /*string*/ $_description = null;
	private /*string*/ $_logo = null;

	public function insert() {

	}

	public function update() {

	}

	public function delete() {

	}

	public static function select(/*int[]*/ $ids = []) /*: Getable*/ {
		
	}
}
