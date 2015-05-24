<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
		var $template_data = array();
		
		public function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}
		
		/* @param $variable name for variable in view
		 * @template string
		 * @view string
		 * 
		 */
		public function load($template = '', $view = '' , $view_data = array(), $return = FALSE)
		{               
			$this->CI =& get_instance();
			
			$this->loadNavbarCats();
			$this->SocialLinks();
				
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));	//grab html from a view and assign to variable in template_data

			return $this->CI->load->view($template, $this->template_data, $return); //load template data to template
		}
		
		/*load Page Categories for top bar of every template
		 * 
		 */
		public function loadNavbarCats()
		{
			//navbar will load on every template
			$this->set('navtabs', array(
				'home' => base_url(), 
				'reviews' => base_url(). 'reviews', 
				'specials' => base_url(). 'specials',
				'our ideas' => base_url(). 'ideas',
				'archive' => base_url().'archive',
				'what\'s this?' => base_url().'whats-this',
				'contact us' => base_url().'contact'
				));
		}
		
		public function socialLinks(){
		
			$social_media = array(
						0 => array('url' => 'http://www.facebook.com/pages/The-Alternative-Chronicle/106639599705?fref=ts', 'title' => 'Like us on Facebook!', 'img' => 'img/site/AltChronFacebook.png'),
						1 => array('url' => 'http://twitter.com/AltChronicle', 'title' => 'Follow us on Twitter!', 'img' => 'img/site/AltChronTwitter.png')
						);
						
			$this->set('social_height', '45');
			$this->set('social_links', $social_media);
		}
}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */