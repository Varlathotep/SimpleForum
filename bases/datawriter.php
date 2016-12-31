<?php

namespace SimpleForum;

interface DataWriter {
	function insert();
	function update();
	function delete();
}
