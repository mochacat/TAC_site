<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dashboard extends Admin_Controller{
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function view(){
    		
			$this->template->set('title', 'The Alternative Chronicle Articles');
			$this->template->load('admin/header', 'template');
			$this->template->load('admin/dashboard', 'template');
			$this->template->load('admin/articles', 'template');
    }
}
	