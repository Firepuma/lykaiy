<?php

class index extends Base {

	public function __construct() {
        parent::__construct();
	}

	public function indexAction() {
	if($this->get('catdir') || $this->get('catid')){
	    $catid  = (int)$this->get('catid');
		if(!empty($catid)) {
	    $category    = $this->category_cache[$catid];
		}
		else if ($this->get('catdir')) {
		$category_dir = get_cache('category_dir');
		$catid = $category_dir[$this->get('catdir')];
	    $category = $this->category_cache[$catid];
		}
	    if (empty($category)) {
		    header('HTTP/1.1 404 Not Found');
			$this->show_message('当前栏目不存在');
		}
   	    $category['page']   = (int)$this->get('page') ? (int)$this->get('page') : 1;
		if($category['islook'] && !$this->member_info) $this->show_message('当前栏目游客不允许查看');
		$category['cat'] = $category;
	    $this->view->assign($category);
	    $this->view->assign($this->listSeo($category, $category['page'] ));
	    if ($category['typeid'] == 1) 
        $this->view->display($category['listtpl']);
		else if ($category['typeid'] == 2) 
        $this->view->display($category['pagetpl']);
		else if  ($category['typeid'] == 3) {
	    header('Location: ' . $category['http']);
	    }
	}
	else if ($this->get('id')){
	    $id    = (int)$this->get('id');
	    $content  = $this->db->setTableName('content')->find($id);
	    if (empty($content)) {
		    header('HTTP/1.1 404 Not Found');
		    $this->show_message('不存在此内容！');
		}
	    if (empty($content['status'])) $this->show_message('此内容正在审核中不能查看！');
	    $category   = $this->category_cache[$content['catid']];
		if($category['islook'] && !$this->member_info) $this->show_message('当前栏目游客不允许查看');
	    $content_add = $this->db->setTableName($category['tablename'])->find($id);
		$content_add = $this->handle_fields($this->content_model[$content['modelid']]['fields'], $content_add);
	    $content  = $content_add ? array_merge($content,$content_add) : $content;
  	    $content['page']   = (int)$this->get('page') ? (int)$this->get('page') : 1;
    	if (strpos($content_add['content'], '[XiaoCms-page]') !== false) {
			$pdata  = array_filter ( explode('[XiaoCms-page]', $content_add['content']) );
			$pagenumber = count($pdata);
			$content['content'] = $pdata[$content['page']-1];
			$pageurl = $this->view->get_show_url($content, 1);
			$pagelist = xiaocms::load_class('pager');
			$pagelist = $pagelist->total($pagenumber)->url($pageurl)->num(1)->hide()->page($content['page'])->output();
			$this->view->assign('pagelist', $pagelist);
		}

		$content['cat'] = $category;
		$prev_page = $this->db->setTableName('content')->order('id DESC')->getOne(array('id<?', 'modelid=' .$content['modelid'], 'status!=0'), $id);
		if ($prev_page) $prev_page['url'] =  $this->view->get_show_url($prev_page);
		$next_page = $this->db->setTableName('content')->getOne(array('id>?', 'modelid=' .$content['modelid'] , 'status!=0'), $id);
		if ($next_page) $next_page['url'] =  $this->view->get_show_url($next_page);
	    $this->view->assign($content);
	    $this->view->assign($this->showSeo($content, $content['page']));
	    $this->view->assign(array(
	        'prev_page' => $prev_page,
	        'next_page' => $next_page,
	    ));
	    $this->view->display($category['showtpl']);
	}
	else {
	    $this->view->assign(array(
	        'index'           => 1,
	        'site_title'       => $this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	    ));
		$this->view->display('index.html');
	}
	
	}

