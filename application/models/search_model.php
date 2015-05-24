<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class search_model extends CI_Model 
{
	// Get total posts by search query
	public function get_posts($query, $posts_per_page, $current_page)
	{
		$offset = ($current_page-1)*$posts_per_page;
		if ($current_page ==1 )
		{
			$offset = 0;
		}
		
		$sql = "
		SELECT * 
		FROM posts 
		WHERE MATCH (post_title, post_content) 
		AGAINST (?) 
		AND post_status 'public LIMIT ?,?";
		
		$query = $this->db->query($sql, array($query, $offset, $post_per_page));
		
		return $query->result_array();
	}
	
	 // Get the number of rows, use for pagination
	 public function get_numrows($query) 
	 {
	 	$rows=0;
		
		$sql = "
		SELECT * 
		FROM wp_posts 
		WHERE MATCH (post_title, post_content) 
		AGAINST (?) 
		AND post_status='publish'";
		
		$query = $this->db->query($sql, array($query));
		
		$rows=$query->num_rows();
		
		return $rows;
		
	 }
	 
	 public function highlightWords($string,$words,$ajax=false)
	 {
		$words=explode(' ',$words);

		for($i=0;$i<sizeOf($words);$i++) 
		{
			if($ajax==true)
			{
				$string=str_ireplace($words[$i], '<strong class=\"highlight\">'.$words[$i].'<\/strong>', $string);
			}
			else 
			{
				$string=str_ireplace($words[$i], '<strong class="highlight">'.$words[$i].'</strong>', $string);
			}
		}
		return $string;
	}
	 
	public function cleanHTML($input, $ending="...")
	{
		$output = strip_tags($input);
		$output = substr($output, 0, 100);
		$output .= $ending;
		return $output;
	}
	
}