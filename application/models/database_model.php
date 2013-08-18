<?php
class database_model extends MY_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->dbutil();
	}
    
	public function backup()
	{
		// 备份整个数据库
		$backup =& $this->dbutil->backup();
		
		// 加载文件辅助函数并将文件写入服务器
		$this->load->helper('file');
		$filename = 'backup-'.date('YmdHi',time()).'.gz';
		write_file(FCPATH.$filename, $backup);
		
		// 加载下载辅助函数并下载
		$this->load->helper('download');
		force_download($filename, $backup);
		return true;
	}
	
	public function optimize()
	{
		return $this->dbutil->optimize_table('table_name');
	}
	
	public function sql()
	{
	
	}
}