<?php

class PGSQL {
	private $_conn = null;
	private $_lastResult = null;
	private $_lastStatement = null;
	private $_async = false;

	public function __construct(string $connection_string, int $connection_Type = null, bool $async = false) {
		$this->_conn = pg_connect($connection_string, $connection_type);
		$err = pg_last_error($this->_conn);
		if ($err) {
			$this->_error = true;
			$this->_lastError = $err;
			$this->_errors[] = $err;
		}
		$this->_async = $async;
	}

	public function returnLastResult() {
		return $this->_lastResult;
	}

	public function returnLastStatement() {
		return $this->_lastStatement;
	}

	public function cancelQuery() : bool {
		if (is_resource($this->_conn)) {
			return pg_cancel_query($this->_conn);
		}
		return false;
	}

	public function clientEncoding() {
		if (is_resource($this->_conn)) {
			return pg_client_encoding($this->_conn);
		}
		return false;
	}

	public function close() : bool {
		if (is_resource($this->_conn)) {
			return pg_close($this->_conn);
		}
		return false;
	}

	public function pollConnection() : int {
		if (is_resource($this->_conn) && $this->_async) {
			return pg_connect_poll($this->_conn);
		}
		return PGSQL_POLLING_FAILED;
	}

	public function isBusy() : bool {
		if (is_resource($this->_conn)) {
			return pg_connection_busy($this->_conn);
		}
		return false;
	}

	public function reset() : bool {
		if (is_resource($this->_conn)) {
			return pg_connection_reset($this->_conn);
		}
		return false;
	}

	public function status() : int {
		if (is_resource($this->_conn)) {
			return pg_connection_status($this->_conn);
		}
		return PGSQL_CONNECTION_BAD;
	}

	public function consumeInput() : bool {
		if (is_resource($this->_conn)) {
			return pg_consume_input($this->_conn);
		}
		return false;
	}

	public function convert(string $table_name,	array $assoc_array, int $options = 0) {
		if (is_resource($this->_conn)) {
			return pg_convert($this->_conn, $table_name, $assoc_array, $options);
		}
		return false;
	}

	public function copyFrom(string $table_name, array $rows, string $delimiter = null,	string $null_as = null) : bool {
		if (is_resource($this->_conn)) {
			return pg_copy_from($this->_conn, $table_name, $rows, $delimiter, $null_as);
		}
		return false;
	}

	public function copyTo(string $table_name, string $delimiter, string $null_as = null) {
		if (is_resource($this->_conn)) {
			return pg_copy_to($this->_conn, $table_name, $delimiter, $null_as);
		}
		return false;
	}

	public function dbName() {
		if (is_resource($this->_conn)) {
			return pg_dbname($this->_conn);
		}
		return false;
	}

	public function delete(string $table_name, array $assoc_array, int $options = PGSQL_DML_EXEC) {
		if (is_resource($this->_conn)) {
			return pg_delete($this->_conn, $table_name, $assoc_array, $options);
		}
		return false;
	}

	public function endCopy() : bool {
		if (is_resource($this->_conn)) {
			return pg_end_copy($this->_conn);
		}
		return false;
	}

	public function escapeByteA(string $data) {
		if (is_resource($this->_conn)) {
			return pg_escape_bytea($this->_conn, $data);
		}
		return false;
	}

	public function escapeIdentifier(string $data) {
		if (is_resource($this->_conn)) {
			return pg_escape_identifier($this->_conn, $data);
		}
		return false;
	}

	public function escapeLiteral(string $data) {
		if (is_resource($this->_conn)) {
			return pg_escape_literal($this->_conn, $data);
		}
		return false;
	}

	public function escapeString(string $data) {
		if (is_resource($this->_conn)) {
			return pg_escape_string($this->_conn, $data);
		}
		return false;
	}

	public function flush() {
		if (is_resource($this->_conn)) {
			return pg_flush($this->_conn);
		}
		return false;
	}

	public function getNotification(int $result_type = null) {
		if (is_resource($this->_conn)) {
			return pg_get_notify($this->_conn, $result_type);
		}
		return false;
	}

	public function getPid() {
		if (is_resource($this->_conn)) {
			return pg_get_pid($this->_conn);
		}
		return false;
	}

	public function getResult() {
		if (is_resource($this->_conn)) {
			$result = new PGSQLResult(pg_get_result($this->_conn), $this);
			$this->_lastResult = $result;
			$this->_results[] = $result;
			return $result;
		}
		return false;
	}

