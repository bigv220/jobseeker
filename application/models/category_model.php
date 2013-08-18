<?php
class category_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'category';
	}
	
	public function order($data)
	{
		try {
			foreach ($data as $k => $v) {
				$where = array('sort_order'=>$v);
				$this->db->where('cid', $k)
						->update($this->table, $where); 
			}
		} catch (Exception $e) {
			exit($e);
		}
		return TRUE;
	}
	
	/*
	// 
	public function getCatList($cat_id = 0)
	{
		$cat_arr = $this->db->select('*')
					->from($this->table)
					->get()->result_array();
		return $cat_arr;
		/*$cat_rst = array();
		foreach ($cat_arr as $row)
		{
			if ($row['pid'] == $cat_id)
			{
				$cat_rst[] = $row;
			}
			$cat_id = $row['cid'];
			
		}* /
		$rst = $this->getCatTree(0, 0, $cat_arr);
		
		return $rst;
	}
	
	// 
	public $arr = array();
	public function getCatTree($cat_id, $level=0, $arr)
	{
		$this->arr = $arr;
		$num = count($arr);
		for ($i = 0; $i < $num; $i++) 
		{
			if ($this->arr[$i]['pid'] == $cat_id)
			{
				$this->arr[$i]['level'] = $level;
				echo $this->arr[$i]['name'];
			}
			$this->getCatTree($this->arr[$i]['cid'], $level+1, $this->arr);
		}
		return $this->arr;
	}
	*/
	
	/**
	 * 获得指定分类下的子分类的数组
	 *
	 * @access  public
	 * @param   int     $cat_id     分类的ID
	 * @param   int     $selected   当前选中分类的ID
	 * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
	 * @param   int     $level      限定返回的级数。为0时返回所有级数
	 * @return  mix
	 */
	public function getCatList($cat_id = 0, $selected = 0, $re_type = FALSE, $level = 0)
	{
		$res = $this->db->query('SELECT c.*, COUNT(s.cid) AS has_children, a.url
								FROM etonn_'.$this->table.' AS c
								LEFT JOIN etonn_'.$this->table.' AS s 
								ON s.pid=c.cid
								LEFT JOIN etonn_article AS a 
								ON a.cid=c.cid
								GROUP BY c.cid 
								ORDER BY pid, sort_order ASC, cid')
					->result_array();
		if (empty($res) == true)
	    {
	        return $re_type ? '' : array();
	    }
		
	    $options = $this->article_cat_options_test($cat_id, $res); // 获得指定分类下的子分类的数组
		
	    /* 截取到指定的缩减级别 */
	    if ($level > 0)
	    {
	        if ($cat_id == 0)
	        {
	            $end_level = $level;
	        }
	        else
	        {
	            $first_item = reset($options); // 获取第一个元素
	            $end_level  = $first_item['level'] + $level;
	        }
	
	        /* 保留level小于end_level的部分 */
	        foreach ($options AS $key => $val)
	        {
	            if ($val['level'] >= $end_level)
	            {
	                unset($options[$key]);
	            }
	        }
	    }
	
	    $pre_key = 0;
	    foreach ($options AS $key => $value)
	    {
	        $options[$key]['has_children'] = 1;
	        if ($pre_key > 0)
	        {
	            if ($options[$pre_key]['cid'] == $options[$key]['pid'])
	            {
	                $options[$pre_key]['has_children'] = 1;
	            }
	        }
	        $pre_key = $key;
	    }
		
	    if ($re_type == true)
	    {
	        $select = '';
	        foreach ($options AS $var)
	        {
	            $select .= '<option value="' . $var['cid'] . '" ';
	            $select .= ' cat_type="' . $var['model'] . '" ';
	            $select .= ($selected == $var['cid']) ? "selected='ture'" : '';
	            $select .= '>';
	            if ($var['level'] > 0)
	            {
	                $select .= str_repeat('&nbsp;', $var['level'] * 4);
	            }
	            $select .= htmlspecialchars(addslashes($var['name'])) . '</option>';
	        }
	
	        return $select;
	    }
	    else
	    {
	        foreach ($options AS $key => $value)
	        {
	            //$options[$key]['url'] = build_uri('article_cat', array('acid' => $value['cat_id']), $value['cat_name']);
	        }
		
	        return $options;
	    }
	}
	
	/**
	 * 过滤和排序所有文章分类，返回一个带有缩进级别的数组
	 *
	 * @access  private
	 * @param   int     $cat_id     上级分类ID
	 * @param   array   $arr        含有所有分类的数组
	 * @param   int     $level      级别
	 * @return  void
	 */
	public function article_cat_options_test($spec_cat_id, $arr)
	{
	    static $cat_options = array();
	
	    if (isset($cat_options[$spec_cat_id]))
	    {
	        return $cat_options[$spec_cat_id];
	    }
	
	    if (!isset($cat_options[0]))
	    {
	        $level = $last_cat_id = 0;
	        $options = $cat_id_array = $level_array = array();
	        while (!empty($arr))
	        {
	            foreach ($arr AS $key => $value)
	            {
	                $cat_id = $value['cid'];
	                if ($level == 0 && $last_cat_id == 0)
	                {
	                    if ($value['pid'] > 0)
	                    {
	                        break;
	                    }
	
	                    $options[$cat_id]          = $value;
	                    $options[$cat_id]['level'] = $level;
	                    //$options[$cat_id]['id']    = $cat_id;
	                    $options[$cat_id]['name']  = $value['name'];
	                    //$options[$cat_id]['url']  = $value['url'];
	                    unset($arr[$key]);
	
	                    if ($value['has_children'] == 0)
	                    {
	                        continue;
	                    }
	                    $last_cat_id  = $cat_id;
	                    $cat_id_array = array($cat_id);
	                    $level_array[$last_cat_id] = ++$level;
	                    continue;
	                }
	
	                if ($value['pid'] == $last_cat_id)
	                {
	                    $options[$cat_id]          = $value;
	                    $options[$cat_id]['level'] = $level;
	                    //$options[$cat_id]['id']    = $cat_id;
	                    $options[$cat_id]['name']  = $value['name'];
	                    //$options[$cat_id]['url']  = $value['url'];
	                    unset($arr[$key]);
	
	                    if ($value['has_children'] > 0)
	                    {
	                        if (end($cat_id_array) != $last_cat_id)
	                        {
	                            $cat_id_array[] = $last_cat_id;
	                        }
	                        $last_cat_id    = $cat_id;
	                        $cat_id_array[] = $cat_id;
	                        $level_array[$last_cat_id] = ++$level;
	                    }
	                }
	                elseif ($value['pid'] > $last_cat_id)
	                {
	                    break;
	                }
	            }
	
	            $count = count($cat_id_array);
	            if ($count > 1)
	            {
	                $last_cat_id = array_pop($cat_id_array);
	            }
	            elseif ($count == 1)
	            {
	                if ($last_cat_id != end($cat_id_array))
	                {
	                    $last_cat_id = end($cat_id_array);
	                }
	                else
	                {
	                    $level = 0;
	                    $last_cat_id = 0;
	                    $cat_id_array = array();
	                    continue;
	                }
	            }
	
	            if ($last_cat_id && isset($level_array[$last_cat_id]))
	            {
	                $level = $level_array[$last_cat_id];
	            }
	            else
	            {
	                $level = 0;
	            }
	        }
	        $cat_options[0] = $options;
	    }
	    else
	    {
	        $options = $cat_options[0];
	    }
	
	    if (!$spec_cat_id)
	    {
	        return $options;
	    }
	    else
	    {
	        if (empty($options[$spec_cat_id]))
	        {
	            return array();
	        }
	
	        $spec_cat_id_level = $options[$spec_cat_id]['level'];
			
	        foreach ($options AS $key => $value)
	        {
	            if ($key != $spec_cat_id)
	            {
	                unset($options[$key]);
	            }
	            else
	            {
	                break;
	            }
	        }
	
	        $spec_cat_id_array = array();
	        foreach ($options AS $key => $value)
	        {
	            if (($spec_cat_id_level == $value['level'] && $value['cid'] != $spec_cat_id) ||
	                ($spec_cat_id_level > $value['level']))
	            {
	                break;
	            }
	            else
	            {
	                $spec_cat_id_array[$key] = $value;
	            }
	        }
	        $cat_options[$spec_cat_id] = $spec_cat_id_array;
	
	        return $spec_cat_id_array;
	    }
	}
	
}
