<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class posts_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }
	
	/* get featured articles for home Top banner
	 * 
	 * @return array
	 */
	public function getFeaturedHomeBanner()
	{
		$featured = array();
		
		$this->db->select('article_id, image, sort_order');
		$this->db->from('featured');
		$this->db->where('type', 'home');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$article_ids = $query->result_array();
			foreach ($article_ids as $article_id)
			{
				$featured_article = array();
				
				$article = $this->getArticle($article_id['article_id']);

				$author_id = (int)($article[0]['post_author']);
				
				$author = $this->getArticleAuthor($author_id);

				$featured_article['title'] = (string)($article[0]['post_title']);
				$featured_article['link'] = (string)(base_url().$article[0]['post_link']);
				$featured_article['author'] = (string)($author[0]['display_name']);
				
				$featured_article['image'] = (string)(base_url().'img/articles/uploads/'.$article_id['image']); 
				
				$featured[] = $featured_article;
			}
			return $featured;
		}
		else
		{
			return FALSE;
		}
	}
	
	/* get main featured article for page
	 * 
	 * @param $page string
	 * @return result array for featured article
	 */
	public function getFeaturedMain($feature_type)
	{
		$this->db->select('article_id, image');
		$this->db->from('featured');
		$this->db->where('type', $feature_type);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$featured = $query->result_array();
			$article_info = $this->getArticle($featured[0]['article_id']);
			$featured_article['title'] = (string)($article_info[0]['post_title']);
			$featured_article['link'] = (string)(base_url().$article_info[0]['post_link']);
			$featured_article['excerpt'] = (string)(base_url().$article_info[0]['post_excerpt']);
			$featured_article['image'] = (string)(base_url().'img/articles/uploads/'.$featured[0]['image']); 

			return $featured_article;
		}
		else
		{
			return FALSE;	
		}
	}
	
	/* get all article information by article id
	 * 
	 * @param $article_id integer
	 * @return result array containing all post info
	 */
	public function getArticle($article_id)
	{
		$query = $this->db->get_where('posts', array('ID =' => $article_id));
		
		return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		
	}
	
	/* get all article information by article name
	 * 
	 * @param $article_id integer
	 * @return result array containing all post info
	 */
	public function getArticlebyName($article_name)
	{
		$query = $this->db->get_where('posts', array('post_name =' => $article_name));
		return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
	}
	
	/*get article author by author id
	 * 
	 * @param $author_id integer
	 */
	public function getArticleAuthor($author_id)
	{
		
		$query = $this->db->get_where('authors', array('ID =' => $author_id));
		
		return ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		
	}
	
	/*pull most recent posts by parent category id and from a post id
	 * 
	 * @param $category_id 
	 * @return array
	 */
	 public function getRecent($category_id, $post_id, $date = '2013-03-01 00:00:00')
	 {

	 	$query = $this->db->query("
	 		SELECT p.post_title, p.id, p.post_author, p.post_date, p.post_content, p.post_link, c.child_category_id
	 		FROM posts AS p LEFT JOIN categories AS c
	 		ON p.post_child_category_id = c.child_category_id
	 		WHERE c.parent_category_id = ".$category_id." 
	 		AND p.post_date >= '".$date."' 
	 		AND p.id <= ".$post_id."
	 		AND p.post_status = 'publish'
	 		ORDER BY p.post_date DESC
	 		LIMIT 10");

		return($query->result_array());
	 }
	 
	 /*pull most recent posts by child category id and from post id, used for child category pages
	  * 
	  */
	 public function getRecentChild($category_id, $post_id, $date = '2013-03-01 00:00:00')
	 {
	 	$query = $this->db->query("
	 		SELECT p.post_title, p.id, p.post_author, p.post_date, p.post_content, p.post_link, c.child_category_id
	 		FROM posts AS p LEFT JOIN categories AS c
	 		ON p.post_child_category_id = c.child_category_id
	 		WHERE c.child_category_id = '".$category_id."' 
	 		AND p.post_date >= '".$date."'
	 		AND p.id <= ".$post_id."
	 		AND p.post_status = 'publish'
	 		ORDER BY p.post_date DESC
	 		LIMIT 10");
	 	
			return($query->result_array());
	 }
	 
	 
	 public function getRecentPostsFeed()
	 {
        $this->db->order_by('post_date', 'desc');
        $this->db->where('post_status', 'publish');
        $this->db->limit(10);
        return $this->db->get('posts');
	} 
	 
	 /*Get last post by parent category
	  * 
	  */ 
	 public function getLastPostIdParent($parent_id)
	 {
	 	$query = $this->db->query("
	 		SELECT max(p.id) 
	 		FROM posts AS p LEFT JOIN categories AS c
	 		ON p.post_child_category_id = c.child_category_id
	 		WHERE c.parent_category_id = ".$parent_id);

		return $query->result_array();
	 }
	 
	 /*Get last post in a child category
	  * 
	  */
	  public function getLastPostIdChild($child_id)
	 {
	 	$query = $this->db->query("
	 		SELECT max(id) 
	 		FROM posts
	 		WHERE post_child_category_id = '".$child_id."' ");
	 		
		return $query->result_array();
	 }
	 
	 /*Get post title from post name
	  * 
	  */
	 public function getPostTitle($post_name)
	 {
	 	$this->db->select('post_title');
		$this->db->from('posts');
		$this->db->where('post_name', $post_name);
		
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	 /*Check to see if article is from wordpress site
	  * 
	  * @return boolean
	  */
	 public function isWordpress($article_id){
	 	$this->db->select('wordpress');
		$this->db->from('posts');
		$this->db->where('id', $article_id);
		
		$query = $this->db->get();
		
		$bool = $query->result_array();
		
		return (boolean)($bool[0]['wordpress']);
		}
	 
	 
	 /*set initial post_link for all posts in the db from wp
	  * 
	  */
	  public function setWpLinks(){
	 	$select = $this->db->query("
	 		SELECT `post_date`, `post_name`
	 		FROM `posts`
	 		WHERE post_type = 'post' 
	 		");
		
		$posts = $select->result_array();
		
		foreach ($posts as $post){
			$post_link = (string)(date("Y/m/d",strtotime($post['post_date'])).'/'.$post['post_name']);
			
			$this->db->query("
	 		UPDATE `posts` 
	 		SET `post_link` ='".$this->db->escape($post_link)."'
	 		WHERE `post_name` = '".$this->db->escape($post['post_name'])."'
	 		");
		}
	 }
	  
	 public function grabRandomPost()
	 {
	  	$this->db->select('*');
		$this->db->from('posts');
		$this->db->where('post_date >= ', '2013-03-01 00:00:00');
		$this->db->order_by('id', 'RANDOM');
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	 /* Get publish date in datetime for post id
	  * 
	  */
	public function getDate($post_id)
	{
		$select = $this->db->query("
	 		SELECT `post_date`
	 		FROM `posts`
	 		WHERE id = '".$post_id."' 
	 		");
		
		return $select->result_array();
	}
}