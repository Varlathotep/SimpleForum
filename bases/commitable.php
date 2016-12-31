<?php

namespace SimpleForum;

trait Commitable {
	protected /*int*/ $_id = null;
	protected /*bool*/ $_markForDelete = false;

	public function getId() /*: int*/ {
		return $this->_id;
	}

	public function setId(/*int*/ $id) {
		//We need to be absolutely sure the ID is an integer. Nothing, and I mean NOTHING, else should be allowed in this field. We also want to coerce the value into an integer
		//just in case it's an integer string.
		if ((\is_integer($id) || \ctype_digit($id)) && \is_null($this->_id)) {
			$this->_id = intval($id);
		}
		else if (\is_integer($this->_id)) {
			throw new RewriteException('_id', true, __CLASS__);
		}
		else {
			//Well, Jim, looks like we encountered some bad juju here. The type wasn't correct.
			throw new TypeException('_id', 'integer', \gettype($id), true, __CLASS__);
		}
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