	/**
	 * 内容搜索
	 */
	public function searchAction() {
		$kw    = urldecode($this->get('kw'));
		if($kw == '')$this->show_message('请输入要搜索的关键字 如:xiaocms');
	    $catid    = $catid ? $catid : (int)$this->get('catid');
	    $modelid    = $modelid ? $modelid : (int)$this->get('modelid');
  	    $page   = (int)$this->get('page') ? (int)$this->get('page') : 1;
	    $pagesize = 10;
	    $urlparam = array();
	    $urlparam['kw']      = $kw;
	    $url      = url('index/search', $urlparam);
		if ($catid) $this->db->where('catid=?', $catid);
		if ($modelid) $this->db->where('modelid=?', $modelid);
	    $data    = $this->db->setTableName('content')->pageLimit($page, $pagesize)->where("`title` LIKE  ?",'%'.$kw.'%')->getAll(null,null,null,array('listorder DESC', 'time DESC'));
        foreach ($data as $key => $t) {
            $data[$key]['url'] = $this->view->get_show_url($t);
        }
		if ($catid) $this->db->where('catid=?', $catid);
		if ($modelid) $this->db->where('modelid=?', $modelid);
		$total = $this->db->setTableName('content')->where("`title` LIKE  ?",'%'.$kw.'%')->count();
	    $pagelist = xiaocms::load_class('pager');
	    $pagelist = $pagelist->total($total)->url($url. '&page=[page]')->hide(true)->num($pagesize)->page($page)->output();
	    $this->view->assign($this->listSeo($cat, $page, $kw));
	    $this->view->assign(array(
			'kw'         => $kw,
	        'pagelist' => $pagelist,
	        'data' => $data,
			'num' => $total,
			'site_title'  => '搜索 ' . $kw . ' - ' . $this->site_config['site_name'],
			'site_keywords'    => $kw, 
			'site_description' => '搜索 ' . $kw . ' - ' . base64_decode('5qyi6L+O5L2/55SoWElBT0NNUw=='),
	    ));
	    $this->view->display('search.html');
	}
	

	/*
	 * 表单提交页面
	 */
	public function formAction() {
		$modelid = (int)$this->get('modelid');
		$cid  = (int)$this->get('cid');
		$form_model   = get_cache('form_model');
		$form_model = $form_model[$modelid];
		!empty($form_model)  or $this->show_message('表单模型不存在');
		if (!empty($form_model['joinid'])) {
	    	!empty($cid) or $this->show_message('缺少关联内容id');
	    	$this->db->setTableName('content')->getOne(array('id=?', 'modelid=?'), array($cid, $form_model['joinid']),'id')  or $this->show_message('关联id不存在');
		}
	    if ($this->post('submit')) {
    		$gobackurl = $this->post('gobackurl');
    		if (!empty($form_model['setting']['form']['code']) && !$this->checkCode($this->post('code'))) $this->show_message('验证码不正确',2,1);
			if (!empty($form_model['setting']['form']['post']) && !$this->member_info) $this->show_message('只允许会员提交，请注册会员后提交',2,1);
			if (!empty($form_model['setting']['form']['time'])){
			    $time   =  $form_model['setting']['form']['time'] * 60;
				$this->db->setTableName($form_model['tablename'])->where('ip=?', $this->get_user_ip());
				if (!empty($form_model['joinid'])) $this->db->where('cid=?', $cid);
				$ipdata = $this->db->order('time DESC')->getOne('','','time');
		        if (time() - $ipdata['time'] < $time) $this->show_message('同一IP在'. $form_model['setting']['form']['time'] .'分钟内不能重复提交',2,1);
			}
			if (!empty($form_model['setting']['form']['num']) && !empty($form_model['setting']['form']['post']) && $this->member_info ) {
				$this->db->setTableName($form_model['tablename'])->where('userid=?', 1);
				if (!empty($form_model['joinid'])) $this->db->where('cid=?', $cid);
		        if ($this->db->getOne('','','id')) $this->show_message('您已经提交过了，不能重复提交',2,1);
			}
			$data = $this->post('data');
			$data = $this->post_check_fields($form_model['fields'], $data);
			$data['cid']      = $cid;
			$data['ip']       = $this->get_user_ip();
			$data['userid']   = empty($this->member_info) ? 0  : $this->member_info['id'];
			$data['username'] = empty($this->member_info) ? '' : $this->member_info['username'];
			$data['time']= time();
			$data['status']   = empty($form_model['setting']['form']['check']) ? 1 : 0;
			if(empty($gobackurl)) $gobackurl = HTTP_REFERER;
			if ($this->db->setTableName($form_model['tablename'])->insert($data,true)) {
			    $this->show_message($data['status'] ? '提交成功' : '提交成功，等待审核', 1, $gobackurl);
			} else {
			    $this->show_message('提交失败',2,1);
			}
		}
	    $this->view->assign(array(
			'code'             => $form_model['setting']['form']['code'],
			'fields'           => $this->get_data_fields($form_model['fields']),
		    'form_name' => $form_model['modelname'],
	        'site_title'       => $form_model['modelname'] .' - ' . $this->site_config['site_name'],
			'site_keywords'    => $this->site_config['site_keywords'], 
			'site_description' => $this->site_config['site_description'].' - Powered by XiaoCms',
	    ));
		$this->view->display($form_model['showtpl']);
	}

}