	public function getHost() {
		if (is_resource($this->_conn)) {
			return pg_host($this->_conn);
		}
		return false;
	}

	public function insert(string $table_name, array $assoc_array, int $options = PGSQL_DML_EXEC) {
		if (is_resource($this->_conn)) {
			return pg_insert($this->_conn, $table_name, $assoc_array, $options);
		}
		return false;
	}

	public function lastError() {
		if (is_resource($this->_conn)) {
			return pg_last_error($this->_conn);
		}
		return false;
	}

	public function lastNotice() {
		if (is_resource($this->_conn)) {
			return pg_last_notice($this->_conn);
		}
		return false;
	}

	public function lastOid() {
		if (is_resource($this->_conn)) {
			return pg_last_oid($this->_conn);
		}
		return false;
	}

	public function createLargeObject($oid = null) {
		if (is_resource($this->_conn)) {
			return pg_lo_create($this->_conn, $oid);
		}
		return false;
	}

	public function openLargeObject($oid, $mode) {
		if (is_resource($this->_conn)) {
			return new PGSQLLargeObject(pg_lo_open($this->_conn, $oid, $mode), $this);
		}
		return false;
	}

	public function exportLargeObject(int $oid, $pathname) {
		if (is_resource($this->_conn)) {
			return pg_lo_export($this->_conn, $oid, $pathname);
		}
		return false;
	}

	public function importLargeObject(string $pathname, int $oid = null) {
		if (is_resource($this->_conn)) {
			return pg_lo_import($this->_conn, $pathname, $oid);
		}
		return false;
	}

	public function unlinklargeObject(int $oid) {
		if (is_resource($this->_conn)) {
			return pg_lo_unlink($this->_conn, $oid);
		}
		return false;
	}

	public function tableMetaData(string $table_name, bool $extended = null) {
		if (is_resource($this->_conn)) {
			return pg_meta_data($this->_conn, $table_name, $extended);
		}
		return false;
	}

	public function options() {
		if (is_resource($this->_conn)) {
			return pg_options($this->_conn);
		}
		return false;
	}

	public function parameterStatus(string $param_name) {
		if (is_resource($this->_conn)) {
			return pg_parameter_status($this->_conn, $param_name);
		}
		return false;
	}

	public function pconnect(...$params) {
		throw new BadMethodCallException();
	}

	public function ping() {
		if (is_resource($this->_conn)) {
			return pg_ping($this->_conn);
		}
		return false;
	}

	public function port() {
		if (is_resource($this->_conn)) {
			return pg_port($this->_conn);
		}
		return false;
	}

	public function prepare(string $stmtname, string $query) {
		if (is_resource($this->_conn)) {
			$statement = new PGSQLStatement(pg_prepare($this->_conn, $stmtname, $query), $this);
			$this->_lastStatement = $statement;
			return $statement;
		}
		return false;
	}

	public function putLine(string $data) {
		if (is_resource($this->_conn)) {
			return pg_put_line($this->_conn, $data);
		}
		return false;
	}

	public function paramQuery(string $query, array $params) {
		if (is_resource($this->_conn)) {
			$result = new PGSQLResult(pg_query_params($this->_conn, $query, $params), $this);
			$this->_lastResult = $result;
			return $result;
		}
		return false;
	}

	public function query(string $query) {
		if (is_resource($this->_conn)) {
			$result = new PGSQLResult(pg_query($this->_conn, $query), $this);
			$this->_lastResult = $result;
			return $result;
		}
		return false;
	}

	public function select(string $table_name, array $assoc_array, int $options = PGSQL_DML_EXEC) {
		if (is_resource($this->_conn)) {
			$result = new PGSQLResult(pg_select($this->_conn, $table_name, $assoc_array, $options));
			$this->_lastResult = $result;
			return $result;
		}
		return false;
	}

	public function execute(string $stmt_name, array $params) {
		if (is_resource($this->_conn)) {
			$result = new PGSQLResult(pg_execute($this->_conn, $stmt_name, $params), $this);
			$this->_lastResult = $result;
			return $result;
		}
		return false;
	}

	public function sendExecute(string $stmt_name, array $params) {
		if (is_resource($this->_conn)) {
			return pg_send_execute($this->_conn, $stmt_name, $params);
		}
		return false;
	}

