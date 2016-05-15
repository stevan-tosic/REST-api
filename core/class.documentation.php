<?php
class Documentation extends Helper {

	public function docUrl($uri) 
		{
		return '<a href="http://'.$_SERVER['HTTP_HOST'].'/'.$uri.'">'.$_SERVER['HTTP_HOST'].'/?'.$uri.'</a> - ';
		}
	public function __construct() 
		{
		if ($this->getRequest('documentation')) 
			{
			$doc = array();
			array_push($doc, $this->docUrl('documentation') . 'List API url with description');
			array_push($doc, $this->docUrl('test') . 'Check errors and does script ends.'); 
			

			foreach($doc as $d)
				{
					echo $d . '<br />';
				}
			}		
		}
	
}
?>