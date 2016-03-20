<?php
//error_reporting(E_ALL);
//clearstatcache();

header("Content-Type:application/json");

require_once ('core/class.rest.php');
require_once ('core/class.users.php');
require_once ('core/class.books.php');	

$books = new Books; 
$users = new Users();

$users->insertDataIntoDB($_POST['username'], $_POST['password']);

$offset 	= ( ($curr_page - 1) * 10);

if ( isset($_GET['id']) && !is_null($_GET['id']) ) { 
	$books->method_GET_response($_GET['id'], "getAuthor");
} 
if ( isset($_GET['page']) && !is_null($_GET['page']) ) {
	$books->method_GET_response($_GET['page'], "getDataPerPage");
} 
if ( $_GET['rows'] === "all") {
	$books->deliver_response(200, "data found", $books->numOfTableRows() );
}
if ( isset($_POST['name']) && isset($_POST['author']) && isset($_POST['year']) && isset($_POST['language']) &&
		!is_null($_POST['name']) && !is_null($_POST['author']) && !is_null($_POST['year']) && !is_null($_POST['language']) ) {
	if ( !isset($_POST['update']) || is_null($_POST['update']) ) {
		echo json_encode($_POST);
		$books->insertBookData($_POST['name'],$_POST['author'],$_POST['year'],$_POST['language'],$_POST['langOrig']);
	} else {
		$books->updateBookData($_POST['name'],$_POST['author'],$_POST['year'],$_POST['language'],$_POST['langOrig'],$_POST['update']);
	}
}
if ( isset($_POST['del']) && !is_null($_POST['del'])  ) {
	$books->deleteBookData($_POST['del']);
}

?>
