<?php
class portfolioproject_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'portfolio_project';
    }
    /**

     * insert a user to user table

     * @param $data

     * @return mixed

     */
    public function addProject($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }



    public function getUserPortfolioProjects($id) {

        $sql = "SELECT * FROM " . $this->table . " WHERE uid=$id";

        return $this->db->query($sql)->result_array();

    }



    public function delProject($pid) {

        $sql = "DELETE FROM  " . $this->table . " WHERE pid=$pid";

        $this->db->query($sql);

        return $this->db->affected_rows()>0;

    }
	
        /**
         * Check whether the User has uploaded allowed number of IMAGES ie 12. Then return status to upload next image or not.
         * 
         * @param type $uid USER ID
         * @return BOOLEAN
         */
        public function canUploadPortfolioImage($uid)
        {
            $sql    =   "SELECT count(*) as count FROM " . $this->table . " WHERE uid=$uid";
            $array  =   $this->db->query($sql)->result_array();    
            if($array[0]['count']<12) // Maximum allowed is 12 Images. 
                return TRUE;
            else
                return FALSE;
        }  
    
        #############################################################################################################
    
	/**
         * Thumb Generation with fixed width & height may vary based on the original image
         * 
         * URL: proportionThumbGeneration($unique_name,'attached/workExamples/tmp/','attached/workExamples/500/',500,275);
         * 
         * @param type $imgname
         * @param type $old_location
         * @param type $new_location
         * @param type $thumb_width
         * @param type $thumb_height
         */
	public function proportionThumbGeneration($imgname, $old_location, $new_location, $thumb_width, $thumb_height)
	{
                $sizes 					= 	getimagesize($old_location.$imgname);
		//344 * 160  size image generation start
		if($sizes[0]>$thumb_width)
		{						
			$max_width                      = 	$thumb_width;// Max width allowed for the large image
			$large_image_location		= 	$old_location;
			$thumb_image_location		= 	$new_location;
	
			if($sizes[2] == 1)
				$imgformat		=	strtoupper('gif');
			elseif($sizes[2] == 2)
				$imgformat		=	strtoupper('jpg');
			elseif($sizes[2] == 3)
				$userfile_type          =       strtoupper('png');
			$filename                       = 	$imgname;//$userfile_name
			$file_ext                       = 	strtolower(substr($filename, strrpos($filename, '.') + 1));	
			if($filename)
			{
				//this file could now has an unknown file extension (we hope it's one of the ones set above!)
				$large_image_location 		= 	$large_image_location.$filename;
				$thumb_image_location 		= 	$thumb_image_location.$imgname;  //$userfile_name;

				copy($large_image_location, $thumb_image_location);
	
				$temp_loc		=	$large_image_location;
				$large_image_location 	= 	$thumb_image_location;
				$thumb_image_location   =	$temp_loc;
	
				$width 			= 	$this->getWidth($large_image_location);
				$height 		= 	$this->getAvatarHeight($large_image_location);
	
				//Scale the image if it is greater than the width set above
				if ($width > $max_width)
				{
					$scale 		= 	$max_width/$width;
					$uploaded 	= 	$this->resizeImage($large_image_location,$width,$height,$scale);
				}
				else
				{
					$scale          =       1;
					$uploaded 	=       $this->resizeImage($large_image_location,$width,$height,$scale);
				}
			}
		}
		else
		{
                        copy($old_location.$imgname,$new_location.$imgname);	
		}
	}        

	/**
	 * this function used to resize image
	 *
	 * @return string 
	 */
	function resizeImage($image,$width,$height,$scale) 
	{
		$image_data         =   getimagesize($image);
		$imageType          =   image_type_to_mime_type($image_data[2]);
		$newImageWidth      =   ceil($width * $scale);
		$newImageHeight     =   ceil($height * $scale);
		$newImage           =   imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image);
				//******transprency
				//settransparency($newImage,$source);
				//******transprency
				break;
		case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image);
				break;
		case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image);
				//******transprency
				//settransparency($newImage,$source);
				//******transprency
				break;
		}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		
		switch($imageType)
                {
			case "image/gif":
				imagegif($newImage,$image); 
				break;
                        case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$image,90);
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$image);
				break;
                }		
		chmod($image, 0777);
		return $image;
	}
	/**
	 * this function used to resize image
	 *
	 * @return string 
	 */
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale)
        {
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
		case "image/gif":
				$source=imagecreatefromgif($image);
				break;
		case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image);
				break;
		case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image);
				break;
		}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
				imagegif($newImage,$thumb_image_name);
				break;
		case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				imagejpeg($newImage,$thumb_image_name,90);
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);
				break;
	}
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}
	
	
	/**
	 * this function used to get height of image
	 *
	 * @return int 
	 */
	function getAvatarHeight($image) {
		$size = getimagesize($image);
		$height = $size[1];
		return $height;
	}	

	/**
	 * this function used to get width of image
	 *
	 * @return int 
	 */
	function getWidth($image) {
		$size = getimagesize($image);
		$width = $size[0];
		return $width;
	}
	#############################################################################################################    
	

}