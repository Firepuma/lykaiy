<?php

class content extends Admin {
	private $status_arr;
	private $site_status;

    public function __construct() {
		parent::__construct();
    	$this ->site_status  = explode(chr(13), $this->site_config['site_status']);
		foreach ($this ->site_status as $val) {
	    	if ($val =='') continue;
		    list($statusid, $name) = explode('|', $val);	
			$this ->status_arr[trim($statusid)] = trim($name);
		}
	    $catid    = (int)$this->get('catid');
		$cc =  'catid-' . $catid ;
		if(!empty($this->auth[$cc]) && empty($this->admin['roleid'])) {
		$this->show_message('您没有该栏目管理权限');
		}
	}
	
	public function indexAction() {
	    $catid    = (int)$this->get('catid');
		if ($this->post('batch') && $this->post('status')=='del') {
	        foreach ($this->post('batch') as $id) {
	                $this->delAction($id, $catid, 1);
			}
			$this->show_message('删除成功', 1);
	    }elseif ($this->post('batch') && $this->post('status')=='move') {
		    $movecatid = (int)$this->post('movecatid');
			if (empty($movecatid)) $this->show_message('请选择目标栏目！',2,1);
			$movecat   = $this->category_cache[$movecatid];
		    $update = array('catid'=>$movecatid);
	        foreach ($this->post('batch') as $id) {
		    	$this->db->setTableName('content')->update($update,'id=?' , $id);
		    	$this->db->setTableName($movecat['tablename'])->update($update,'id=?' , $id);
			}
			$this->show_message('移动成功', 1);
	    }elseif ($this->post('status') == 'listorder' && $this->post('listorder')) {
     		foreach ($this->post('listorder') as $id => $value) {
	            $this->db->setTableName('content')->update(array('listorder'=>$value), 'id=?' , $id);
			}
			$this->show_message('排序成功', 1);
	    }elseif ($this->post('batch') && !$this->post('move')) {
		    $status = (int)$this->post('status');
			if (!isset($status)) $this->show_message('推荐位id不存在',2,1);
		    $update = array('status'=>$status);
	        foreach ($this->post('batch') as $id) {
		    	$this->db->setTableName('content')->update($update,'id=?' , $id);
			}
			$this->show_message('设置成功', 1);
	    }
	    $title       = $this->get('title');
	    $status    = $this->get('status');
	    $username  =  $this->get('username');
		$page     = (int)$this->get('page') ? (int)$this->get('page') : 1;
	    if (isset($status) && empty($status)) $this->db->where('status=?', '0');
	    if (!empty($status)) $this->db->where('status=?', $status);
		if (!empty($username)) $this->db->where('username=?', $username);
		if (!empty($title)) $this->db->where("`title` LIKE  ?",'%'.$title.'%');
		if (!empty($catid)) {
    		$child = $this->category_cache[$catid]['child'];
    		$allchildids = $this->category_cache[$catid]['allchildids'];
    		if(empty($child)) {
    		$this->db->where('catid=?',$catid);
    		} else {
    		$this->db->where('catid IN ('.$allchildids.')');
    		}
		}
	    $pagesize = empty($this->admin['list_size']) ? 10 : $this->admin['list_size'];
	    $list    = $this->db->setTableName('content')->pageLimit($page, $pagesize)->getAll(null,null,null,array('listorder DESC', 'time DESC'));
	    if (isset($status) && empty($status)) $this->db->where('status=?', '0');
	    if (!empty($status)) $this->db->where('status=?', $status);
		if (!empty($username)) $this->db->where('username=?', $username);
		if (!empty($title)) $this->db->where("`title` LIKE  ?",'%'.$title.'%');
		if (!empty($catid)) {
    		if(empty($child)){
    		$this->db->where('catid=?',$catid);
    		} else {
    		$this->db->where('catid IN ('.$allchildids.')');
    		}
		}
	    $total = $this->db->setTableName('content')->count();
	    $urlparam = array();
		if(!empty($catid)) $urlparam['catid']   = $catid;
	    if (isset($status) && empty($status)) $urlparam['status'] = '0';;
		if (!empty($status)) $urlparam['status'] = $status;
	    if (!empty($username)) $urlparam['username'] = $username;
	    if (!empty($title)) $urlparam['title'] = $title;
	    $pagelist = xiaocms::load_class('pager');
	    $pagelist = $pagelist->total($total)->url(url('content/index', $urlparam) . '&page=[page]')->ext(true)->num($pagesize)->page($page)->output();
		$modelid = $this->category_cache[$catid]['modelid'];
		$this->tree->icon = array(' ','  |-','  |-');
		$this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if(!$r['child'] && $modelid != $r['modelid']) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$this->tree->init($categorys);
		$category = $this->tree->get_tree(0, $str);
	    include $this->admin_tpl('content_list');
	}
	
