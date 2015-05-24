<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Login extends CI_Controller{
    	
	function __construct(){
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('session');
	}
		
    public function view(){
    		
		$this->template->set('title', 'The Alternative Chronicle Writers');
		$this->template->load('admin/header', 'template');
			
		$home_image = '<a href="<?php echo base_url()?>" title="Home page"><img src="../img/site/AltChron3.png" alt="The Alternative Chronicle" style="height:140px;" /></a>';
		$this->template->set('home_image', $home_image);
		$this->template->load('admin/login', 'template');
			
    }
		
	public function checkLogin(){
			
		//validate form input
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if($_POST) 
		{
			if ($this->form_validation->run() == true)
			{
				//clean public facing app input
            	$email = $this->input->post('email', true);
            	$password = $this->input->post('password', true);
				
            	//Ion_Auth Login fun
            	if($this->ion_auth->login($email,$password)) 
            	{
						
               		//capture the user group
					if($this->ion_auth->get_users_groups()->row()->id)
					{
						$user_group = 'admin';
					}
					elseif($this->ion_auth->get_users_groups()->row()->id == 2)
					{
						$user_group = 'writer';
					}
	
               		/*redirect to the admin dashboard
                	 controller using the user
                	groups as function names */
                 	 redirect('login/'.$user_group, 'refresh');
            	} 
            	else 
            	{
                	$this->template->set('message', $this->ion_auth->errors());
					$this->view();
            	}
			}
			else
			{
				$this->view();
			}
    	}
		else
		{
			$this->view();
		}
    }
}
?>