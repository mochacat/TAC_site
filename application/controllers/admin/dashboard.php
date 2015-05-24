<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Dashboard extends Admin_Controller{
	
	function __construct()
    {
        parent::__construct();
    }
	
	public function view(){
    		
			$this->template->set('title', 'The Alternative Chronicle Dashboard');
			$this->template->load('admin/header', 'template');
			$this->template->load('admin/dashboard', 'template');
    }
	
	public function setUser($user){
		$user_groups= array('admin', 'writer');
		
		if (in_array($user, $user_groups, true))
		{
			$this->template->set('article_link', 'admin/articles');
		}
	}
	
}
	