<?php

namespace SimpleForum;

trait Commitable {
	protected /*int*/ $_id = null;
	protected /*bool*/ $_markForDelete = false;

	public function getId() /*: int*/ {
		return $this->_id;
	}

	public function setId(/*int*/ $id) {
		$this->_id = $id;
	}

	public function commit() {
		/*bool*/ $idAvailable = \is_numeric($this->_id);
		if ($idAvailable && $this->_markForDelete) {
			$this->delete();
		}
		else if ($idAvailable) {
			$this->update();
		}
		else {
			$this->insert();
		}
	}
}
