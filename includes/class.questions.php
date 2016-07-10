<?php
require_once'config.php';
require_once'class.Db.php';
class Question extends Db{
	public $handle;
	public $fileType;
	
	public function __construct() {
	
		
  	}
		
  	
	
	function load_question($id){
	return $this->loadQuestion($id);
	}
	
}
?>
