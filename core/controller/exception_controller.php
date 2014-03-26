<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/exception/LiveschoolException.php");
function liveschoolError($errno, $errstr, $errfile, $errline)
{
	throw new LiveschoolException($errstr);
}

set_error_handler("liveschoolError",E_ALL & ~E_NOTICE & ~E_USER_NOTICE);