	public function sendPrepare(string $stmt_name, string $query) {
		if (is_resource($this->_conn)) {
			return pg_send_prepare($this->_conn, $stmt_name, $query);
		}
		return false;
	}

	public function sendParamQuery(string $query, array $params) {
		if (is_resource($this->_conn)) {
			return pg_send_query_params($this->_conn, $query, $params);
		}
		return false;
	}

	public function sendQuery(string $query) {
		if (is_resource($this->_conn)) {
			return pg_send_query($this->_conn, $query);
		}
		return false;
	}

	public function setClientEncoding(string $encoding) {
		if (is_resource($this->_conn)) {
			return pg_set_client_encoding($this->_conn, $encoding);
		}
		return false;
	}

	public function setErrorVerbosity(int $verbosity) {
		if (is_resource($this->_conn)) {
			return pg_set_error_verbosity($this->_conn, $verbosity);
		}
		return false;
	}

	private function socket() {
		if (is_resource($this->_conn)) {
			return pg_socket($this->_conn);
		}
		return false;
	}

	public function trace(string $pathname, string $mode = 'w') {
		if (is_resource($this->_conn)) {
			return pg_trace($pathname, $mode, $this->_conn);
		}
		return false;
	}

	public function transactionStatus() {
		if (is_resource($this->_conn)) {
			return pg_transaction_status($this->_conn);
		}
		return false;
	}

	private function tty() {
		if (is_resource($this->_conn)) {
			return pg_tty($this->_conn);
		}
		return false;
	}

	public function unescapeByteA(string $data) {
		return pg_unescape_bytea($data);
	}

	public function untrace() {
		if (is_resource($this->_conn)) {
			return pg_untrace($this->_conn);
		}
		return false;
	}

	public function update(string $table_name, array $data, array $condition, int $options = PGSQL_DML_EXE) {
		if (is_resource($this->_conn)) {
			return pg_update($this->_conn, $table_name, $data, $condition, $options);
		}
		return false;
	}

	public function version() {
		if (is_resource($this->_conn)) {
			return pg_version($this->_conn);
		}
		return false;
	}
}

class PGSQLStatement {
	private $_statement = null;
	private $_conn = null;
	private $_lastResult = null;
	private $_results = [];
	
	public function __construct($statement, PGSQL $conn) {
		$this->_statement = $statement;
		$this->_conn = $conn;
	}
}

class PGSQLLargeObject {
	private $_lo = null;
	private $_conn = null;
	
	public function __construct($lo, PGSQL $conn) {
		$this->_lo = $lo;
		$this->_conn = $conn;
	}

	public function close() {
		if (is_resource($this->_lo)) {
			return pg_lo_close($this->_lo);
		}
		return false;
	}

	public function readAll() {
		if (is_resource($this->_lo)) {
			return pg_lo_read_all($this->_lo);
		}
		return false;
	}

	public function read(int $size = 8192) {
		if (is_resource($this->_lo)) {
			return pg_lo_read($this->_lo, $size);
		}
		return false;
	}

	public function seek(int $offset, int $whence = PGSQL_SEEK_CUR) {
		if (is_resource($this->_lo)) {
			return pg_lo_seek($this->_lo, $offset, $whence);
		}
		return false;
	}

	public function tell() {
		if (is_resource($this->_lo)) {
			return pg_lo_tell($this->_lo);
		}
		return false;
	}

	public function truncate(int $size = 8192) {
		if (is_resource($this->_lo)) {
			return pg_lo_truncate($this->_lo, $size);
		}
		return false;
	}

	public function write(string $data, int $len = null) {
		if (is_resource($this->_lo)) {
			return pg_lo_write($this->_lo, $data, $len);
		}
		return false;
	}
}

class PGSQLResult {
	private $_result = null;
	private $_conn = null;

	public function __construct($result, PGSQL $conn) {
		$this->_result = $result;
		$this->_conn = $conn;
	}

	public function resultErrorField(int $fieldcode) {
		if (is_resource($this->_result)) {
			return pg_result_error_field($this->_result, $fieldcode);
		}
		return false;
	}

	public function resultError() {
		if (is_resource($this->_result)) {
			return pg_result_error($this->_result);
		}
		return false;
	}

	public function seek(int $offset) {
		if (is_resource($this->_result)) {
			return pg_result_seek($this->_result, $offset);
		}
		return false;
	}
	
	public function status(int $type = PGSQL_STATUS_LONG) {
		if (is_resource($this->_result)) {
			return pg_result_status($this->_result, $type);
		}
		return false;
	}

