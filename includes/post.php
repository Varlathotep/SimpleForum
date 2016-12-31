<?php

namespace SimpleForum;

class post implements DataObject {
	use Commitable;
	use Getable;

	private /*string*/ $_title = null;
	private /*User*/ $_poster = null;
	private /*Topic*/ $_topic = null;
	private /*DateTime*/ $_postDate = null;
	private /*DateTime*/ $_editDate = null;
	private /*User*/ $_editor = null;
	private /*string*/ $_body = null;
	private /*bool*/ $_deleted = false;
	private /*string*/ $_deleteMessage = null;

	public function __construct(/*string*/ $title, User $poster = null, Topic $topic = null, /*DateTime*/ $postDate = null, /*DateTime*/ $editDate = null, User $editor = null, /*string*/ $body = null, /*bool*/ $deleted = false, /*string*/ $deleteMessage = null) {
		$this->_title = $title;
		$this->_poster = $poster;
		$this->_topic = $topic;
		$this->_postDate = $postDate;
		$this->_editDate = $editDate;
		$this->_editor = $editor;
		$this->_body = $body;
		$this->_deleted = $deleted;
		$this->_deletedMessage = $deletedMessage;
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
