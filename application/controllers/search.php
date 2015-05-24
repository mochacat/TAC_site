<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	
	function Search()
	{
		parent::Controller();

		$this->load->model('search_model');
	}
	
	
	function index()
	{

		parse_str($_SERVER['QUERY_STRING'],$_GET);
	}
	
	
	function isAjax() 
	{
	return(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
	}
	
}

?>