<?php

namespace SimpleForum;

class Topic implements DataObject {
	use Commitable;
	use Getable;

	private /*string*/ $_title = null;
	private /*Forum*/ $_forum = null;
	private /*User*/ $_poster = null;
	private /*DateTime*/ $_topicDate = null;
	private /*bool*/ $_sticky = false;
	private /*User*/ $_lastPoster = null;
	private /*DateTime*/ $_lastPostDate = null;
	private /*Post[]*/ $_posts = [];

	public function __construct(/*string*/ $title, Forum $forum = null, User $poster = null, /*DateTime*/ $topicDate = null, /*bool*/ $sticky = false, User $lastPoster = null, /*DateTime*/ $lastPostDate = null, /*Post[]*/ $posts = []) {

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
