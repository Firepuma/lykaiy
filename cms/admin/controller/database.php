<?php

class database extends Admin {

	/*
	 * 数据备份
	 */
    public function indexAction() {
	    $action = $this->get('action');
		$size   = $this->get('size');
		if ($this->post('submit')) {
		   $size   = 2048;//每个分卷文件大小
		   $tables = $this->post('table');
		   if (empty($tables)) $this->show_message('您还没有选择要备份的表。');
		   set_cache('bakup_tables', array('tables' => $tables, 'time' => time()));
		   $this->show_message('正在备份数据...', 1,url('database/index', array('action' => 1, 'size' => $size)),100);
		}
		if ($action) {
		    $fileid    = $this->get('fileid');
			$random    = $this->get('random');
			$tableid   = $this->get('tableid');
			$startfrom = $this->get('startfrom');
		    $this->export_database($size, $action, $fileid, $random, $tableid, $startfrom);
		} else {
		$dbname       = $this->db->getdbName();
		$dbprefix       = $this->db->getTablePrefix();
	    $data = $this->db->query('SHOW TABLE STATUS FROM `' . $dbname . '`')->fetchAll();
		foreach ($data as $key=>$t) {
		    $data[$key]['xiaosys'] = substr($t['Name'], 0, strlen($dbprefix)) != $dbprefix ? 0 : 1;
		}
	    include $this->admin_tpl('database_list');
		}
    }
	
	/*
	 * 数据恢复
	 */
    public function importAction() {
		$dir  = DATA_DIR .  'bakup' . DIRECTORY_SEPARATOR;
		$path = $this->get('path');
		if ($path && is_dir($dir . $path)) {
		    $fileid = $this->get('fileid');
		    $this->importdb($path, $fileid);
		    exit;
		}
		if ($this->post('submit')) {
			$paths    = $this->post('paths');
			if (is_array($paths)) {
				foreach ($paths as $path) {
					delete_dir($dir . $path .'/' );
					@rmdir($dir . $path );
				}
			}
		    $this->show_message('操作成功', 1,url('database/import'));
		}
		if (!is_dir($dir)) mkdirs($dir);
        $file_list=glob($dir.'*');
	    $list = array();
        foreach($file_list as $v) {
	    	if (is_dir($v)) 
		    {
					$size   = 0;
					$_dir   = glob($v. DIRECTORY_SEPARATOR .'*.sql');
					foreach ($_dir as $c) {
						$size += filesize($c);
					}
					$path = basename ($v);
					$sqldir = '/data/bakup/' . $path . '/';
					$list[] =array('path' => $path, 'size' => file_size_count($size), 'sqldir' => $sqldir);
			}
        }
		
	    include $this->admin_tpl('database_import');
    }
	
	/*
	 * 修复表
	 */
    public function repairAction() {
		$name = $this->get('name');
		$this->db->execute("repair table $name");
		$this->show_message('修复成功',1, url('database/index'));
    }
	
	/*
	 * 优化表
	 */
    public function optimizeAction() {
		$name = $this->get('name');
		$this->db->execute("optimize table $name");
		$this->show_message('优化成功',1, url('database/index'));
    }
	
