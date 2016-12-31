<?php

namespace SimpleForum;

class Forum implements DataObject {
	use Commitable;
	use Getable;
	private /*string*/ $_title = null;
	private /*string*/ $_description = null;
	private /*DateTime*/ $_forumDate;
	private /*string*/ $_password = null;
	private /*Forum*/ $_parent = null;
	private /*Topic*/ $_lastTopic = null;
	private /*User*/ $_lastPoster = null;
	private /*DateTime*/ $_lastPostDate = null;
	private /*int*/ $_totalTopics = 0;
	private /*int*/ $_totalPosts = 0;
	private /*User[]*/ $_moderators = [];

	public function __construct(/*string*/ $title, /*string*/ $description = null, /*DateTime*/ $forumDate = null, /*string*/ $password = null, Forum $parent = null, Topic $lastTopic = null, User $lastPoster = null, /*DateTime*/ $lastPostDate = null, /*int*/ $totalTopics = null, /*int*/ $totalPosts = null, /*User[]*/ $moderators = []) {
		$this->_title = $title;
		$this->_description = $description;
		$this->_forumDate = $forumDate;
		$this->_password = $password;
		$this->_parent = $parent;
		$this->_lastTopic = $lastTopic;
		$this->_lastPoster = $lastPoster;
		$this->_lastPostDate = $lastPostDate;
		$this->_totalTopics = $totalTopics;
		$this->_totalPosts = $totalPosts;
		$this->_moderators = $moderators;
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
