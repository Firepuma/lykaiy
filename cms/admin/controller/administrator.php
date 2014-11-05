<?php

class administrator extends Admin {

    public function __construct() {
		parent::__construct();
	}

	public function indexAction() {
	    $list   = $this->db->setTableName('admin')->findAll(array('userid', 'username','password','realname','roleid'));
		
	    include $this->admin_tpl('admin_list');
	}
	
	public function addAction() {
        if ($this->post('submit')) {
            $data = $this->post('data');
			if (!$data['username']) $this->show_message('用户名不能为空',2,1);
			if (strlen($data['password']) < 6) $this->show_message('密码最少6位数',2,1);
			$data['password'] = md5(md5($data['password']));
	        if ($this->db->setTableName('admin')->getOne('username=?', $data['username'])) $this->show_message('已存在相同的用户名',2,1);
			$auth = $this->post('auth');
			$data['auth'] = array2string($auth);
            $this->db->setTableName('admin')->insert($data);
 	    	$this->cacheAction();
            $this->show_message('添加成功', 1, url('administrator/'));
        }
		$cats = get_cache('category');
	    include $this->admin_tpl('admin_add');
	}
	
	public function editAction() {
        $userid   = (int)$this->get('userid');
        $data = $this->db->setTableName('admin')->find($userid);
		$auth = string2array($data['auth']);
		$cats = get_cache('category');

        if (empty($data)) $this->show_message('该用户不存在',2);
        if ($this->post('submit')) {
            $data = $this->post('data');
			if (!empty($data['password'])) {
			if (strlen($data['password']) < 6) $this->show_message('密码最少6位数',2,1);
			$data['password'] = md5(md5($data['password']));
			}
			else {
			unset ($data['password']);
			}
			$auth = $this->post('auth');
			$data['auth'] = array2string($auth);
            $this->db->setTableName('admin')->update($data, 'userid=?', $userid);
    		$this->cacheAction();
            $this->show_message('修改成功', 1);
        }
	    include $this->admin_tpl('admin_add');
	}
	
	public function delAction() {
	    $userid = (int)$this->get('userid');
	    if (empty($userid)) $this->show_message('用户不存在',2);
	    if ($this->session->get('user_id') == $userid) $this->show_message('自己不能删除自己',2);
		$this->db->setTableName('admin')->delete('userid=?' , $userid);
		$this->cacheAction();
	    $this->show_message('删除成功',1, url('administrator/'));
	}
	
    public function cacheAction() {
	    $data = array();
	    foreach ($this->db->setTableName('admin')->findAll() as $t) {
			unset ($t['password']);
	        $data[$t['userid']] = $t;
	    }
	    set_cache('admin', $data);
	}
}