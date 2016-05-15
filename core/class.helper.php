<?php
/**
* 
*/
class Helper {
	private $test;
	private $documentation;

	public function getRequest ($uri) 
		{
		return (isset($_GET[$uri]) && !is_null($_GET[$uri]));
		} 

	public function testStart() 
		{
		if ($this->test) 
			{
			error_reporting(E_ALL);
			echo('Script start');	
			}
		}

	public function testEnd() 
		{
		if ($this->test) 
			{
			echo ' and works fine.';
			}
		}

	public function header() 
		{
		if(!$this->test && !$this->documentation)
			{
			return header("Content-Type:application/json");
			}
		}
	
	function __construct()
	{
		$this->test 			= $this->getRequest('test') ? true : false;
		$this->documentation 	= $this->getRequest('documentation') ? true : false;
	}
}
?>