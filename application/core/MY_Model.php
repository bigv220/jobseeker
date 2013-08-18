<?php
class MY_Model extends CI_Model 
{
	
	public $table = '';
	
	public function __construct()
	{
		parent::__construct();
	}
	/*
	public function setTable($name)
	{
		$this->table = $name;
	}
	
	public function getTable($name)
	{
		return $this->table;
	}
	*/
	public function add($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function delete($id, $key)
	{
		return $this->db->delete($this->table, array($key => $id));
	}
	
	public function edit($data, $key)
	{
		return $this->db->where($key, $data[$key])->update($this->table, $data);
	}

    public function getOne($id, $key, $lang = null)
    {
    	$where = $lang ? array($key=>$id, 'lang'=>$lang) : array($key=>$id);
        return $this->db->select('*')
					->from($this->table)
					->where($where)
					->get()->row_array();
    }
    
    /**
     * get table
     * @param Array $where
     * @param int $limit
     * @param String $order
     */
	public function getTable($where = null, $limit=100, $order = null)
	{
		$this->db->select('*')->from($this->table);
		if ($where != null) 
        {
            $this->db->where($where);
        } 
        if ($order != null) 
        {
        	$this->db->order_by($order);
        }
        if (is_numeric($limit))
        {
        	$this->db->limit($limit);
        }
        else 
        {
        	$limit_arr = explode(',', $limit);
        	$this->db->limit($limit_arr[0], $limit_arr[1]);
        }
        return $this->db->get()->result_array();
        
		/*if (count($limit_arr) == 2)
        {
        	$this->db->limit($limit_arr[0], $limit_arr[1]);
        }
        else
        {
        	$this->db->limit($limit);
        }*/
        /*
        if ($where == null) 
        {
            return $this->db->get($this->table, $limit)->result_array();
        } 
        else if ($order == null) 
        {
            $this->db->select('*')
            				->from($this->table)
            				->where($where);
            return $this->db->limit($limit)
            				->get()->result_array();
        } 
        else 
        {
            $this->db->select('*')
            				->from($this->table)
            				->where($where)
            				->order_by($order);
            return $this->db->limit($limit)
            				->get()->result_array();
        }
        */
	}
	
	/**
	 * get total
	 * @param String $where
	 * @return int
	 */
	public function getTotal($where = null)
	{
		if ($where == null) 
        {
            /*return $this->db->query('SELECT COUNT(*) AS num 
            						FROM '.$this->db->dbprefix($this->table))
            				->row()->num;*/
        	return $this->db->select('COUNT(*)')
				        	->from($this->table)
				        	->count_all_results();
        } 
        else 
        {
        	/*return $this->db->query('SELECT COUNT(*) AS num
            						FROM '.$this->db->dbprefix($this->table).'
            						WHERE '.$where)
        	            						->row()->num;*/
        	return $this->db->select('COUNT(*)')
				        	->from($this->table)
				        	->where($where)
				        	->count_all_results();
        }
	}
	
}