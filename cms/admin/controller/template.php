<?php

class template extends Admin {
    
    private $dir;
   	private $file_info;

    public function __construct() {
		parent::__construct();
		$this->dir = TEMPLATE_DIR . SYS_THEME_DIR;
		if (file_exists($this->dir.'config.php')) {
			$this->file_info = include $this->dir.'config.php';
		}
	}
    
    public function indexAction() {
        $dir    = $this->get('dir') ? urldecode($this->get('dir')) : '';
		$dir = str_replace(array('..\\', '../', './', '.\\'), '', trim($dir));
        $dir    = substr($dir, 0, 1) == '/' ? substr($dir, 1) : $dir;
        $dir    = str_replace(array('\\', '//'), DIRECTORY_SEPARATOR, $dir);
        $filepath = $this->dir.$dir;
        $list = glob($filepath.'*');
		$local = str_replace(XIAOCMS_PATH, '', $filepath);	
		$encode_local = str_replace(array('/', '\\'), '|', $local);
		$file_explan = $this->file_info['file_explan'];
        include $this->admin_tpl('template_list');

    }

	public function updatefilenameAction() {
		$file_explan = $this->post('file_explan') ? $this->post('file_explan') : '';
		if (!isset($this->file_info['file_explan'])) $this->file_info['file_explan'] = array();
		$this->file_info['file_explan'] = array_merge($this->file_info['file_explan'], $file_explan);
		@file_put_contents($this->dir.'config.php', '<?php return '.var_export($this->file_info, true).';?>');
		$this->show_message('提交成功',1);
	}
	
    public function editAction() {
        $dir    = $this->get('dir') ? urldecode($this->get('dir')) : '';
		$dir = str_replace(array('..\\', '../', './', '.\\'), '', trim($dir));
        $dir    = substr($dir, 0, 1) == '/' ? substr($dir, 1) : $dir;
        $dir    = str_replace(array('\\', '//'), DIRECTORY_SEPARATOR, $dir);
        $filename  = urldecode($this->get('file'));
        $filepath = $this->dir . $dir.$filename;
		$ext  = fileext($filepath);
		if (!in_array($ext, array('html', 'css', 'js', 'txt'))) $this->show_message('文件名后缀不对',2,1);

		$local = str_replace(XIAOCMS_PATH, '', $filepath);	
		if (!is_file($filepath)) $this->show_message($dir.$filename.'该文件不存在',2, url('template', array('dir'=>$dir)));
		if ($this->post('submit')) {
		    file_put_contents($filepath, htmlspecialchars_decode($this->post('file_content')), LOCK_EX);
		    $this->show_message('提交成功',1);
		}
        $filecontent = htmlspecialchars(file_get_contents($filepath));
        include $this->admin_tpl('template_add');
    }
	
	public function addAction() {
        $dir    = $this->get('dir') ? urldecode($this->get('dir')) : '';
		$dir = str_replace(array('..\\', '../', './', '.\\'), '', trim($dir));
        $dir    = substr($dir, 0, 1) == '/' ? substr($dir, 1) : $dir;
        $dir    = str_replace(array('\\', '//'), DIRECTORY_SEPARATOR, $dir);
        $filepath = $this->dir . $dir;
		$local = str_replace(XIAOCMS_PATH, '', $filepath);
		$filecontent = '';
		if ($this->post('submit')) {
		    $filename = $this->post('file_name');
    		if (file_exists($filepath . $filename)) {
    		$this->show_message('该文件已经存在' ,2,1);
    		}
			$ext  = fileext($filename);
			if (!in_array($ext, array('html', 'css', 'js' , 'txt'))) $this->show_message('文件名后缀不对',2,1);
			file_put_contents($filepath . $filename, $this->post('file_content'), LOCK_EX);
		    $this->show_message('提交成功',1, url('template', array('dir'=>$dir)) );
		}
        include $this->admin_tpl('template_add');
    }

	public function delAction() {
        $dir    = $this->get('dir') ? urldecode($this->get('dir')) : '';
		$dir = str_replace(array('..\\', '../', './', '.\\'), '', trim($dir));
        $dir    = substr($dir, 0, 1) == '/' ? substr($dir, 1) : $dir;
        $dir    = str_replace(array('\\', '//'), DIRECTORY_SEPARATOR, $dir);
        $filename  = urldecode($this->get('file'));
        $filepath = $this->dir . $dir.$filename;
//为了错误删除模板先注销掉		
//    	if (@unlink($filepath))
//		$this->show_message('删除成功',1);
//		else
//		$this->show_message('删除失败',2, url('template', array('dir'=>$dir)));
	}
	
	public function cacheAction() {
		$dir = DATA_DIR . 'tplcache';
	    delete_dir($dir);
		if (!file_exists($dir)) mkdirs($dir);
	    $this->show_message('缓存更新成功',1, url('template/index'));
	}
	
}