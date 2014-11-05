<?php
class post extends Base {

	public function __construct() {
        parent::__construct();
		$this->view->assign(array(
				'site_title'  => '在线投稿 - ' . $this->site_config['site_name'],
				'site_keywords'    => $this->site_config['site_keywords'], 
				'site_description' => $this->site_config['site_description'],
			));
	}

	public function indexAction() {
		$tree =  xiaocms::load_class('tree');
		$tree->icon = array(' ','  ','  ');
		$tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if($r['ispost']!=1 || $r['typeid']!=1 ) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='./index.php?c=post&a=post&catid=\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$tree->init($categorys);
		$categorys = $tree->get_tree(0, $str);
		$this->view->assign(array(
				'select'     => 1,
				'post_category'   => $categorys,
			));
		$this->view->display('post.html');

	}

	public function postAction() {
			$catid = (int)$this->get('catid');
			if (!isset($this->category_cache[$catid])) $this->show_message('栏目不存在');
			$modelid  = $this->category_cache[$catid]['modelid'];
			$content_model    = get_cache('content_model');
			if (!isset($content_model[$modelid])) $this->show_message('模型不存在');
			if ($this->category_cache[$catid]['ispost']!=1)  $this->show_message('该栏目不能投稿');
			if ($this->category_cache[$catid]['child']) $this->show_message('该栏目不能发布，请在其子栏目中发布');
			if ($this->post('data')) {
				if (!$this->checkCode($this->post('code'))) $this->show_message('验证码不正确',2,1);
				$data = $this->post('data');
	            if (empty($data['title'])) $this->show_message('标题没有填写',2,1);
				$data['catid']     = $catid;
				$data['username']  = $this->get_user_ip();
				$data['time'] =  time();
				$data['status']    = 0;
				$data['modelid']   = $modelid;
				$data = $this->post_check_fields($content_model[$modelid]['fields'], $data);
				$data['id'] = $this->db->setTableName('content')->insert($data,true);
			    $result = $this->db->setTableName($this->category_cache[$catid]['tablename'])->insert($data,true);
				if (!is_numeric($result)) $this->show_message('投稿失败 原因未知 请联系管理员',2,1);
				$this->show_message('投稿成功，需要管理员审核之后才能显示',1);
			}
			$fields = $this->get_data_fields($content_model[$modelid]['fields']);
			$this->view->assign(array(
				'catid'       => $catid,
				'fields' => $fields,
			));
			$this->view->display('post.html');

	}

}