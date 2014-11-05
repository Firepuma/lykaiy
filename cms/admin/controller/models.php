<?php

class models extends Admin {
    
	private $model_prefix; 
	private $typename;
	private $typeid;
	private $field_type;

    public function __construct() {
		parent::__construct();
		$this->model_prefix = array(1 => 'content',2 => 'member',3 => 'form',4 => 'diy');
		$this->typename  = array(1 => '内容模型',2 => '会员模型',3 => '表单模型',4=> '自定义表');
	    $this->typeid = (int)$this->get('typeid') ? (int)$this->get('typeid') : 1;
		if (!isset($this->model_prefix[$this->typeid])) $this->show_message('模型类型不存在');
		$this->field_type = array(
				'input'    =>  '单行文本',
				'textarea' => '多行文本',
				'editor'   => '编辑器',
				'radio'    => '单选按钮',
				'checkbox' => '复选框',
				'select'   => '下拉选择框',
				'file'     => '单文件/图片上传',
				'files'    => '多文件/图片上传',
				'date'     => '日期时间',
				'related'     => '相关内容字段',
				'diy'     => '高级自定义字段',
				);
	}

	public function indexAction() {
		$list  = $this->db->setTableName('model')->getAll('typeid=?', $this->typeid);
		include $this->admin_tpl('models_list');
	}
	
	/*
	 * 添加模型
	 */
	public function addAction() {
	    if ($this->post('submit')) {
	        $data = $this->post('data');
	        if (empty($data['tablename']) || empty($data['modelname']) ) $this->show_message('数据表名不能为空！',2,1);
	        if (!preg_match('/^[0-9a-z]+$/', $data['tablename'])) $this->show_message('数据表名只能由小写字母和数字组成！',2,1);
	        $data['listtpl']      = $this->post('listtpl')     ? $this->post('listtpl') : 'list_' . $data['tablename'] . '.html';
	        $data['showtpl']  = $this->post('showtpl') ? $this->post('showtpl') : ($this->typeid == 3 ? 'form.html' : 'show_' . $data['tablename'] . '.html') ;
			$data['typeid']   = $this->typeid;
			if($data['typeid'] == 3 || $data['typeid'] == 4 ) {
			$data['setting'] = array2string($data['setting']);
			}
			
			$dbprefix       = $this->db->getTablePrefix();
			$db_table_name       = $this->db->getTableList();
			$data['tablename'] = $this->model_prefix[$this->typeid]. '_' . $data['tablename'];
			$add_table_name = $dbprefix.$data['tablename'];
			if (in_array($add_table_name, $db_table_name)) $this->show_message('数据表名已经存在 换一个吧',2,1);
            $modelid = $this->db->setTableName('model')->insert($data,true);
			if(!is_numeric($modelid)) $this->show_message('添加失败',2);
			
		    if ($this->typeid == 1) {
				$join = $this->post('join');
				if (is_array($join) && $join) {
				    foreach ($join as $t) {
					    $updata = array('joinid'=>$modelid);
					    $this->db->setTableName('model')->update($updata, 'modelid=?' , $t);
					}
				}
			}
			
			if ($data['typeid'] == 1) {
			$sql = "CREATE TABLE IF NOT EXISTS `" . $add_table_name . "` (`id` MEDIUMINT( 8 ) NOT NULL ,`catid` SMALLINT( 5 ) NOT NULL ,`content` MEDIUMTEXT NOT NULL ,PRIMARY KEY (`id`), KEY `catid` (`catid`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			$this->db->execute($sql);
		    $this->db->execute("INSERT INTO `#xiaocms_model_field` (fieldid,modelid,field,name,formtype,isshow) VALUES (NULL, $modelid,'content','内容 ','editor',1)");
			} elseif ($data['typeid'] == 2) {
			$sql = "CREATE TABLE IF NOT EXISTS `" . $add_table_name . "` (`id` MEDIUMINT( 8 ) NOT NULL ,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			$this->db->execute($sql);
			} elseif ($data['typeid'] == 3) {
			$sql = "CREATE TABLE IF NOT EXISTS `" . $add_table_name . "` (`id` mediumint(8) NOT NULL AUTO_INCREMENT,`cid` mediumint(8) NOT NULL,`userid` mediumint(8) NOT NULL,`username` char(20) NOT NULL,`status` tinyint(2) unsigned NOT NULL DEFAULT '1',`time` int(10) unsigned NOT NULL DEFAULT '0', `ip` char(20) NULL,PRIMARY KEY (`id`),KEY `status` (`status`),KEY `time` (`time`),KEY `userid` (`userid`),KEY `cid` (`cid`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			$this->db->execute($sql);
		    } elseif ($data['typeid'] == 4) {
			$sql = "CREATE TABLE IF NOT EXISTS `" . $add_table_name . "` (`id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			$this->db->execute($sql);
		    }

	    	$this->cacheAction();
			$this->show_message('添加成功', 1, url('models/index/', array('typeid'=>$this->typeid)));
	    }
        if($this->typeid == 1) {
	    	$formmodel    = $this->db->setTableName('model')->getAll('typeid=3');
	    	$join = $joindata = array();
	     	if ($formmodel) {
	    	    foreach ($formmodel as $t) {
			        if (!empty($t['joinid'])) $joindata[] = $t['modelid'];
			    }
		    }
		}
	    include $this->admin_tpl('models_add');
	}
	
