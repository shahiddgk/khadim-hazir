<?php if ( ! defined('BASEPATH')) exit ('No direct script  allow'); 

class Common_model extends  CI_Model {
	
	function select_all($select,$table)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		return $this->db->get();
	}
	
	// function model_lisitng()
	// {
	// 	 $sql = "SELECT id, priority, name, language, table_id, 
	// 	 (SELECT name FROM brands b WHERE language = 'eng' AND b.table_id=m.brand_id)
	// 	  AS brand_name FROM models m WHERE 1 = 1 ORDER BY priority ASC"; 
	// 	return $this->db->query($sql);

	function select_all_order_by($select,$table,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		return $this->db->get();
	}

	function select_where($select,$table,$where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		return $this->db->get();
	}

	
	// function select_group($select,$table,$where,$group)
	// {
	// $this->db->select($select);
	// $this->db->from($table);
 	// $this->db->group_by($group);  
 	// $this->db->get();
	// }
	function select_groupby($select,$table,$groupby)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		
		$this->db->group_by( $groupby ); 
		return $this->db->get();
	}
	
	function select_distinct($select,$table,$where)
	{	
		$this->db->distinct($select);
		$this->db->from( $table );
		$this->db->where( $where );
		return $this->db->get();
	}
	
	
	function select_where_in($select,$table,$where_in,$in_fld)
	{	
		$this->db->select($select);
		$this->db->from( $table );
		$this->db->where_in($in_fld, $where_in);
		$this->db->group_by($select);
		return $this->db->get();
	}
	
	function select_single_field($select,$table,$where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$qry = $this->db->get();
		if($qry->num_rows()>0)
		{
			$rr	=	$qry->row_array();
			return	$rr[$select];
		}
		else
		{
			return '';
		}
	}
	
	function select_limit_order($select,$table,$page,$recordperpage,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
	
	function select_where_ASC_DESC( $select,$table,$where,$orderBy_columName,$ASC_DESC )
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
	
	function select_where_ASC_DESC_Group_by( $select,$table,$where,$orderBy_columName,$ASC_DESC,$group_by )
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->group_by($group_by);
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}

	
	function select_where_order($select,$table,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
	
	function select_wher_order($select,$table,$where,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
	
	function select_where_limit_order($select,$table,$where,$page,$recordperpage,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
	
	function select_where_table_rows($select,$table,$where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	function select_limit($select,$table,$page,$recordperpage)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->limit( $recordperpage , $page );
		$result=$this->db->get();
		return $result;	
		
	}

	
	function select_table_rows($select,$table)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	
	function update_array($where,$table,$data)
	{
		$this->db->where( $where );
		$this->db->update( $table , $data);	
	}
	
	function insert_array($table,$data)
	{
		$this->db->insert( $table,$data );
		return $this->db->insert_id();	
	}
	
	function delete_where($where,$tbl_name)
	{
		$this->db->where($where);
		$this->db->delete($tbl_name);
	}
	
	function join_two_tab( $select , $from , $jointab , $condition, $orderBy_columName , $ASC_DESC ){
			$this->db->select( $select );
			$this->db->from( $from );
			$this->db->join( $jointab, $condition,'left' );
			$this->db->order_by( $orderBy_columName , $ASC_DESC );			
			return $this->db->get();
		
	}
	function join_two_tab_witout_left( $select , $from , $jointab , $condition, $orderBy_columName , $ASC_DESC ){
		$this->db->select( $select );
		$this->db->from( $from );
		$this->db->join( $jointab, $condition);
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
	
}
	function join_two_tab_where( $select, $from, $jointable, $condition, $where, $recordperpage, $page, $orderBy_columName, $ASC_DESC ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition ,'left');
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );	
		return $this->db->get();

	}
	
	
	function join_two_tab_where_numrow( $select, $from, $jointable, $condition, $where ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();

	}
	
	
	function select_or_like( $select,$table,$where,$orcondition,$recordperpage,$page,$orderBy_columName,$ASC_DESC ){
		$this->db->select( $select );
		$this->db->from( $table );
		//$this->db->like( $like );
		$this->db->or_like($orcondition); 
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
	
	}
	
	function like_search( $select,$table,$where,$like,$orderBy_columName,$ASC_DESC ){
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->or_like($like); 
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		$this->db->where( $where );
		return $this->db->get();
	
	}
	
	
	function select_or_like_rows( $select,$table,$where,$orcondition ){
		$this->db->select( $select );
		$this->db->from( $table );
		//$this->db->like( $like );
		$this->db->or_like($orcondition); 		
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();
	
	}
	
	
	function join_tab_where( $select , $from , $jointab , $condition, $where, $orderBy_columName , $ASC_DESC ){
	
			$this->db->select( $select );
			$this->db->from( $from );
			$this->db->join( $jointab, $condition );
			$this->db->where( $where );
			$this->db->order_by( $orderBy_columName , $ASC_DESC );			
			return $this->db->get();
	}
	function join_tab_where_left( $select , $from , $jointab , $condition, $where, $orderBy_columName , $ASC_DESC ){
	
		$this->db->select( $select );
		$this->db->from( $from );
		$this->db->join( $jointab, $condition, 'left' );
		$this->db->where( $where );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );			
		return $this->db->get();
}
	
	function select_where_like($select,$table,$where_con,$where,$limit)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where_con );
		$this->db->like($where); 
		$this->db->limit($limit);
		return $this->db->get();
	}
	
	
	function join_three_tab_where( $select, $from, $jointable1, $condition1, $jointable2, $condition2,  $where, $recordperpage, $page, $orderBy_columName, $ASC_DESC ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable1 , $condition1 );
		$this->db->join( $jointable2 , $condition2 );
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );	
		return $this->db->get();

	}
	
	function join_three_tab_where_rows( $select, $from, $jointable1, $condition1, $jointable2, $condition2,  $where ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable1 , $condition1 );
		$this->db->join( $jointable2 , $condition2 );
		$this->db->where( $where );
		$query	=	$this->db->get();
		return 		$query->num_rows();
	}
	
	
	
	function select_limit_by($select,$table,$where,$page,$recordperpage,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
	
	
	function join_two_tab_where_numrows( $select, $from, $jointable, $condition, $where ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		return $this->db->get();

	}
	
	
	function select_limit_where($select,$table,$where,$page,$recordperpage)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$result=$this->db->get();
		return $result;	
		
	}
	
	
	function select_table_rows_where($select,$table,$where)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$query=$this->db->get();
		return $query->num_rows();
	}
	
	
	
	
	function join_two_tab_where_limit( $select, $from, $jointable, $condition,$where,$page,$recordperpage ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$query=$this->db->get();
		return $query;
	}
	
	
	function join_two_tab_where_numrw( $select, $from, $jointable, $condition,$where){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		 $query=$this->db->get();
		 return $query->num_rows();
	}
	
	function join_two_tab_where_simple( $select, $from, $jointable, $condition, $where ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		$query=$this->db->get();
		return $query;
	}
	
	
	function join_two_tab_where_groupby( $select, $from, $jointable, $condition, $where ,$group_by ){
		$this->db->select($select);
		$this->db->from( $from );
		$this->db->join( $jointable , $condition );
		$this->db->where( $where );
		$this->db->group_by( $group_by );
		$query=$this->db->get();
		return $query;
	}
	
	
	function select_limit_order_where($select,$table,$where,$page,$recordperpage,$orderBy_columName,$ASC_DESC)
	{
		$this->db->select( $select );
		$this->db->from( $table );
		$this->db->where( $where );
		$this->db->limit( $recordperpage , $page );
		$this->db->order_by( $orderBy_columName , $ASC_DESC );
		$result=$this->db->get();
		return $result;	
		
	}
			



}
?>