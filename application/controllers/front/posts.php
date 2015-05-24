<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller 
{
	public function load($post_name){
		$this->load->model('posts_model');
		$this->load->model('category_model');
		
		if (file_exists(APPPATH . 'views/front/posts.php'))
		{
			$post_info = $this->posts_model->getArticlebyName($post_name);
	
			//header info

			$this->setHeader($post_info[0]['post_title']);
			$this->template->load('front/header', 'template');
			$this->template->load('front/navbar', 'template');
			
			//convert new lines to br
			$post_content = nl2br($post_info[0]['post_content']);
			
			//check to see if it was a wordpress post to change links inside content
			if ($post_info[0]['wordpress'])
			{
				$this->load->library('wordpress');
				$post_content = $this->wordpress->replaceLinks($post_content);
			}
			//fix images that have src="img/" instead of src="/img/"			
			$post_content = str_replace('"img/', '"/img/', $post_content);
			//get categories
			$child_cat = $this->category_model->getChildCategoryName($post_info[0]['post_child_category_id']);
			$parent_cat = $this->category_model->identifyParentCategory($post_info[0]['post_child_category_id']);
			
			//format for link
			$child_cat = strtolower($child_cat);
			$child_link = str_replace('&amp', '_', $child_cat);
			$child_link = str_replace(' ', '_', $child_link);
			
			//get author by id
			$author = $this->posts_model->getArticleAuthor($post_info[0]['post_author']);

			$this->template->set('parent_cat', $parent_cat);
			$this->template->set('child_cat', $child_cat);
			$this->template->set('child_link', $child_link);
			$this->template->set('date', date("jS M Y",strtotime($post_info[0]['post_date'])));
			$this->template->set('author', $author[0]['display_name']);
			$this->template->set('author_about', $author[0]['description']);
			$this->template->set('author_img', base_url().'img/site/authors/'.$author[0]['image']);
			$this->template->set('title', $post_info[0]['post_title']);
			$this->template->set('content', $post_content);
			
			//load comments
			
			$this->load->library('disqus');
			
			$this->template->set('disqus', $this->disqus->insertDisqus());
			
			$this->template->load('front/posts', 'template');
			$this->template->load('front/footer', 'template');
		}
		
		else
		{
			//404
			redirect('/error/error_404');
		}
	}
	public function setHeader($post_title)
	{
		$this->socialLinks();
		
		$this->template->set('title', $post_title);
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
