<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class category_model extends CI_Model 
{
	function __construct()
    {
        parent::__construct();
    }
	
	/*Get names of all parent categories
	 * 
	 */
	public function getCategoryNames()
	{
		
		$this->db->select('parent_category_name, child_category_name');
		$this->db->from('categories');
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
	 		return $query->result_array();

		}
		else{
			return FALSE;
		}
	}
	
	/*Get parent category name with child id()
	 * 
	 * @param child id category
	 * @return string parent category name
	 * 
	 */
	public function identifyParentCategory($child_id)
	{
		
		$this->db->select('parent_category_name');
		$this->db->from('categories');
		$this->db->where('child_category_id', $child_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
	 		$child_array = $query->result_array();
			return (string)($child_array[0]['parent_category_name']);
		}
		else
		{
			return FALSE;
		}
	}
	
	/*Get parent category name from id
	 * 
	 */
	public function getParentCategoryName($parent_id)
	{
		$this->db->select('child_category_name');
		$this->db->from('categories');
		$this->db->where('child_category_id', $parent_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
	 		$child_array = $query->result_array();
			return (string)($child_array[0]['parent_category_name']);
		}
		else
		{
			return FALSE;
		}
	}
	
	/*Get child category name from id
	 * 
	 */
	public function getChildCategoryName($child_id)
	{
		$this->db->select('child_category_name');
		$this->db->from('categories');
		$this->db->where('child_category_id', $child_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
	 		$child_array = $query->result_array();
			return $child_array[0]['child_category_name'];
		}
		else
		{
			return FALSE;
		}
	}
	
	/*Get child category id from name
	 * 
	 */
	public function getChildCategoryId($child_name)
	{
		$this->db->select('child_category_id');
		$this->db->from('categories');
		$this->db->where('child_category_name', $child_name);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
	 		$child_array = $query->result_array();
			return $child_array[0]['child_category_id'];
		}
		else
		{
			return FALSE;
		}
	}
	
}

?>