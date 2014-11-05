<?php

class block extends Admin {
    private $type;

    public function __construct() {
		parent::__construct();
		$this->type  = array(1=>'文字', 2=>'图片', 3=>'编辑器');	
	}
    
    public function indexAction() {
	    $list = $this->db->setTableName('block')->findAll('id,type,name');
	    include $this->admin_tpl('block_list');
    }
    
    public function addAction() {
        if ($this->post('submit')) {
            $data = $this->post('data');
            if (empty($data['type'])) $this->show_message('编辑类型不能为空',2,1);
			$data['content'] = $data['content_' . $data['type']];
            if (empty($data['name']) || empty($data['content'])) $this->show_message('名称或者内容不能为空',2,1);
            $this->db->setTableName('block')->insert($data);
	    	$this->cacheAction();
            $this->show_message('添加成功', 1, url('block'));
        }
		$data['type'] = 3;
        include $this->admin_tpl('block_add');
    }
    
    public function editAction() {
        $id   = (int)$this->get('id');
        $data = $this->db->setTableName('block')->find($id);
        if (empty($data)) $this->show_message('区块不存在');
        if ($this->post('submit')) {
            $data = $this->post('data');
            if (!$data['type']) $this->show_message('类型不能为空',2,1);
			$data['content'] = $data['content_' . $data['type']];
            if (empty($data['name']) || empty($data['content'])) $this->show_message('名称或者内容不能为空',2,1);
            $this->db->setTableName('block')->update($data, 'id=?', $id);
	    	$this->cacheAction();
            $this->show_message('编辑成功', 1, url('block'));
        }
	    include $this->admin_tpl('block_add');
    }
    
    public function delAction() {
	    $id  = (int)$this->get('id');
        if (empty($id)) $this->show_message('区块ID不存在');
	    $this->db->setTableName('block')->delete('id=?' , $id);
		$this->cacheAction();
	    $this->show_message('删除成功', 1 , url('block/index'));
	}
    
    public function cacheAction() {
	    $data = array();
	    foreach ($this->db->setTableName('block')->findAll() as $t) {
	        $data[$t['id']] = $t;
	    }
	    set_cache('block', $data);
	}

}