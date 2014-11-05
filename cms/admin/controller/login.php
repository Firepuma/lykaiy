<?php

class login extends Admin {
    
    public function __construct() {
		parent::__construct();
	}
	
    public function indexAction() {
		if ($this->post('submit')) {
			if (!$this->checkCode($this->post('code'))) $this->show_message('验证码不正确',2,url('login'));
			if ($this->cookie->get('admin_login')) $this->show_message('密码错误次数过多，请15分钟后重新登录');
		    $username = $this->post('username');
		    $password = $this->post('password');
			$admin  = $this->db->setTableName('admin')->getOne('username=?', $username);
		    if ($admin['username'] == $username &&  $admin['password'] == md5(md5($password))) {
		        $this->session->set('user_id', $admin['userid']);
				if ($this->session->get('admin_login_error_num')) 
				{
				$this->session->delete('admin_login_error_num');
				}
			    $this->show_message('恭喜您！'.$username.' 登录成功', 1, base64_decode('Li8/eGlhb2Ntcw=='));
		    } else {
			    if ($this->session->get('admin_login_error_num')) {
				    $error = (int)$this->session->get('admin_login_error_num') - 1;
					if ($error <= 1) {
						$this->session->delete('admin_login_error_num');
					    $this->cookie->set('admin_login', 1, 60*15);
					} else {
					    $this->session->set('admin_login_error_num', $error);
					}
				} else {
				    $error = 10;
					$this->session->set('admin_login_error_num', 10);
				}
			    $this->show_message('账户或密码不正确，您还可以尝试'.$error.'次', 2, url('login'));
			}
		}
        include $this->admin_tpl('login');
    }
    
    public function logoutAction() {
        if ($this->session->get('user_id')) $this->session->delete('user_id');
        $this->show_message('已经成功退出XiaoCms系统', 1, url('login'));
    }
	
}