	public function numberOfFields() {
		if (is_resource($this->_result)) {
			return pg_num_fields($this->_result);
		}
		return false;
	}

	public function numberOfRows() {
		if (is_resource($this->_result)) {
			return pg_num_rows($this->_result);
		}
		return false;
	}

	public function freeResult() : bool {
		if (is_resource($this->_result)) {
			return pg_free_result($this->_result);
		}
		return false;
	}

	public function affectedRows() : int {
		if (is_resource($this->_result)) {
			return pg_affected_rows($this->_result);
		}
		return 0;
	}

	public function fetchAllColumns(int $column = 0) {
		if (is_resource($this->_result)) {
			return pg_fetch_all_columns($this->_result, $column);
		}
		return false;
	}

	public function fetchAll() {
		if (is_resource($this->_result)) {
			return pg_fetch_all($this->_result);
		}
		return false;
	}

	public function fetchArray(int $row = null, int $result_type = PGSQL_BOTH) {
		if (is_resource($this->_result)) {
			return pg_fetch_array($this->_result, $row, $result_type);
		}
		return false;
	}

	public function fetchAssoc(int $row = null) {
		if (is_resource($this->_result)) {
			return pg_fetch_assoc($this->_result, $row);
		}
		return false;
	}

	public function fetchObject(...$params) {
		$paramCount = count($params);
		if ($paramCount === 0 || $paramCount === 1 || is_numeric($params[1])) {
			return call_user_func_array([$this, 'fetchObjectii'], $params);
		}
		else {
			return call_user_func_array([$this, 'fetchObjectisa'], $params);
		}
	}

	private function fetchObjectii(int $row = null, int $result_type = PGSQL_ASSOC) {
		if (is_resource($this->_result)) {
			return pg_fetch_object($this->_result, $row, $result_type);
		}
		return false;
	}

	private function fetchObjectisa(int $row = null, string $class_name = null, array $params = null) {
		if (is_resource($this->_result)) {
			return pg_fetch_object($this->_result, $row, $class_name, $params);
		}
		return false;
	}

	public function fetchResult(...$params) {
		if (count($params) === 1) {
			return $this->fetchResultm($params[0]);
		}
		else {
			return $this->fetchResultim($params[0], $params[1]);
		}
	}

	private function fetchResultim(int $row, $field) {
		if (is_resource($this->_result)) {
			return pg_fetch_result($this->_result, $row, $field);
		}
		return false;
	}

	private function fetchResultm($field) {
		if (is_resource($this->_result)) {
			return pg_fetch_result($this->_result, $field);
		}
		return false;
	}

	public function fetchRow(int $row = null) {
		if (is_resource($this->_result)) {
			return pg_fetch_row($this->_result, $row);
		}
		return false;
	}

	public function fieldIsNull(...$params) {
		if (count($params) === 1) {
			$this->fieldIsNullm($params[0]);
		}
		else {
			$this->fieldIsNullim($params[0], $params[1]);
		}
	}

	private function fieldIsNullim(int $row, $field) {
		if (is_resource($this->_result)) {
			return pg_field_is_null($this->_result, $row, $field);
		}
		return false;
	}

	private function fieldIsNullm($field) {
		if (is_resource($this->_result)) {
			return pg_field_is_null($this->_result, $field);
		}
		return false;
	}

	public function fieldName(int $field_number) {
		if (is_resource($this->_result)) {
			return pg_field_name($this->_result, $field_number);
		}
		return false;
	}

	public function fieldNumber(string $field_name) {
		if (is_resource($this->_result)) {
			return pg_field_num($this->_result, $field_name);
		}
	}

	public function fieldPrintedLength(...$params) {
		throw new BadMethodCallException();
	}

	public function fieldSize(int $field_number) {
		if (is_resource($this->_result)) {
			return pg_field_size($this->_result, $field_number);
		}
		return false;
	}

	public function fieldTable(int $field_number, bool $oid_only = false) {
		if (is_resource($this->_result)) {
			return pg_field_size($this->_result, $field_number, $oid_only);
		}
		return false;
	}

	public function fieldTypeOid(int $field_number) {
		if (is_resource($this->_result)) {
			return pg_field_type_oid($this->_result, $field_number);
		}
		return false;
	}

	public function fieldType(int $field_number) {
		if (is_resource($this->_result)) {
			return pg_field_type($this->_result, $field_number);
		}
		return false;
	}
}