	/*
	 * 数据表结构
	 */
    public function tableAction() {
		$name = $this->get('name');
		$data = $this->db->query("SHOW CREATE TABLE $name")->fetchAll();
		echo '<div class="subnav"><pre style="padding: 20px;color:#666;font: 18px/2 tahoma, arial" >' . $data[0]['Create Table'] . '</pre></div>';
    }

	
	/**
	 * 数据库导出方法
	 */
	private function export_database($sizelimit, $action, $fileid, $random, $tableid, $startfrom) {
	    set_time_limit(0);
		$fileid      = ($fileid != '') ? $fileid : 1;
        $c_data      = get_cache('bakup_tables');
		$tables      = $c_data['tables'];
		$time        = $c_data['time'];
		if (empty($tables)) $this->show_message('数据缓存不存在，请重新选择备份');
		if ($fileid  == 1) $random = mt_rand(1000, 9999);
		$tabledump   = '';
		$tableid     = ($tableid!= '') ? $tableid : 0;
		$startfrom   = ($startfrom != '') ? intval($startfrom) : 0;
		for ($i      = $tableid; $i < count($tables) && strlen($tabledump) < $sizelimit * 1000; $i++) {
			$offset  = 100;
			if (!$startfrom) {
				$tabledump  .= "DROP TABLE IF EXISTS `$tables[$i]`;\n"; 
				$createtable = $this->db->query("SHOW CREATE TABLE `$tables[$i]` ")->fetchAll();
				$tabledump  .= $createtable[0]['Create Table'] . ";\n\n";
				$tabledump   = preg_replace("/(DEFAULT)*\s*CHARSET=[a-zA-Z0-9]+/", "DEFAULT CHARSET=utf8", $tabledump);
			}
			$numrows       = $offset;
			while (strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset) {
				$sql       = "SELECT * FROM `$tables[$i]` LIMIT $startfrom, $offset";
				$fields_data = $this->db->query("SHOW COLUMNS FROM `$tables[$i]`")->fetchAll();
				$rows = $this->db->query($sql)->fetchAll();
				$numfields   = count($fields_data);
				$numrows = count($rows);
				$fields_name = array();
				foreach($fields_data as $r) {
					$fields_name[$r['Field']] = $r['Type'];
				}
				$name = array_keys($fields_name);
				if ($rows) {
					foreach ($rows as $row) {
						$comma = "";
						$tabledump .= "INSERT INTO `$tables[$i]` VALUES(";
						for($j = 0; $j < $numfields; $j++) {
							$tabledump .= $comma . "'" . mysql_escape_string($row[$name[$j]]) . "'";
							$comma  = ",";
						}
						$tabledump .= ");\n";
					}
				}
				$startfrom += $offset;
			}
			$tabledump .= "\n";
			$startfrom  = $numrows == $offset ? $startfrom : 0;
		}
		$i   = $startfrom ? $i - 1 : $i;
		$dir  = DATA_DIR .  'bakup' . DIRECTORY_SEPARATOR;
		if (!is_dir($dir)) {
		    mkdir($dir, 0777);
			file_put_contents($dir . 'index.html', '');
		}
		$bakfile_path  = $dir . DIRECTORY_SEPARATOR . $time . DIRECTORY_SEPARATOR;
		if (trim($tabledump)) {
			$tabledump = "# xiaocms bakfile\n# version:xiaocms x1 \n# time:" . date('Y-m-d H:i:s') . "\n# http://www.xiaocms.com\n# ----------------------------------------\n\n\n" . $tabledump;
			$tableid   = $i;
			$filename  = 'xiaocmstables_' . date('Ymd') . '_' . $random . '_' . $fileid . '.sql';
			$altid     = $fileid;
			$fileid++;
			if (!is_dir($bakfile_path)) mkdir($bakfile_path, 0777);
			$bakfile = $bakfile_path . $filename;
			file_put_contents($bakfile, $tabledump);
			@chmod($bakfile, 0777);
			$url = url('database/index', array('size' => $sizelimit, 'action' => $action, 'fileid' => $fileid, 'random' => $random, 'tableid' => $tableid, 'startfrom' => $startfrom));
			$this->show_message("备份$filename", 1, $url,100);
		} else {
			file_put_contents($bakfile_path . 'index.html', '');
		    delete_cache('bakup_tables');
		    $this->show_message("备份完成", 1, url('database/index'));
		}
	}
	
	/**
	 * 数据库恢复
	 */
	private function importdb($path, $fileid = 1) {
		$dir  = DATA_DIR .  'bakup' . DIRECTORY_SEPARATOR;
	    $fid  = $fileid ? $fileid : 1;
		$data = scandir($dir . $path);
	    $list = array();
	    foreach ($data as $t) {
	        if (is_file($dir . $path . DIRECTORY_SEPARATOR . $t) && substr($t, -3) == 'sql') {
			    $id = substr(strrchr($t, '_'), 1, -4);
	            $list[$id] = $t;
	        }
	    }
		if (!isset($list[$fid])) $this->show_message('恢复完毕',1, url('database/index'),20000);
		$file = $list[$fid];
		$sql  = file_get_contents($dir . $path . DIRECTORY_SEPARATOR .$file);
	    $sqls   = $this->sql_split($sql);
		if(is_array($sqls)) {
			foreach($sqls as $sql) {
				if(trim($sql) != '') {
					$this->db->execute($sql);
				}
			}
		} else {
					$this->db->execute($sqls);
		}
		$fid++;
		$this->show_message('恢复数据库文件卷' . $file,1, url('database/import', array('path' => $path, 'fileid' => $fid)),100);
	}
	
 	private function sql_split($sql) {
		$sql = str_replace("\r", "\n", $sql);
		$ret = array();
		$num = 0;
		$queriesarray = explode(";\n", trim($sql));
		unset($sql);
		foreach($queriesarray as $query) {
			$ret[$num] = '';
			$queries = explode("\n", trim($query));
			$queries = array_filter($queries);
			foreach($queries as $query) {
				$str1 = substr($query, 0, 1);
				if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
			}
			$num++;
		}
		return($ret);
	}
	
}