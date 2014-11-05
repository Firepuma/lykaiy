<?php

class category extends Admin {
    
    public function __construct() {
		parent::__construct();
	}

	public function indexAction() {
	    if ($this->post('listorder')) {
     		foreach ($this->post('listorder') as $catid => $value) {
	            $this->db->setTableName('category')->update(array('listorder'=>$value), 'catid=?' , $catid);
			}
	        $this->cacheAction();
			$html = '<script type="text/javascript">parent.document.getElementById(\'leftMain\').src =\' ?c=index&a=tree\';</script>';
			$this->show_message('设置成功'. $html, 1);
	    }
		$this->tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
		$this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$categorys = array();
		$cats =  $this->db->setTableName('category')->findAll(null,'listorder DESC,catid ASC');
		$types = array(1 => '',2 => '<font color="blue">单页面</font>',3 => '<font color="red">外部连接</font>');
		if(!empty($cats)) {
			foreach($cats as $r) {
				$r['modelname'] = @$this->content_model[$r['modelid']]['modelname'];
				$r['str_manage'] = '<a href="'.url('category/add', array('catid'=>$r['catid'])).'" >添加子栏目</a> | <a href="'.url('category/edit', array('catid'=>$r['catid'])).'">编辑</a> | <a href="javascript:confirmurl(\''.url('category/del', array('catid'=>$r['catid'])).'\',\''.'确定删除 『 '.$r['catname'].' 』栏目吗？ '.'\')">删除</a>';
				$r['typename'] = $types[$r['typeid']];
				$r['display'] = $r['ismenu'] ? '是' : '<font color="red">否</font>';
				$r['catname'] = "<a href='" . $this->view->get_category_url($r)."' target='_blank'>".$r['catname']."</a>";
				$categorys[$r['catid']] = $r;
			}
		}
		$str  = "<tr> 
					<td align='left'><input name='listorder[\$catid]' type='text' size='1' value='\$listorder' class='input-text-c'></td>
					<td align='left'>\$catid</td>
					<td >\$spacer\$catname</td>
					<td>\$typename\$modelname</td>
					<td>\$items</td>
					<td>\$display</td>
					<td >\$str_manage</td>
					</tr>";
		$this->tree->init($categorys);
		$categorys = $this->tree->get_tree(0, $str);	
		include $this->admin_tpl('category_list');
	}

	/**
	 * 添加栏目
	 */
	public function addAction() {
	    if ($this->post('submit')) {
	        $data = $this->post('data');
	        if ($data['typeid'] == 1) {
	            if (empty($data['modelid'])) $this->show_message('请选择内容模型',2,1);
	        } elseif ($data['typeid'] == 2) {
			    $data['modelid'] = 0;
	        } elseif ($data['typeid'] == 3) {
			    $data['modelid'] = 0;
	            if (empty($data['http'])) $this->show_message('没有输入外部连接地址',2,1);
	        } else {
	            $this->show_message('请选择栏目类型',2,1);
	        }
	        if ($this->post('addall')) {//批量添加
			    $names  = $this->post('names');
				if (empty($names)) $this->show_message('请填写栏目名称',2,1);
				$names  = explode(chr(13), $names);
				foreach ($names as $val) {
				    list($catname, $catdir) = explode('|', $val);
					$catdir = $catdir ? $catdir : word2pinyin($catname);
	    			if ($data['typeid'] != 3) {
		            $iscatdir =  $this->check_catdirAction($catdir);				
				    if ($iscatdir) $catdir .= rand(1, 20);
					}
					$data['catname'] = trim($catname);
					$data['catdir']  = trim($catdir);
				    $catid = $this->db->setTableName('category')->insert($data,true);
				    if (!is_numeric($catid)) $this->show_message('添加失败',2);
				}
	        	$this->cacheAction();
				$html = '<script type="text/javascript">parent.document.getElementById(\'leftMain\').src =\' ?c=index&a=tree\';</script>';
				$this->show_message('批量添加成功'. $html, 1, url('category/index'));
			} else {//单个添加
				if (!$data['catname'] ) $this->show_message('请填写栏目名称',2,1);
		        $iscatdir = $this->check_catdirAction($data['catdir']);
				if ($data['typeid'] != 3 && $iscatdir)  $this->show_message( '栏目目录为空或者已经存在',2,1);
				$data['catid'] = $this->db->setTableName('category')->insert($data,true);
				if (!is_numeric($data['catid'])) $this->show_message('添加失败',2);
	        	$this->cacheAction();
				$html = '<script type="text/javascript">parent.document.getElementById(\'leftMain\').src =\' ?c=index&a=tree\';</script>';
				$this->show_message($data['catname'] . ' 添加成功'. $html, 1, url('category/index'));
			}
	    }
		$catdata =  $this->db->setTableName('category')->findAll(array('catid', 'catname','parentid'),'listorder DESC,catid ASC');
	    $catid   = (int)$this->get('catid');
		$add  = 1;
		$this->tree->icon = array(' ','  |-','  |-');
		$this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$category_select = array();
		if(!empty($catdata)) {
			foreach($catdata as $r) { 
				$category_select[$r['catid']] = $r;
			}
		}
		$str  = "<option value='\$catid' \$selected>\$spacer \$catname</option>";
		$this->tree->init($category_select);
		$category_select = $this->tree->get_tree_category(0, $str,'2',$catid);
	    include $this->admin_tpl('category_add');
	}
	
