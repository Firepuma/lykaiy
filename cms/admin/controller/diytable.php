<?php

class diytable extends Admin {

	protected $modelid;
	protected $model;
	protected $table;
    public function __construct() {
		parent::__construct();
		$diy_model     = get_cache('diy_model');
		$this->modelid = (int)$this->get('modelid');
		if (empty($this->modelid)) $this->show_message('自定义模型id不存在');
		$this->model   = $diy_model[$this->modelid];
		if (empty($this->model)) $this->show_message('自定义模型不存在');
		$this->table   = $this->model['tablename'];
	}
	
	/**
	 * 自定表内容列表管理
	 */
	public function indexAction() {
		$modelid   =  $this->modelid;
	    if ($this->post('formidarr') && $this->post('status')=='del') {
     		foreach ($this->post('formidarr') as $id) {
	            $this->db->setTableName($this->table)->delete('id=?' , $id);
			}
			$this->show_message('删除成功', 1);
	    }
		$page     = (int)$this->get('page') ? (int)$this->get('page') : 1;
	    $pagelist = xiaocms::load_class('pager');
	    $total    = $this->db->setTableName($this->table)->count();
	    $pagesize = empty($this->admin['list_size']) ? 10 : $this->admin['list_size'];
	    $list     = $this->db->setTableName($this->table)->pageLimit($page, $pagesize)->getAll(null,null,null,'id DESC');
	    $pagelist = $pagelist->total($total)->url(url('diytable/index', array('modelid'=> $this->modelid)) . '&page=[page]')->num($pagesize)->page($page)->output();
	    include $this->admin_tpl('diytable_list');
	}
	
	/**
	 * 添加内容
	 */
	public function addAction() {
		if ($this->post('submit')) {
		    $data = $this->post('data');
			$data = $this->post_check_fields($this->model['fields'], $data);
			$insertid = $this->db->setTableName($this->table)->insert($data,true);
			if ($insertid) {
			    $this->show_message('添加成功', 1, url('diytable/index', array('modelid'=>$this->modelid)));
			} else {
			    $this->show_message('添加失败');
			}
		}
		$fields = $this->get_data_fields($this->model['fields']);
	    include $this->admin_tpl('diytable_add');
	}
	
	/**
	 * 修改内容
	 */
	public function editAction() {
		$id = (int)$this->get('id');
		if (empty($id)) $this->show_message('内容id不存在');
		if ($this->post('submit')) {
		    $data = $this->post('data');
			$data = $this->post_check_fields($this->model['fields'], $data);
			if ($this->db->setTableName($this->table)->update($data, 'id=' . $id)) {
			    $this->show_message('修改成功', 1, url('diytable/index', array('modelid'=>$this->modelid)));
			} else {
			    $this->show_message('操作失败');
			}
		}
		$data     = $this->db->setTableName($this->table)->find($id);
		if (empty($data)) $this->show_message('内容不存在');
		$fields = $this->get_data_fields($this->model['fields'], $data);
	    include $this->admin_tpl('diytable_add');
	}
	
	/**
	 * 删除
	 */
	public function delAction() {
	    $id    = (int)$this->get('id');
		$this->db->setTableName($this->table)->delete('id=?' , $id);
		$this->show_message('删除成功', 1);
	}
	
}