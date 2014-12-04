<?php

class uploadfile extends Admin {
    
    protected $dir;
    
    public function __construct() {
		parent::__construct();
		$this->dir = 'data/upload/';
	}
	
	public function kindeditor_filemanagerAction() {
		$root_path = XIAOCMS_PATH . $this->dir;
		$root_url  = SITE_PATH . $this->dir;
		$ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
		$dir_name = $this->get('dir') == 'image' ? 'image' : 'file';
		if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
			echo "Invalid Directory name.";
			exit;
		}
		if ($dir_name !== '') {
			$root_path .= $dir_name . "/";
			$root_url .= $dir_name . "/";
			if (!file_exists($root_path)) {
				mkdir($root_path);
			}
		}
		if (empty($_GET['path'])) {
			$current_path = realpath($root_path) . '/';
			$current_url = $root_url;
			$current_dir_path = '';
			$moveup_dir_path = '';
		} else {
			$current_path = realpath($root_path) . '/' . $_GET['path'];
			$current_url = $root_url . $_GET['path'];
			$current_dir_path = $_GET['path'];
			$moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
		}
		$order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);
		if (preg_match('/\.\./', $current_path)) {
			echo 'Access is not allowed.';
			exit;
		}
		if (!preg_match('/\/$/', $current_path)) {
			echo 'Parameter is not valid.';
			exit;
		}
		if (!file_exists($current_path) || !is_dir($current_path)) {
			echo 'Directory does not exist.';
			exit;
		}
		$file_list = array();
		if ($handle = opendir($current_path)) {
			$i = 0;
			while (false !== ($filename = readdir($handle))) {
				if ($filename{0} == '.') continue;
				$file = $current_path . $filename;
				if (is_dir($file)) {
					$file_list[$i]['is_dir'] = true; 
					$file_list[$i]['has_file'] = (count(scandir($file)) > 2);
					$file_list[$i]['filesize'] = 0;
					$file_list[$i]['is_photo'] = false;
					$file_list[$i]['filetype'] = '';
				} else {
					$file_list[$i]['is_dir'] = false;
					$file_list[$i]['has_file'] = false;
					$file_list[$i]['filesize'] = filesize($file);
					$file_list[$i]['dir_path'] = '';
					$file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
					$file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
					$file_list[$i]['filetype'] = $file_ext;
				}
				$file_list[$i]['filename'] = $filename;
				$file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file));
				$i++;
			}
			closedir($handle);
		}

		function cmp_func($a, $b) {
			global $order;
			if ($a['is_dir'] && !$b['is_dir']) {
				return -1;
			} else if (!$a['is_dir'] && $b['is_dir']) {
				return 1;
			} else {
				if ($order == 'size') {
					if ($a['filesize'] > $b['filesize']) {
						return 1;
					} else if ($a['filesize'] < $b['filesize']) {
						return -1;
					} else {
						return 0;
					}
				} else if ($order == 'type') {
					return strcmp($a['filetype'], $b['filetype']);
				} else {
					return strcmp($a['filename'], $b['filename']);
				}
			}
		}
		usort($file_list, 'cmp_func');
		$result = array();
		$result['moveup_dir_path'] = $moveup_dir_path;
		$result['current_dir_path'] = $current_dir_path;
		$result['current_url'] = $current_url;
		$result['total_count'] = count($file_list);
		$result['file_list'] = $file_list;
		echo json_encode($result);
	}
	
	/**
	 * 附件管理
	 */
	public function managerAction() {
	    $iframe = $this->get('iframe') ? 1 : 0;
        $dir    = $this->get('dir') ? $this->get('dir') : '';
		$dir = str_replace(array('..\\', '../', './', '.\\'), '', trim($dir));
        $dir    = substr($dir, 0, 1) == '/' ? substr($dir, 1) : $dir;
        $dir    = str_replace(array('\\', '//'), DIRECTORY_SEPARATOR, $dir);
        $file_list = glob(XIAOCMS_PATH.$this->dir . $dir.'*');
		$data =$list = array();
        foreach($file_list as $v) {
            $data[] = basename ($v);
        }
        if ($data) {
            foreach ($data as $t) {
                if ($t == 'index.html') continue;
                $path = $dir . $t . '/';
				if (is_dir(XIAOCMS_PATH . $this->dir . $path))
				{
                   $dirlist[] = array(
                    'name'     => $t, 
                    'url'      =>  url('uploadfile/manager', array('dir'=>$path)) ,
					);
				}
				else{
                    $ext  = fileext($t);
		    		if($ext=='gif' ||$ext=='png' || $ext=='jpg' )
	    			$ico  = 'pic.gif' ;
			    	else 
			    	$ico  = 'file.gif' ;
			    	$list[] = array(
                          'name'     => $t, 
                          'ico'      => $ico,
			    	);
		 		}
			}
        }
        $pdir   = url('uploadfile/manager', array('dir'=>str_replace(basename($dir), '', $dir)));
        $dir    = $this->dir. $dir;
        include $this->admin_tpl('upload_manager');
	}

	/**
	 * uploadify_upload
	 */
    public function uploadify_uploadAction() {
	    $type = $this->get('type');
		$size = (int)$this->get('size');
	    if ($this->post('submit')) {
	        $data = $this->upload('file', explode(',', $type), $size);
            if ($data['result']) echo $data['path'];
	    }
	}

	/**
     * 编辑器上传
     */
	public function kindeditor_uploadAction() {
        $ext_arr = array(
           	'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
          	'flash' => array('swf', 'flv'),
          	'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
          	'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
         );
        $dir_name = $this->get('dir') ? $this->get('dir')  : 'image';
        if (empty($ext_arr[$dir_name])) {
		    echo json_encode(array('error' => 1, 'message' => '目录名不正确。'));
			exit;
        }
		$data = $this->upload('imgFile', $ext_arr[$dir_name]);
		if (!$data['result']) {
			echo json_encode(array('error' => 1, 'message' => ''));exit;
		} else {
			echo json_encode(array('error' => 0, 'url' => $data['path']));exit;
		}
		
	}

    /**
     * 文件上传
     */
    private function upload($fields, $type, $size=0) {
		$upload   = xiaocms::load_class('upload');
        $ext      = strtolower(substr(strrchr($_FILES[$fields]['name'], '.'), 1));
        if (in_array($ext, array('jpg','jpeg','bmp','png','gif'))) {
            $dir  = 'image';
        } else {
            $dir  = 'file';
        }
        $path    = $this->dir .$dir . '/' . date('Ym') . '/';
		if (!is_dir(XIAOCMS_PATH.$path)) mkdirs(XIAOCMS_PATH.$path);
        $file     = $_FILES[$fields]['name'];
	    $filename = md5(time() . $_FILES[$fields]['name']) . '.' . $ext;
		$filenpath = $path.$filename;
        $result   = $upload->set_limit_size(1024*1024*$size)->set_limit_type($type)->upload($_FILES[$fields],XIAOCMS_PATH.$filenpath);
        if (in_array($ext, array('jpg', 'gif', 'png', 'bmp'))) {
		$this->watermark(XIAOCMS_PATH.$filenpath);
        }
        return array('result'=>$result, 'path'=>  SITE_PATH . $filenpath, 'file'=>$file , 'ext'=>$dir=='image' ? 1 : $ext);
    }
	
	
}