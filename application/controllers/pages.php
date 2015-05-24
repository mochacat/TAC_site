<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * For Home page & static pages (About, Mission, etc)
 */
class Pages extends CI_Controller {
	
	public function view($page = 'home')
	{
		//load post model
		$this->load->model('posts_model');
		$this->load->model('category_model');
			
		//header info
		$this->setHeader($page);
		
		$this->template->load('front/header', 'template');
		
		$this->template->load('front/navbar', 'template');
		
		if (file_exists(APPPATH.'/views/front/'.$page.'.php'))
		{
			if ($page == 'home'){
				//set Slider
				$slider = $this->setSlider();
			
				if ($slider){
					$this->template->load('front/slideshow', 'template');
				}
			
				//set Home Page Content
				$this->setRecent();
				$this->setRandom();
				
			}
		
			$this->template->load('front/'.$page, 'template');
		
		}
		else
		{
			//404
			redirect('/error/error_404');
		}
		
		$this->template->load('front/footer', 'template');	
	}
	
	
	public function setHeader($page)
	{
		if ($page == 'home')
		{
			$slider_resources =
			'<!-- Load slider resources -->
			' . link_tag('css/nivo-slider.css') . link_tag('img/nivoslider/default/default.css') . 
			'<script src="/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
			';
		
			$this->template->set('slider_resources', $slider_resources);
		
		}
		
		$this->socialLinks();
		
		$this->template->set('title','The Alternative Chronicle Home Page');
		$this->template->set('meta_desc', 'The Alternative Chronicle is a webzine dedicated to collectively sharing the flavored opinions of cultural minorities; ranging from cinephiles & comic geeks to health & science aficionados.');
		$this->template->set('meta_key', 'film, podcasts, art, music, best of, cinephile, nerd, geek, comics reviews');
	}
	
	
	/*
	 * Home page only
	 * 
	 * @return boolean
	 */
	public function setSlider(){
		
		$this->template->set('height', '340');
		
		$articles = $this->posts_model->getFeaturedHomeBanner();
		
		foreach ($articles as $article){		
			$banners[] = array(
					'title' => $article['title'],
					'link'  => $article['link'],
					'image' => $article['image']
					);
			$captions[] = array(
					'author' => $article['author'],
					'author_link' => base_url().'authors',
					'link' 	 => $article['link'],
					'title'  => $article['title'],	
			);
		}
		
		$this->template->set('banners', $banners);
		$this->template->set('captions', $captions);

		return ($banners) ? TRUE : FALSE;
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
	
	public function setRecent()
	{
		//two columns in recent, cat name and id
		$columns = array('Reviews', 'Specials');
		
		foreach ($columns as $column)
		{
			if ($column == "Reviews")
			{
				//film reviews
				$max_id = $this->posts_model->getLastPostIdChild('1');
				$max_id = $max_id[0]['max(id)'];
				
				if (isset($max_id))
				{
					$recent = $this->posts_model->getRecentChild('1', $max_id);	
					if ($recent !== '')
					{
			
						$this->template->set('recent_reviews', $this->setRecentHome($recent));
					}
				}
			}
			elseif ($column == 'Specials')
			{
				$max_id = $this->posts_model->getLastPostIdParent('2');
				$max_id = $max_id[0]['max(p.id)'];	
				
				if (isset($max_id))
				{
					$recent = $this->posts_model->getRecent('2', $max_id);
					if ($recent !== '')
					{
						$this->template->set('recent_specials', $this->setRecentHome($recent));
					}
				}
			}
		}
	}
	
	/*@param unset child category by id if defined
	 * 
	 */
	public function setRecentHome($recent_posts)
	{
		$this->load->model('posts_model');
		$this->load->model('category_model');
		foreach ($recent_posts as $recent_post)
		{
			//modify image size to be thumbnail	
			$image = $this->makeThumbnail($recent_post['post_content'], $recent_post['id']);
			
			//set $image to nothing if no images exist in post
			if (!$image){$image = '';}
			
			//get author by id
			$author = $this->posts_model->getArticleAuthor($recent_post['post_author']);
			$category = $recent_post['child_category_id'];
			
			$recent[] = array(
					'title' => $recent_post['post_title'],
					'link'  => $recent_post['post_link'],
					'image' => $image,
					'load_id' => $recent_post['id']
					);
		}

		return isset($recent) ? $recent : '';
	}
	
	public function makeThumbnail($post_content, $post_id)
	{
		//find first image of article
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post_content, $image);
		$image = $image['src'];

		//convert img src link to new site location
		if($this->posts_model->isWordpress($post_id))
		{
			
			$wp_link = "http://alternativechronicle.files.wordpress.com";
		
			$ac_link = "img/articles/uploads";

			$image = str_replace($wp_link, $ac_link, $image);

		}

		$image_formats = array('jpg', 'jpeg', 'png', 'gif');
		
		foreach ($image_formats as $image_format)
		{
			if (strpos($image, '.'.$image_format))
			{
				//remove format to make thumb file name
				$image_name = str_replace('.'.$image_format, '', $image);
				
				//remove ?w=
				if (preg_match('/\?(.*)/', $image_name))
				{
					$image_name = array_shift(explode('?', $image_name));
				}

				$thumb = $image_name.'_thumb2.'.$image_format; //reattach format

				//reattach format
				$image_name = $image_name.'.'.$image_format;
				
				if (!file_exists($thumb))
				{
					$this->processThumbs($image_name);
				}
			}
		}
		
		return (isset($thumb)) ? $thumb : FALSE;
	}
	
	public function processThumbs($image)
	{
		$this->load->library('image_lib'); 
		$config['image_library'] = 'gd2';
		$config['source_image']	= $image;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['thumb_marker'] = "_thumb2";
		$config['width']	 = 111;
		$config['height']	= 74;
		
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		
		//debugging tool
		/*
		if ( ! $this->image_lib->resize())
		{
    		echo $this->image_lib->display_errors('<p>', '</p>');
		}*/
		
		$this->image_lib->clear();
	}
	
	public function setRandom(){
		$random = $this->posts_model->grabRandomPost();
		$random_link = $random[0]['post_link'];
		$this->template->set('random', $random_link);
	}
}
?>