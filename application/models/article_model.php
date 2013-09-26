<?php
class article_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'article';
	}
	
	public function getListByCat($cat, $lang, $limit=100)
	{
		if (is_numeric($cat))
		{
			$cid = $cat;
		}
		else // if $cat is character
		{
			$this->table = 'category';
			$cat_arr = $this->getOne($cat, 'cat_url');
			if($cat_arr)
			{
				$cid = $cat_arr['cid'];
			}
			else 
			{
				exit('Can\'t find category: '.$cat );
			}
			$this->table = 'article';
		}
		return $this->getTable(array('cid'=>$cid,'lang'=>$lang), $limit, 'date DESC', $lang);
	} 
	
	public function getBlock($key, $lang)
	{
		$result = $this->getOne($key, 'url', $lang);
		return $result['content'];
	}

    public function getLatestArtical($limit=4){
        $sql = "SELECT * FROM article ORDER BY date DESC LIMIT 0, $limit";
        $rtn = $this->db->query($sql)->result_array();
        return $rtn;
    }
	
}