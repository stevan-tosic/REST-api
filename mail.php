<?php
if ( isset($_GET['test']) && !is_null($_GET['test']) ) 
	{
	echo('script start');	
	}

error_reporting(E_ALL);
//clearstatcache();

require_once ('core/class.DbCommonConnect.php');
require_once ('core/class.suggestion.php');

if ( isset($_GET['test']) && !is_null($_GET['test']) ) 
	{
	echo(' and works fine');
	}
?>