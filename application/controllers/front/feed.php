<?php
class Feed extends CI_Controller 
{

    function Feed()
    {
        parent::__construct();
        $this->load->model('posts_model', '', TRUE);
        $this->load->helper('xml');
    }
    
    function index()
    {
        $data['encoding'] = 'utf-8';
        $data['feed_name'] = 'TheAlternativeChronicle.com';
        $data['feed_url'] = 'http://www.thealternativechronicle.com';
        $data['page_description'] = 'Geeks and Artists vs. Culture';
        $data['page_language'] = 'en-ca';
        $data['creator_email'] = 'catm@hostjars.com';
		$this->load->library('wordpress');
        $data['posts'] = $this->posts_model->getRecentPostsFeed();    
        header("Content-Type: application/rss+xml");
        $this->load->view('front/rss', $data);
    }
}
?>