	/*
	 * 修改模型
	 */
    public function editAction() {
	    $modelid = (int)$this->get('modelid');
		$data    = $this->db->setTableName('model')->find($modelid);
		if (empty($data)) $this->show_message('该模型不存在！');
	    if ($this->post('submit')) {
            $data = $this->post('data');
			unset($data['tablename']);
 			if($this->typeid == 3 || $this->typeid == 4) {
			$data['setting'] = array2string($data['setting']);
			}
			
           $this->db->setTableName('model')->update($data, 'modelid=?' , $modelid);
			if ($this->typeid == 1) {
				$join = $this->post('join');
				$this->db->setTableName('model')->update(array('joinid'=>0), 'joinid=?' , $modelid);
				if (is_array($join) && $join) {
					foreach ($join as $t) {
					    $updata = array('joinid'=>$modelid);
					    $this->db->setTableName('model')->update($updata, 'modelid=?' , $t);
					}
				}
			}
	    	$this->cacheAction();
	        $this->show_message('修改成功', 1);
	    }

        if($this->typeid == 1) {
	    	$formmodel    = $this->db->setTableName('model')->getAll('typeid=3');
	    	$join = $joindata = array();
	     	if ($formmodel) {
	    	    foreach ($formmodel as $t) {
			        if (!empty($t['joinid'])) $joindata[] = $t['modelid'];
	    			if ($t['joinid'] == $modelid) $join[]  = $t['modelid'];
			    }
		    }
		}
		

		if($this->typeid == 3) {
		$data['setting'] = string2array($data['setting']);
		$form_field_list = $this->db->setTableName('model_field')->where('modelid=?' , $modelid)->where('disabled=0')->order('listorder DESC')->getAll();
		$join    = isset($this->content_model[$data['joinid']]) ? $this->content_model[$data['joinid']] : null;
		$join_info     = '独立表单';
		if ($join)  $join_info  = '已关联' . $join['modelname'];
		
		$form_url  = SITE_PATH . 'index.php?c=index&a=form&modelid=' . $modelid  ;
        $list_code = '
{xiao:list table=' . $data['tablename'] . '   num=10}
表单字段信息 例如：id：{xiao:$xiao[\'id\']} 更多信息请参考XiaoCms官方模板帮助文档
{/xiao:list}';
        if ($join) {
		    $list_code = '
{xiao:list table=' . $data['tablename'] . ' cid=被关联的文章id(例如：$id) num=10}
表单字段信息 例如：id：{$xiao[\'id\']} 更多信息请参考XiaoCms官方模板帮助文档
{/xiao:list}';
		$form_url  = SITE_PATH . 'index.php?c=form&a=post&modelid=' . $modelid . 'cid=$id ($id是被关联内容的id变量)';
        }
		
	    }

		if($this->typeid == 4) {
		$data['setting'] = string2array($data['setting']);
		$form_field_list = $this->db->setTableName('model_field')->where('modelid=?' , $modelid)->where('disabled=0')->order('listorder DESC')->getAll();
		
		$form_url  = SITE_PATH . 'index.php?c=index&a=form&modelid=' . $modelid  ;
        $list_code = '
{xiao:list table=' . $data['tablename'] . '   num=10}
在这里可以调用你的diy字段信息 例如：id：{xiao:$xiao[\'id\']} 更多信息请参考XiaoCms官方模板帮助文档
{/xiao:list}';
	    }

	    include $this->admin_tpl('models_add');
	}
	
	/*
	 * 删除模型 搞定
	 */
	public function delAction() {
	    $modelid  = (int)$this->get('modelid');
		$data    = $this->db->setTableName('model')->find($modelid);
        if (empty($data)) $this->show_message('模型ID不存在');
		$dbprefix     = $this->db->getTablePrefix();
		$tablename = $dbprefix . $data['tablename'];
	    $this->db->setTableName('model')->delete('modelid=?' , $modelid);
		$this->db->execute('DROP TABLE ' . $tablename);
		$this->db->execute('DELETE FROM `#xiaocms_model_field` where modelid=' . $modelid);
		$this->cacheAction();
	    $this->show_message('删除成功', 1);
	}
	
	/**
	 * 字段管理
	 */
	public function fieldAction() {
	    $modelid = (int)$this->get('modelid');
	    $data    = $this->db->setTableName('model')->find($modelid);
	    if (!$data) $this->show_message('该模型不存在！');
	    if ($this->post('listorder')) {
     		foreach ($this->post('listorder') as $fieldid => $value) {
	            $this->db->setTableName('model_field')->update(array('listorder'=>$value), 'fieldid=?' , $fieldid);
			}
	        $this->cacheAction();
			$this->show_message('设置成功', 1);
	    }
		if ($this->typeid==1){
		$setting = string2array($data['setting']);
		$default_field = $setting['default'];
		}
		$list    = $this->db->setTableName('model_field')->where('modelid=?' , $modelid)->order('listorder DESC')->getAll();
	    include $this->admin_tpl('models_field_list');
	}
	
	/**
	 * 添加字段
	 */
	public function addfieldAction() {
	    $modelid    = (int)$this->get('modelid');
	    $model_data = $this->db->setTableName('model')->find($modelid);
	    if (!$model_data) $this->show_message('该模型不存在！');
	    if ($this->post('submit')) {
	        $data = $this->post('data');
			$data['setting'] = array2string($data['setting']);
			$field = $data['field'];
	    	$fields = $this->db->setTableName($model_data['tablename'])->getTableFields();
		    if ($this->typeid==1 || $this->typeid==2){
			$core_fields = $this->db->setTableName($this->model_prefix[$this->typeid])->getTableFields();
	        $fields     = array_unique(array_merge($fields, $core_fields));
			}
	        if (empty($field) || !preg_match('/^[a-zA-Z]{1}[a-zA-Z0-9]{0,19}$/', $field) || in_array($field, $fields)) 
			$this->show_message('字段名称格式不正确或已存在',2,1);
	        if (empty($data['name']))  $this->show_message('请填写字段别名！',2,1);
	        if (empty($data['formtype'])) $this->show_message('请选择字段类别！',2,1);
            $fieldid = $this->db->setTableName('model_field')->insert($data,true);
			if(!is_numeric($fieldid)) $this->show_message('添加失败',2);
			
			switch($data['formtype']) {
				case 'file':
				case 'date':
				case 'input':
				case 'radio':
				case 'select':
				case 'checkbox':
				case 'related':
					$this->db->execute("ALTER TABLE `#xiaocms_$model_data[tablename]` ADD `$field` VARCHAR( 255 ) NOT NULL");
				break;
				case 'diy':
				case 'files':
				case 'editor':
				case 'textarea':
					$this->db->execute("ALTER TABLE `#xiaocms_$model_data[tablename]` ADD `$field` MEDIUMTEXT NOT NULL");
				break;
			}

            $this->cacheAction();
            $this->show_message('添加成功', 1, url('models/field/', array('modelid'=>$modelid, 'typeid'=>$this->typeid)));
			
	    }
		$formtype = $this->field_type;
	    include $this->admin_tpl('models_field_add');
	}
	
	/**
	 * 修改字段
	 */
	public function editfieldAction() {
	    $fieldid = (int)$this->get('fieldid');
	    $data    = $this->db->setTableName('model_field')->getOne('fieldid=?', $fieldid);
	    if (empty($data)) $this->show_message('字段不存在！');
	    $modelid    = $data['modelid'];
	    $model_data = $this->db->setTableName('model')->find($modelid);
	    if (!$model_data) $this->show_message('该模型不存在！');
	    if ($this->post('submit')) {
	        $data = $this->post('data');
			unset($data['field']);
	        if (empty($data['name']))  $this->show_message('请填写字段别名！',2,1);
			$data['setting'] = array2string($data['setting']);
            $this->db->setTableName('model_field')->update($data, 'fieldid=?' , $fieldid);
            $this->cacheAction();
            $this->show_message('修改成功', 1, url('models/field/', array('modelid'=>$modelid, 'typeid'=>$this->typeid)));
	    }
		$formtype1 = array('input' , 'radio' , 'checkbox' , 'select' , 'file', 'date' , 'related');
		$formtype2 = array('files' , 'editor' , 'textarea' , 'diy');
		if (in_array($data['formtype'], $formtype1)){
            $formtype = array(
				'input'    =>  '单行文本',
				'radio'    => '单选按钮',
				'checkbox' => '复选框',
				'select'   => '下拉选择框',
				'date'     => '日期时间',
				'file'     => '单文件/图片上传',
				'related'     => '相关内容字段',
			 );
	 	}elseif (in_array($data['formtype'], $formtype2)) {
            $formtype = array(
				'textarea' => '多行文本',
				'editor'   => '编辑器',
				'files'    => '多文件/图片上传',
				'diy'     => '高级自定义字段',
			 );
		}
		$data['setting'] = string2array($data['setting']);
	    include $this->admin_tpl('models_field_add');
	}

	/**
	 * 字段属性设置
	 */
	public function field_type_settingAction() {
	    $fieldtype = $this->get('type');
	    if (empty($fieldtype)) exit('');
	    $fieldsetting = $fieldtype . '_setting';
	    if (!method_exists($this->field,$fieldsetting)) exit('');
		echo json_encode($this->field->$fieldsetting());
	}

	/**
	 * 禁用/启用
	 */
	public function disableAction() {
	    //模型禁用
	    if($this->get('mode')){	
	    $modelid = (int)$this->get('modelid');
	    $data    = $this->db->setTableName('model')->find($modelid);
	    if (!$data) $this->show_message('该模型不存在！');
		$setting = string2array($data['setting']);
	    $setting['disable'] = $setting['disable'] == 1 ? 0 : 1;
	    $this->db->setTableName('model')->update(array('setting'=>array2string($setting)), 'modelid=?' , $modelid);
	    $this->cacheAction();
	    $this->show_message('修改成功', 1);
	    }
		//模型默认字段禁用启用
	    if($this->get('default')){	
	    $modelid = (int)$this->get('modelid');
		$name    = $this->get('name');
	    $data    = $this->db->setTableName('model')->find($modelid);
	    if (empty($data)) $this->show_message('该模型不存在！');
		$setting = string2array($data['setting']);
		if (!isset($setting['default'][$name])) $this->show_message('该字段不存在！');
		$setting['default'][$name]['show'] = $setting['default'][$name]['show'] == 1 ? 0 : 1;
		$this->db->setTableName('model')->update(array('setting'=>array2string($setting)), 'modelid=?' , $modelid);
	    $this->cacheAction();
	    $this->show_message('修改成功', 1);
	    }
		
		//自定义模型字段禁用启用
	    if($this->get('fieldid')){	
	    $fieldid = (int)$this->get('fieldid');
	    $data    = $this->db->setTableName('model_field')->getOne('fieldid=?' , $fieldid);
	    if (empty($data)) $this->show_message('该字段不存在！');
	    $disable = $data['disabled'] == 1 ? 0 : 1;
	    $this->db->setTableName('model_field')->update(array('disabled'=>$disable), 'fieldid=?' , $fieldid);
	    $this->cacheAction();
	    $this->show_message('修改成功', 1);
		}
	}
	
	/**
	 * 删除字段
	 */
	public function delfieldAction() {
	    $fieldid = (int)$this->get('fieldid');
        if (empty($fieldid)) $this->show_message('字段ID不存在',2);
	    $data    = $this->db->setTableName('model_field')->getOne('fieldid=?' , $fieldid);
	    if (empty($data)) $this->show_message('该字段不存在！');
	    $modeldata = $this->db->setTableName('model')->getOne('modelid=?' , $data['modelid']);
		
		if ($this->typeid ==1){
		if ($data['field'] == 'content') $this->show_message('为防止误操作 该字段不能删除, 但可选择禁用');
		}
	    $this->db->setTableName('model_field')->delete('fieldid=?' , $fieldid);
		$this->db->execute("ALTER TABLE `#xiaocms_$modeldata[tablename]` DROP `$data[field]`");
		$this->cacheAction();
        $this->show_message('删除成功', 1);
	}
	
	
	/**
	 * 更新缓存
	 */
	public function cacheAction() {
		delete_dir(DATA_DIR . 'models' . DIRECTORY_SEPARATOR);
		foreach ($this->model_prefix as $typeid=>$modeltype) {
	        $model = $this->db->setTableName('model')->getAll('typeid=?',  $typeid);
	        $data  = array();
			foreach ($model as $t) {
			    $setting   = string2array($t['setting']);
				if ($setting['disable'] == 1) continue;
				$modelid        = $t['modelid'];
				$data[$modelid] = $t;
				$fields    = $this->db->setTableName('model_field')->getAll(array('modelid=' . $modelid, 'disabled=0'),null,null,'listorder DESC');
				$_fields  = array();
				foreach ($fields as $k=>$f) {
				    $_fields[$f['field']] = $f;
				}
				if ($typeid == 1 && !isset($setting['default'])) {
				    $setting['default'] = array(
					    'title'         => array('name'=>'标题', 'show'=>1),
					    'keywords'      => array('name'=>'关键字', 'show'=>1),
					    'thumb'         => array('name'=>'缩略图', 'show'=>1),
					    'description'   => array('name'=>'描述',   'show'=>1),
					    'time'   => array('name'=>'发布时间',   'show'=>1),
					    'hits'   => array('name'=>'阅读数',   'show'=>1),
					);
					$this->db->setTableName('model')->update(array('setting'=>array2string($setting)), 'modelid=?' , $modelid);
				}
				$data[$modelid]['fields']        = $_fields;
				$data[$modelid]['setting']      = $setting;
			}
			set_cache($modeltype . '_model', $data);
		}

	}

}