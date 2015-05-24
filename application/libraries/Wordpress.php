<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Wordpress{
	
	/* Replace all links in post content
	 * 
	 * @param $post string of post content
	 */
	public function replaceLinks($post){
		$post = $this->replaceAuthorLinks($post);
		$post = $this->replaceImages($post);
		$post = $this->replacePostLinks($post);
		return $post;
	}
	
	public function replaceAuthorLinks($post)
	{
		$wp_link = "src=\"http://alternativechronicle.files.wordpress.com/author";

		$ac_link = "src=\"/author";
		
		$post = str_replace($wp_link, $ac_link, $post);
		
		return $post;
	}
	
	public function replaceImages($post){
		
		$wp_link = "src=\"http://alternativechronicle.files.wordpress.com";
		
		$ac_link = "src=\"/img/articles/uploads";

		$post = str_replace($wp_link, $ac_link, $post);
		
		return $post;
	}
	
	public function replacePostLinks($post){
		$wp_link = "href=\"http://alternativechronicle.files.wordpress.com";

		$ac_link = "href=\"";
		
		$post = str_replace($wp_link, $ac_link, $post);
		
		$post = str_replace("href=\"http://alternativechronicle.wordpress.com", "href=\"", $post);
		
		return $post;
	}
	
	public function findPositions($haystack, $needle, $offset = 0, &$results = array()) {                
    	$offset = strpos($haystack, $needle, $offset);
   	 	if($offset === false) 
   	 	{
       		return $results;            
    	} 
    	else 
    	{
        	$results[] = $offset;
        	return $this->strpos_recursive($haystack, $needle, ($offset + 1), $results);
    	}
	}

}
?>
