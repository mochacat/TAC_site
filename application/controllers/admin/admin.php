<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_Controller extends CI_Controller {

    //Class-wide variable to store user object in.
    protected $the_user;

    public function __construct() {
    	// Require members to be logged in. If not logged in, redirect to the Ion Auth login page.
    	if(!$this->ion_auth->logged_in())
    	{
      		redirect(base_url() . 'login');
    	}
        //Check if user is in admin group
        if ( $this->ion_auth->is_admin() ) {

            //Put User in Class-wide variable
            $this->the_user = $this->ion_auth->user()->row();

            //Store user in $data
            $the_user = $this->the_user;

            //Load $the_user in all views
            $this->template->set('user', $the_user);
        }
        else {
            redirect('login');
        }
    }

}