	/**
	 * 发布
	 */
	public function addAction() {
	    $catid    = (int)$this->get('catid');
	    $modelid  = $this->category_cache[$catid]['modelid'];
	    if (!isset($this->content_model[$modelid])) $this->show_message('模型不存在');
	    if ($this->post('submit')) {
	        $data = $this->post('data');
		    if (empty($data['catid'])) $this->show_message('请选择发布栏目',2,1);
	        if (empty($data['title'])) $this->show_message('标题没有填写',2,1);
	        if ($this->category_cache[$data['catid']]['modelid'] != $modelid) $this->show_message('栏目模型对不上，请重新选择栏目',2,1); 
			$data = $this->post_check_fields($this->content_model[$modelid]['fields'], $data);
			$data = $this->additionalAction($data);
	        $data['username']  = $this->admin['username'];
	        $data['time'] = $data['time'] ? strtotime($data['time']):time();
	        $data['modelid']   = $modelid;
	        $data['status'] = isset($data['status']) ? $data['status']:1;
			$data['id'] = $this->db->setTableName('content')->insert($data,true);
			if (!is_numeric($data['id'])) 	        $this->show_message('发布失败');
			$id = $this->db->setTableName($this->category_cache[$catid]['tablename'])->insert($data,true);
			if (!is_numeric($id)) 	        $this->show_message('发布失败 添加附表失败');
			$msg = '<a href="' . url('content/add', array('catid'=>$data['catid'])) . '">继续添加</a>&nbsp;&nbsp;<a href="' . url('content/index', array('catid'=>$catid)) . '">返回列表</a>';
	        $this->show_message('添加成功' . '<div style="padding-top:10px;">' . $msg . '</div>', 1,url('content/add', array('catid'=>$data['catid'])),3000);
	    }
	    $data_fields = $this->get_data_fields($this->content_model[$modelid]['fields'], $data);
		$data['catid']=$catid;
		$this->tree->icon = array(' ','  ','  ');
		$this->tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if(!$r['child'] && $modelid != $r['modelid']) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$this->tree->init($categorys);
		$category = $this->tree->get_tree(0, $str);

	    include $this->admin_tpl('content_add');
	}
	
	/**
	 * 修改
	 */
    public function editAction() {
	    $id       = (int)$this->get('id');
	    $data     =  $this->db->setTableName('content')->find($id);
	    if (empty($data)) $this->show_message('内容不存在');
	    $catid    = $data['catid'];
	    $modelid  = $data['modelid'];
	    if (!isset($this->content_model[$modelid])) $this->show_message('模型不存在');
		$this->content_model[$modelid]       = $this->content_model[$modelid];
	    if ($this->post('submit')) {
	        $data = $this->post('data');
	        if (empty($data['title'])) $this->show_message('标题没有填写',2,1);
	        if ($data['catid'] != $catid && $modelid != $this->category_cache[$data['catid']]['modelid']) $this->show_message('栏目模型对不上，请重新选择栏目',2,1);
			$data = $this->post_check_fields($this->content_model[$modelid]['fields'], $data);
	        $data['time'] = $data['time'] ? strtotime($data['time']):time();
			$data = $this->additionalAction($data);
	        $data['modelid']    = (int)$modelid;
			$this->db->setTableName('content')->update($data,  'id=?' , $id);
			$this->db->setTableName($this->category_cache[$catid]['tablename'])->update($data,  'id=?' , $id);
			$msg = '修改成功&nbsp;&nbsp;<a href="' . url('content/index', array('catid'=>$catid)) . '" >点这返回列表</a>';
	        $this->show_message($msg, 1);
	    }
	    $table_data  =  $this->db->setTableName($this->content_model[$modelid]['tablename'])->find($id);
	    if ($table_data) $data = array_merge($data, $table_data);
	    $data_fields = $this->get_data_fields($this->content_model[$modelid]['fields'], $data);
		$this->tree->icon = array(' ','  ','  ');
		$this->tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if(!$r['child'] && $modelid != $r['modelid']) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$this->tree->init($categorys);
		$category = $this->tree->get_tree(0, $str);
	    include $this->admin_tpl('content_add');
	}
	
	/**
	 * 删除
	 */
	public function delAction($id=0,$catid=0,$show=0) {
	    $id    = $id ? $id : (int)$this->get('id');
	    $catid = $catid ? $catid : (int)$this->get('catid');
        if (empty($id)) $this->show_message('内容ID不存在');
	    $this->db->setTableName('content')->delete('id=?' , $id);
        if ($this->category_cache[$catid]['tablename']) 
		$this->db->setTableName($this->category_cache[$catid]['tablename'])->delete('id=?' , $id);
	    $show or $this->show_message('删除成功',1);
	}
	
