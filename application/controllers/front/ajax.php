<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends CI_Controller 
{
	function __construct()
    {
        parent::__construct();
    }
	
	public function more()
	{
		if(isSet($_POST['lastmsg']))
		{
			$lastmsg=$_POST['lastmsg'];
			$lastmsg=$this->db->escape($lastmsg);
			$this->load->library('posts_model');
			
			$this->setRecentReviews($this->posts_model->getRecent('1', $lastmsg));
		}
	}
	public function setRecentReviews($recent_posts)
	{
		$this->load->model('posts_model');
		$this->load->model('category_model');
		foreach ($recent_posts as $recent_post)
		{
			//modify image size to be thumbnail	
			$image = $this->makeThumbnail($recent_post['post_content'], $recent_post['id']);
			
			//set $image to nothing if no images exist in post
			if (!$image){$image = '';}
			
			//get category name	
			$category = $this->category_model->getChildCategoryName($recent_post['child_category_id']);
			//get author by id
			$author = $this->posts_model->getArticleAuthor($recent_post['post_author']);
			
			$recent[] = array(
					'title' => $recent_post['post_title'],
					'excerpt' => 'Excerpt here',
					'link'  => $recent_post['post_link'],
					'date' => date("jS M Y",strtotime($recent_post['post_date'])),
					'image' => $image,
					'category' => $category,
					'author' => $author[0]['display_name'],
					'load_id' => $recent_post['id']
					);
		}
		
		foreach ($recent as $key => $recent_post){
			$this->recent_content .= '
			<li>
				<div class="recent-thumb">
					<img src="'.$recent_post['image'].'" alt="'.$recent_post['title'].'">
				</div>
				<h4><a href="'.$recent_post['link'].'" title="'.$recent_post['title'].'"> '. $recent_post['title'].'</a></h4>
				<div class="recent-excerpt">
					<p>'. $recent_post['excerpt']. '</p>
				</div>	
				<div class="recent-category">
					<a href="'.$recent_post['category'].'" title="'.$recent_post['category'].'">'.$recent_post['category'].'</a>
				</div>
				<div class="recent-date">
					<p>'.$recent_post['date'].'</p>
				</div>	
				<div class="recent-author">
					<a href="'.'authors'.'" title="Authors">'.$recent_post['author'].'</a>
				</div>			
			</li>';
		}
		
		$this->recent_content .='
		<div id="more'.$recent_post['load_id'].'" class="morebox">
			<a href="#" class="more" id="'.$recent_post['load_id']. '">Load More Articles</a>
		</div>
		';
		
		$this->template->set('more_content', $this->recent_content);
	}
}

?>