<?php

interface PreparedRoute {
	prepareCommand(/*string*/ $commandName);
	prepareParameters(/*object[]*/ $commandParameters);
	executeCommand();
}