	/**
	 * 相关内容
	 */
	public function relatedAction() {
	    $name    = $this->get('name');
	    $catid    = (int)$this->get('catid');
	    $title       = $this->get('title');
	    $status    = $this->get('status');
	    $username  =  $this->get('username');
		$page     = (int)$this->get('page') ? (int)$this->get('page') : 1;
	    if (isset($status) && empty($status)) $this->db->where('status=?', '0');
	    if (!empty($catid)) $this->db->where('catid=?', $catid);
	    if (!empty($status)) $this->db->where('status=?', $status);
		if (!empty($username)) $this->db->where('username=?', $username);
		if (!empty($title)) $this->db->where("`title` LIKE  ?",'%'.$title.'%');
	    $pagesize = 10;
	    $list    = $this->db->setTableName('content')->pageLimit($page, $pagesize)->getAll(null,null,null,array('listorder DESC', 'time DESC'));
	    if (!empty($catid)) $this->db->where('catid=?', $catid);
	    if (isset($status) && empty($status)) $this->db->where('status=?', '0');
	    if (!empty($status)) $this->db->where('status=?', $status);
		if (!empty($username)) $this->db->where('username=?', $username);
		if (!empty($title)) $this->db->where("`title` LIKE  ?",'%'.$title.'%');
	    $total = $this->db->setTableName('content')->count();
	    $urlparam = array();
		$urlparam['name'] = $name;
		if (!empty($catid)) $urlparam['catid'] = $catid;
		if (!empty($status)) $urlparam['status'] = $status;
	    if (!empty($username)) $urlparam['username'] = $username;
	    if (!empty($title)) $urlparam['title'] = $title;
	    $pagelist = xiaocms::load_class('pager');
	    $pagelist = $pagelist->total($total)->url(url('content/related', $urlparam) . '&page=[page]')->ext(true)->num($pagesize)->page($page)->output();
		$this->tree->icon = array(' ','  |-','  |-');
		$this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='".url('content/related', array('catid'=>'$catid','name'=>$name))."' \$selected \$disabled>\$spacer \$catname</option>";
		$this->tree->init($categorys);
		$category = $this->tree->get_tree(0, $str);
	    include $this->admin_tpl('related_list');
	}
	
    /**
	 * 标题是否重复检查
	 */
	public function check_titleAction() {
	    $title = $this->post('title');
	    $id    = (int)$this->post('id');
	    if (empty($title)) exit('<div class="onShow">标题不能为空</div>');
        $data    = $this->db->setTableName('content')->getOne(array('id<>'.$id, 'title=?'), $title );
	    if ($data) exit('<div class="onShow">已有相同的标题存在</div>');
	    exit('');
	}
	
    /**
	 * 附加
	 */
	private function additionalAction($data) {
	    $data['keywords'] = str_replace(array('，',' '), ',', $data['keywords']);
		$content = htmlspecialchars_decode($data['content']);
	    if (empty($data['description']) && isset($data['content']) && isset($data['xiao_auto_description'])) {
		    $data['description'] =   str_replace(array(' ', '　　'), array('',''), strcut(strip_tags($content), 200));
		}
		if (isset($data['content']) &&  $data['xiao_download_image'] && $this->site_config['site_download_image']) {
		    if (preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $imgs)) {
				$images	= array_unique($imgs[3]);
				$regex  = $replace = array();
				$path   =  'data/upload/image/' . date('Ym') . '/';
        		if (!is_dir(XIAOCMS_PATH .$path)) mkdirs(XIAOCMS_PATH .$path);
                $image = xiaocms::load_class('image');
				foreach ($images as $img) {
				if (strpos($img, SITE_URL) !== false || substr($img, 0, 7) != 'http://') continue;
				$fileext =  fileext($img);
				$name	 = $path . md5($img . time()) . '.' . $fileext;
				$content = @file_get_contents($img);
				if (empty($content)) continue;
			  	if (file_put_contents(XIAOCMS_PATH .$name, $content)) {
				    if ($this->site_config['site_watermark']) $image->watermark(XIAOCMS_PATH . $name,$this->site_config['site_watermark_pos']);
				}
				$regex[]   = $img;
				$replace[] = SITE_PATH . $name;
			    }
	    	}
			$result	=  count($regex) > 0 ? array('regex' => $regex, 'replace' => $replace) : null;
			if (isset($result) && $result) {
					$image	= $result['replace'][0];
					$data['content'] = str_replace($result['regex'], $result['replace'], $data['content']);
			}
		}
		if (empty($data['thumb']) && isset($data['content']) && isset($data['xiao_auto_thumb'])) {
		   if(preg_match("<img.*src=[\"](.*?)[\"].*?>", htmlspecialchars_decode($data['content']), $regs)) {
				$data['thumb'] = $regs[1];
		   }
		}
		return $data;
	}
	
}