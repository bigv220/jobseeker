<?php
class article_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->table = 'article';
	}
	
        /**
         * On the Home, we need to display latest HOT NEWS. There is no time associated with date and thus two posting on same date
         * doesnt have any difference. So for HOT NEWS, I am passing an additional ORDER BY field named "aid" which is an autoincrement field.
         * 
         */
	public function getListByCat($cat, $lang, $limit=100,$order_by='')
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
                
                // Modified on Jan/25/2014 See comments on top.
                if($order_by=='')
                    $order_by   =    'date DESC';
                
		return $this->getTable(array('cid'=>$cid,'lang'=>$lang), $limit, $order_by, $lang);
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