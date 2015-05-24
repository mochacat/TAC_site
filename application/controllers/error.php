<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class error extends CI_Controller {
 		
 	function __construct()
    {
        parent::__construct();
    }
	
	function error_404()
	{
		$this->output->set_status_header('404');
		
		$this->setHeader();
		$this->template->load('front/header', 'template');
		$this->template->load('front/navbar', 'template');
		$this->template->load('error', 'template');
		$this->template->load('front/footer', 'template');	
	}
	
	public function setHeader()
	{
		$this->socialLinks();
		
		$this->template->set('title','The Alternative Chronicle');
		$this->template->set('meta_desc', 'A community of writers passionate for art and pop culture');
		$this->template->set('meta_key', 'film, festivals, art, music, television, books, comics');
	}
	
	public function socialLinks()
	{
		
		$social_media = array(
						0 => array('url' => 'http://www.facebook.com/pages/The-Alternative-Chronicle/106639599705?fref=ts', 'title' => 'Like us on Facebook!', 'img' => 'img/site/AltChronFacebook.png'),
						1 => array('url' => 'http://twitter.com/AltChronicle', 'title' => 'Follow us on Twitter!', 'img' => 'img/site/AltChronTwitter.png')
						);
						
		$this->template->set('height', '45');
		$this->template->set('social_links', $social_media);
	}
}