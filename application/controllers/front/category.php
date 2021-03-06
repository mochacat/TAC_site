<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class category extends CI_Controller 
{
	
	private $child_id = '';
	
	/*@param $name, child category name
	 * 
	 */
	public function view($name = '')
	{
		//load models
		$this->load->model('category_model');
		$this->load->model('posts_model');
		
		//sort child categories into parent category arrays
		$reviews = array();
		$specials = array();
		
		$categories = $this->category_model->getCategoryNames();
		
		foreach ($categories as $index => $category){
			if ($category['parent_category_name'] =="Reviews")
			{
				$reviews[] = $category['child_category_name'];
			}
			elseif ($category['parent_category_name'] =="Specials")
			{
				$specials[] = $category['child_category_name'];
			}
		}
		
		//rename categories from uri variable
		if ($name == "art_music")
		{
			$name = 'Art &amp Music';
		}
		elseif ($name == "books_comics")
		{
			$name = "Books &amp Comics";
		}
		elseif ($name == "tv")
		{
			$name = "Television";
		}
		elseif ($name == "chronicle_cast"){
			$name = "Chronicle Cast";
		}
		elseif ($name == "culture_corner"){
			$name = "Culture Corner";
		}
		
		//create nice name for title
		$nice_name = ucfirst($name);

		if (file_exists(APPPATH . 'views/front/category.php'))
		{

			//get child category id for category name
			$this->child_id = $this->category_model->getChildCategoryId($name);

			if (!isset($_POST['lastmsg']))
			{
				$this->setHeader($name);
		
				$this->template->load('front/header', 'template');
		
				$this->template->load('front/navbar', 'template');
		
				$this->setRecent();
				
				//set parent category title variable for view
				if (in_array($nice_name, $reviews))
				{
					$this->template->set('parent', 'reviews');
				}
				elseif (in_array($nice_name, $specials))
				{
					$this->template->set('parent', 'specials');
				}
				
				$this->template->set('nice_name', $nice_name);
		
				$this->template->load('front/category', 'template');
		
				$this->template->load('front/footer', 'template');
			}
			else
			{
				$this->loadMore($this->db->escape($_POST['lastmsg']));
			}
		}
		else
		{
			//404
			redirect('/error/error_404');
		}
	}
	
	/*@param $child_id child category id of page
	 * 
	 */
	public function setRecent()
	{
		$max_id = $this->posts_model->getLastPostIdChild($this->child_id);	
		
		$max_id = $max_id[0]['max(id)'];
		
		if (isset($max_id))
		{
			$recent = $this->posts_model->getRecentChild($this->child_id, $max_id);

			if ($recent !== '')
			{
				$this->template->set('recent_category', $this->setRecentCategory($recent));
			}
			else
			{ 
				echo FALSE;
			}
		}
		else
		{
			$this->template->set('empty', '1');
		}
	}
	 
	/*@recent_posts array of post information
	 * 
	 */
	public function setRecentCategory($recent_posts)
	{
		foreach ($recent_posts as $recent_post)
		{
			//auto increment for ajax load more

			//modify image size to be thumbnail	
			$image = $this->makeThumbnail($recent_post['post_content'], $recent_post['id']);
			
			//set $image to nothing if no images exist in post
			if (!$image)$image = '';
			
			//get category name	
			$category = $this->category_model->getChildCategoryName($recent_post['child_category_id']);

			//remove ampersand for category link
			if (strpos($category, '&') !== FALSE)
			{
				$category_link = str_replace(' &amp ', '_', strtolower($category));
				$category_link = str_replace(' ', '_', $category_link);

			}
			else
			{
				$category_link = strtolower($category);
			}
			
			//get author by id
			$author = $this->posts_model->getArticleAuthor($recent_post['post_author']);
			
			$recent[] = array(
					'title' => $recent_post['post_title'],
					'link'  => $recent_post['post_link'],
					'date' => date("jS M Y",strtotime($recent_post['post_date'])),
					'image' => $image,
					'author' => $author[0]['display_name'],
					'load_id' => $recent_post['id']
					);
		}
		
		if (isset($recent)){
		foreach ($recent as $key => $recent_post){
			$this->recent_content .= '
			<li>
			<div class="article-info">
				<div class="recent-title">
					<h4><a href="'.$recent_post['link'].'" title="'.$recent_post['title'].'"> '. $recent_post['title'].'</a></h4>
				</div>
				<div class="recent-excerpt">';
			if (isset($recent_post['excerpt'])){
					$this->recent_content .= '<p>'.$recent_post['excerpt']. '</p>';
			}
			$this->recent_content .= '
				</div>	
				<div class="recent-author">
					<a href="'.base_url().'authors'.'" title="Authors">'.$recent_post['author'].'</a>
				</div>
				<div class="recent-date">
					<p>'.$recent_post['date'].'</p>
				</div>	
			</div>
			<div class="recent-thumb box">
				<div class="thumb">
					<a href="'.$recent_post['link'].'" title="'.$recent_post['title'].'">
						<img src="'.$recent_post['image'].'" alt="'.$recent_post['title'].'">
					</a>
				</div>
			</div>		
			</li>';

			
			//set load id for oldest post of the 5 articles
			$load_id = $recent_post['load_id'];
		}
		
		$this->recent_content .='
		<div id="more';
		if (isset($load_id)){
		$this->recent_content .=$load_id;
		}
		$this->recent_content .='" class="morebox">
			<a href="#" class="more" id="';
		if (isset($load_id)){
		$this->recent_content .=$load_id;
		}
		$this->recent_content .='">Load More Articles</a>
		</div>
		';
		}
		return (isset($this->recent_content)) ? $this->recent_content : '';
	}
	
	
	/*@param $lastmsg id of article from ajax
	 * 
	 */
	public function loadMore($lastmsg)
	{
		//grab category parent id, last article id
		$post_array = $this->posts_model->getRecentChild($this->child_id, $lastmsg);
		
		$post_array = array_slice($post_array, 1); //array slice to remove first post so it doesn't repeat; see posts_model getRecent

		$more_content = $this->setRecentCategory($post_array);

		echo $more_content;
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

				$thumb = $image_name.'_thumb.'.$image_format; //reattach format

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
		$config['width']	 = 168;
		$config['height']	= 112;
		
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
	
	public function setHeader($name){
		
		$this->socialLinks();
		
		$this->template->set('title','The Alternative Chronicle '.$name);
		$this->template->set('meta_desc', 'The Alternative Chronicle is a webzine dedicated to collectively sharing the flavored opinions of cultural minorities; ranging from cinephiles & comic geeks to health & science aficionados.');
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
?>