	/**
	 * 修改栏目
	 */
    public function editAction() {
        $catid   = (int)$this->get('catid');
        $data    = $this->db->setTableName('category')->find($catid);
        if (empty($data)) $this->show_message('栏目不存在');
        $istype    = $this->db->setTableName('content')->getOne('catid=?', $catid);
	    if ($this->post('submit')) {
	        $data  = $this->post('data');
	        if ($data['typeid'] == 1) {
	            if (empty($data['modelid'])) $this->show_message('请选择内容模型',2,1);
	        } elseif ($data['typeid'] == 2) {
			    $data['modelid'] = 0;
	        } elseif ($data['typeid'] == 3) {
			    $data['modelid'] = 0;
	            if (empty($data['http'])) $this->show_message('没有输入外部连接地址',2,1);
	        }
	        if (empty($data['catname'])) $this->show_message('请填写栏目名称',2,1);
	        if ($this->check_catdirAction($data['catdir'],$catid)) $this->show_message( '栏目路径为空或者已经存在',2,1);
            $this->db->setTableName('category')->update($data, 'catid=' . $catid);
	    	$this->cacheAction();
			$html = '<script type="text/javascript">parent.document.getElementById(\'leftMain\').src =\' ?c=index&a=tree\';</script>';
            $this->show_message($data['catname'].' 修改成功'.$html, 1, url('category/index'));
	    }
		$catdata =  $this->db->setTableName('category')->findAll(array('catid', 'catname','parentid'),'listorder DESC,catid ASC');
		$this->tree->icon = array(' ','  |-','  |-');
		$this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		$category_select = array();
		if(!empty($catdata)) {
			foreach($catdata as $r) {
				$category_select[$r['catid']] = $r;
			}
		}
		$str  = "<option value='\$catid' \$selected>\$spacer \$catname</option>";
		$this->tree->init($category_select);
		$category_select = $this->tree->get_tree_category(0, $str,'2',$data['parentid']);
	    include $this->admin_tpl('category_add');
	}
	
	/**
	 * 删除栏目
	 */
	public function delAction() {
	    $catid = (int)$this->get('catid');
		$catids = $this->get_childAction($catid);
		$catidarr = explode(',', $catids);
	    foreach ($catidarr as $catid) {
		    if(empty($catid)) continue;
	        $this->db->setTableName('category')->delete('catid=?' , $catid);
	        if ($this->category_cache[$catid]['tablename']) {
	        $this->db->setTableName('content')->delete('catid=?' , $catid);
	        $this->db->setTableName($this->category_cache[$catid]['tablename'])->delete('catid=?' , $catid);
	        }
        }
    	$this->cacheAction();
		$html = '<script type="text/javascript">parent.document.getElementById(\'leftMain\').src =\' ?c=index&a=tree\';</script>';
        $this->show_message('删除成功'.$html, 1, url('category/index'));

	}


	/**
	 * 更新栏目缓存
	 */
	public function cacheAction() {
	    $this->repairAction(); 
		$data =  $this->db->setTableName('category')->findAll(null,'listorder DESC,catid ASC');
	    $category  = $category_dir = $category_lite= array();
	    foreach ($data as $t) {
			$category_dir[$t['catdir']]   = $t['catid'];
	        $catid = $t['catid'];
	        $category[$catid] = $t;
	        if ($t['typeid'] == 1) {
	            $category[$catid]['tablename'] = $tablename = $this->content_model[$t['modelid']]['tablename'];
	            $category[$catid]['modelname'] = $this->content_model[$t['modelid']]['modelname'];
	        }
			$category[$catid]['childids'] = $category[$catid]['childids'] . $catid;
			$category[$catid]['allchildids'] = rtrim($this->get_childAction($catid),',');
			$category[$catid]['url'] = $this->view->get_category_url($t);
			$total_num = $this->db->setTableName('content')->where('catid IN ('.$category[$catid]['allchildids'].')')->count();
			$category[$catid]['items'] = $total_num;
			$this->db->setTableName('category')->update(array('items'=>$total_num), 'catid=?' , $catid);
	        $category[$catid]['content'] = htmlspecialchars_decode($category[$catid]['content']);
	    }
	    set_cache('category', $category);
	    set_cache('category_dir', $category_dir);
	}
	
	/**
	 * 判断栏目目录是否重复
	 */
    private function check_catdirAction($catdir = '',$catid=0) {
	    if(!$catdir) return true;
	    if($this->db->setTableName('category')->getAll(array('catdir=?', 'catid<>?') ,array($catdir, $catid)))
		return true;
	    else
		return false;
	}
	
	/**
	* 修复栏目数据
	*/
	private function repairAction() {
		$data = $this->db->setTableName('category')->findAll('catid','listorder DESC,catid ASC');
	    foreach ($data as $t) {
	        $chil_data = $this->db->setTableName('category')->getAll('parentid=?', $t['catid'],'catid','listorder DESC,catid ASC');
			if ($chil_data) { 
	            $childids = '';
	            foreach ($chil_data as $r) {
	                $childids .= $r['catid'].',';
	            }
	            $this->db->setTableName('category')->update(array('child'=>1, 'childids'=>$childids), 'catid=' . $t['catid']);
	        } else {
	            $this->db->setTableName('category')->update(array('child'=>0, 'childids'=>''), 'catid=' . $t['catid']);
			}
	    }
		return true;
	}
	
	/**
	 * 递归获得要全部子栏目id集合
	 */
	private function get_childAction($catid) {
		$data = $this->db->setTableName('category')->find($catid,array('catid','child','childids'));
		if (empty($data)) return false;
	    if ($data['child'] && $data['childids']) {
	        $catids = $catid . ',';
	    	$chilarray = explode(',', $data['childids']);
            foreach ($chilarray as $id) {
	     	    if(empty($id)) continue;
                $catids .= $this->get_childAction($id);
            }
	    }
		else {
	        $catids = $catid . ',';
	    }
		return $catids;
	}
	
}