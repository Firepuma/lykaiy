<?php
if (!defined('IN_XIAOCMS')) exit();

class view
{

    public $cats;
    public $view_dir;
    public $site_config;
    public $compile_dir;
    public $_options = array();

    public function __construct()
    {
        $this->cats = get_cache('category');
        $this->site_config = xiaocms::load_config('config');
        $this->view_dir = TEMPLATE_DIR . SYS_THEME_DIR;
        $this->compile_dir = DATA_DIR . 'tplcache' . DIRECTORY_SEPARATOR . SYS_THEME_DIR;
    }

    public function assign($key, $value = null)
    {
        if (!$key) return false;
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->_options[$k] = $v;
            }
        } else {
            $this->_options[$key] = $value;
        }
        return true;
    }

    public function display($file_name = null)
    {
        if (!empty($this->_options)) {
            extract($this->_options, EXTR_PREFIX_SAME, 'data');
            $this->_options = array();
        }
        $view_file = $this->get_view_file($file_name);
        $compile_file = $this->get_compile_file($file_name);
        if ($this->is_compile($view_file, $compile_file)) {
            $view_content = $this->load_view_file($view_file);
            $this->create_compile_file($compile_file, $view_content);
        }
        include $compile_file;
    }

    protected function _include($file_name)
    {
        if (!$file_name) return false;
        $view_file = $this->get_view_file($file_name);
        $compile_file = $this->get_compile_file($file_name);
        if ($this->is_compile($view_file, $compile_file)) {
            $view_content = $this->load_view_file($view_file);
            $this->create_compile_file($compile_file, $view_content);
        }
        return $compile_file;
    }

    protected function get_view_file($file_name)
    {
        return $this->view_dir . $file_name;
    }

    protected function get_compile_file($file_name)
    {
        return $this->compile_dir . $file_name . '.cache.php';
    }

    protected function create_compile_file($compile_file, $content)
    {
        $compile_dir = dirname($compile_file);
        if (!is_dir($compile_dir)) mkdirs($compile_dir);
        file_put_contents($compile_file, $content, LOCK_EX) or exit($compile_dir . '目录没有写入权限');
    }

    protected function is_compile($view_file, $compile_file)
    {
        return (is_file($compile_file) && is_file($view_file) && (filemtime($compile_file) >= filemtime($view_file))) ? false : true;
    }

    protected function load_view_file($view_file)
    {
        if (!is_file($view_file)) exit('模板: ' . $view_file . '不存在');
        $view_content = file_get_contents($view_file);
        return $this->handle_view_file($view_content);
    }

    protected function handle_view_file($view_content)
    {
        if (!$view_content) return false;
        $regex_array = array(
            '#{xiao:template\s+(.+?)\s*}#is',
            '#{xiao:block\s+([0-9]+)}#i',
            '#{xiao:nav\s+(.+?)\s?}#i',
            '#{\/xiao:nav}#i',
            '#{xiao:list\s+(.+?)return=(.+?)\s?}#i',
            '#{xiao:list\s+(.+?)\s?}#i',
            '#{\/xiao:list}#i',
            '#{xiao:loop\s+\$(.+?)\s+\$(\w+?)\s?}#i',
            '#{xiao:loop\s+\$(.+?)\s+\$(\w+?)\s?=>\s?\$(\w+?)\s?}#i',
            '#{\/xiao:loop}#i',
            '#{xiao:if\s+(.+?)\s?}#i',
            '#{xiao:else\sif\s+(.+?)\s?}#i',
            '#{xiao:else}#i',
            '#{\/xiao:if}#i',
            '#{xiao:function.([a-z_0-9]+)\((.*)\)}#Ui',
            '#{xiao:\$(.+?)}#i',
            '#{xiao:php\s+(.+?)}#is',
            '#\?\>\s*\<\?php\s#s',
        );
        $replace_array = array(
            "<?php include \$this->_include('\\1'); ?>",
            "<?php \$this->block(\\1);?>",
            "<?php \$return = \$this->_category(\"\\1\");  if (is_array(\$return))  foreach (\$return as \$key=>\$xiao) { \$allchildids = @explode(',', \$xiao['allchildids']);    \$current = in_array(\$catid, \$allchildids);?>",
            "<?php } ?>",
            "<?php \$return_\\2 = \$this->_listdata(\"\\1 return=\\2\"); extract(\$return_\\2); if (is_array(\$return_\\2))  foreach (\$return_\\2 as \$key_\\2=>\$\\2) { ?>",
            "<?php \$return = \$this->_listdata(\"\\1\"); extract(\$return); if (is_array(\$return))  foreach (\$return as \$key=>\$xiao) { ?>",
            "<?php } ?>",
            "<?php if (is_array(\$\\1))  foreach (\$\\1 as \$\\2) { ?>",
            "<?php if (is_array(\$\\1))  foreach (\$\\1 as \$\\2=>\$\\3) { ?>",
            "<?php  } ?>",
            "<?php if (\\1) { ?>",
            "<?php } else if (\\1) { ?>",
            "<?php } else { ?>",
            "<?php } ?>",
            "<?php echo \\1(\\2); ?>",
            "<?php echo \$\\1; ?>",
            "<?php \\1 ?>",
            " ",
        );
        return preg_replace($regex_array, $replace_array, $view_content);
    }

    protected function _category($param)
    {
        $_param = explode(' ', $param);
        $param = array();
        foreach ($_param as $p) {
            $mark = strpos($p, '=');
            if ($p && $mark !== false) {
                $var = substr($p, 0, $mark);
                $val = substr($p, $mark + 1);
                if (isset($var) && $var) $param[$var] = $val;
            }
        }
        $system = array();
        if (is_array($param)) {
            foreach ($param as $key => $val) {
                if (in_array($key, array('catid', 'typeid', 'modelid', 'parentid', 'num', 'ismenu'))) {
                    $system[$key] = $val;
                }
            }
        }
        $parentid = $system['parentid'] ? $system['parentid'] : 0;
        $i = 1;
        foreach ($this->cats as $catid => $cat) {
            if ($system['num']) if ($i > $system['num']) break;
            if (!$system['ismenu']) if (!$cat['ismenu']) continue;
            if ($system['typeid']) if ($cat['typeid'] != $system['typeid']) continue;
            if ($system['modelid']) if ($cat['modelid'] != $system['modelid']) continue;
            if ($system['catid']) {
                $catids = explode(',', $system['catid']);
                if (!in_array($cat['catid'], $catids)) continue;
            } else {
                if ($cat['parentid'] != $parentid) continue;
			}
            $data[$catid] = $cat;
            $i++;
        }
        return $data;
    }

    protected function _listdata($param)
    {
        $_param = explode(' ', $param);
        $paramarr = $system = $fields = $_fields = array();
        foreach ($_param as $p) {
            $mark = strpos($p, '=');
            if ($p && $mark !== false) {
                $var = substr($p, 0, $mark);
                $val = substr($p, $mark + 1);
                if (isset($var) && $var) $paramarr[$var] = $val;
            }
        }
        if (is_array($paramarr)) {
            foreach ($paramarr as $key => $val) {
                if (in_array($key, array('sql', 'table', 'xiaocms', 'cache', 'page', 'urlrule', 'num', 'order', 'pagesize', 'return'))) {
                    $system[$key] = $val;
                } else {
                    $fields[$key] = $val;
                    $_fields[] = $key;
                }
            }
        }
        $db = xiaocms::load_class('Model');
        if ($system['sql']) {
            $sql = substr($param, 4);
            $data = $db->query($sql)->fetchAll();
            return array('return' => $data);
        }
        $table1 = isset($system['table']) && $system['table'] ? $system['table'] : 'content';
        $from = 'FROM ' . '#xiaocms_' . $table1;
        $table1_all_fields = $db->setTableName($table1)->getTableFields();
        $table1_fields = array_intersect($_fields, $table1_all_fields);
        if (!empty($system['xiaocms'])) {
            if ($table1 == 'content') {
                if (!empty($fields['catid']) && $this->cats[$fields['catid']]) {
                    $table2 = $this->cats[$fields['catid']]['tablename'];
                } elseif (!empty($fields['modelid'])) {
                    $content_model = get_cache('content_model');
                    $table2 = $content_model[$fields['modelid']]['tablename'];
                }
            } elseif ($table1 == 'member' && isset($fields['modelid']) && $fields['modelid']) {
                $member_model = get_cache('member_model');
                $table2 = $member_model[$fields['modelid']]['tablename'];
            }
            if ($table2) {
                $table2_all_fields = $db->setTableName($table2)->getTableFields();
                $table2_fields = array_intersect($_fields, $table2_all_fields);
                $table2_fields = array_diff($table2_fields, $table1_fields);
                $table2 = '#xiaocms_' . $table2;
                $from .= ' LEFT JOIN ' . $table2 . ' ON `#xiaocms_' . $table1 . '`.`id`=`' . $table2 . '`.`id`';
            }
        }
        $table1 = '#xiaocms_' . $table1;
        $where = '';
        $fieldsAll = array($table1 => $table1_fields, $table2 => $table2_fields);
        foreach ($fieldsAll as $_tablename => $tablename) {
            if (is_array($tablename)) {
                foreach ($tablename as $field) {
                    if ($fields[$field] == '') continue;
                    if ($field == 'catid' && !empty($fields['catid'])) {
                        if (!empty($this->cats[$fields['catid']]['child'])) {
                            $where .= ' AND `' . $_tablename . '`.`catid` IN (' . $this->cats[$fields['catid']]['allchildids'] . ')';
                        } elseif (strpos($fields['catid'], ',') !== false) {
                            $where .= ' AND `' . $_tablename . '`.`catid` IN (' . $fields['catid'] . ')';
                        } else {
                            $where .= ' AND `' . $_tablename . '`.`catid`=' . $fields['catid'];
                        }
                    } elseif ($field == 'id' && !empty($fields['id'])) {
                        $where .= ' AND `' . $_tablename . '`.`id` IN (' . $fields['id'] . ')';
                    } elseif ($field == 'thumb' && !empty($fields['thumb'])) {
                        $where .= $fields['thumb'] ? ' AND `' . $_tablename . '`.`thumb`<>""' : '';
                    } else {
					
                        if (substr($fields[$field], 0, 1) == '(' && substr($fields[$field], -1, 1) == ')') {
                            $value       = substr($fields[$field],1,strlen($fields[$field])-2);
			    			list($v1, $v2) = explode('-', $value);
		            		$v1		= is_numeric($v1) ? $v1 : '"' . addslashes($v1) . '"';
							$v2		= is_numeric($v2) ? $v2 : '"' . addslashes($v2) . '"';
                            $where .= ' AND `' . $_tablename . '`.`' . $field . '` BETWEEN ' . $v1 . ' AND ' . $v2;
                        } /* 
						    改为() 做为范围，此段代码保留，当()条件有冲突的时候可自行启用而注释上面的代码
      					    elseif (substr($fields[$field], 0, 8) == 'BETWEEN_') {
                            $value       = substr($fields[$field], 8);
							list($v1, $v2) = explode('-', $value);
							$v1		= is_numeric($v1) ? $v1 : '"' . addslashes($v1) . '"';
							$v2		= is_numeric($v2) ? $v2 : '"' . addslashes($v2) . '"';
                            $where .= ' AND `' . $_tablename . '`.`' . $field . '` BETWEEN ' . $v1 . ' AND ' . $v2;
                        }*/elseif (substr($fields[$field], 0, 1) == '%' || substr($fields[$field], -1, 1) == '%') {
                            $where .= ' AND `' . $_tablename . '`.`' . $field . '` LIKE \'' . $fields[$field] . '\'';
                        } /*
						    此段代码保留，当%条件前后有冲突的时候可自行启用而注释上面的代码
     						elseif (substr($fields[$field], 0, 5) == 'LIKE_') {
                            $value       = substr($fields[$field], 5);
                            $where .= ' AND `' . $_tablename . '`.`' . $field . '` LIKE \'' . $value. '\'';
                        }*/elseif (strpos($fields[$field], ',') !== false) {
                            $where .= ' AND `' . $_tablename . '`.`' . $field . '` IN (' . $fields[$field] . ')';
                        } else {
                            $value = is_numeric($fields[$field]) ? $fields[$field] : '"' . $fields[$field] . '"';
                            $where .= ' AND `' . $_tablename . '`.`' . $field . '`=' . $value . '';
                        }
						
                    }
                }
            }
        }

        if ($table1 == '#xiaocms_content' && !isset($fields['status'])) {
            $where .= ' AND `#xiaocms_content`.`status`!=0';
        }
        if ($where) {
            if (substr($where, 0, 4) == ' AND') {
                $where = ' WHERE' . substr($where, 4);
            } else {
                $where = ' WHERE' . $where;
            }
        }
        $order = '';
        if ($system['order']) {
            if ($system['order'] == 'rand()') {
                $order .= ' ORDER BY RAND()';
            } else {
                $orderarr = explode(',', $system['order']);
                foreach ($orderarr as $t) {
                    list($_field, $_order) = explode('_', $t);
                    $_orderby = isset($_order) && strtoupper($_order) == 'ASC' ? 'ASC' : 'DESC';
                    if (in_array($_field, $table1_all_fields)) {
                        $order .= ' `' . $table1 . '`.`' . $_field . '` ' . $_orderby . ',';
                    } elseif (isset($table2_all_fields) && in_array($_field, $table2_all_fields)) {
                        $order .= ' `' . $table2 . '`.`' . $_field . '` ' . $_orderby . ',';
                    }
                }
                if ($order) {
                    $order = ' ORDER BY' . substr($order, 0, -1);
                }
            }
        } elseif ($table1 == '#xiaocms_content') {
            $order = ' ORDER BY `listorder` DESC ,`time` DESC';
        }
        $limit = '';
        if (!empty($system['num'])) {
            $limit = ' LIMIT ' . $system['num'];
        } else if (isset($system['page'])) {
            if (isset($system['urlrule'])) {
                $pageurl = $system['urlrule'];
                $pagesize = $system['pagesize'] ? $system['pagesize'] : 10;
            } elseif ($this->cats[$fields['catid']]) {
                $pageurl = self::get_category_url($this->cats[$fields['catid']], 1);
                $pagesize = $system['pagesize'] ? $system['pagesize'] : $this->cats[$fields['catid']]['pagesize'];
            } else {
                $pagesize = $system['pagesize'] ? $system['pagesize'] : 10;
		    	$pageurl = (!$_SERVER['QUERY_STRING']) ? $_SERVER['REQUEST_URI'] . ((substr($_SERVER['REQUEST_URI'], -1) == '?') ? 'page=[page]' : '?page=[page]') : '';
	    		if (!$pageurl && (stristr($_SERVER['QUERY_STRING'], 'page='))) {								
				$pageurl = str_ireplace('page=' . $system['page'], '', $_SERVER['REQUEST_URI']);
				$urllast = substr($pageurl, -1);			
				if ($urllast == '?' || $urllast == '&')
				$pageurl .= 'page=[page]';
			    else
				$pageurl .= '&page=[page]';
		    	}
		    	if (!$pageurl) $pageurl = $_SERVER['REQUEST_URI'] . '&page=[page]';
            }
            if (!empty($system['cache'])) {
                $sqlcache = DATA_DIR . 'models' . DIRECTORY_SEPARATOR . md5($from . $where) . '.sqlcache.php';
                if (is_file($sqlcache) && time() - filemtime($sqlcache) < $system['cache'] * 60) {
                    $count = unserialize(file_get_contents($sqlcache));
                } else {
                    $count = $db->query('SELECT count(*) AS total ' . $from . ' ' . $where)->fetchAll();
                    file_put_contents($sqlcache, serialize($count), LOCK_EX);
                }
            } else {
                $count = $db->query('SELECT count(*) AS total ' . $from . ' ' . $where)->fetchAll();
            }
            $limit = ' LIMIT ' . $pagesize * ($system['page'] - 1) . ',' . $pagesize;
            $pagelist = xiaocms::load_class('pager');
            $pagelist = $pagelist->total($count['0']['total'])->url($pageurl)->num($pagesize)->hide()->page($system['page'])->output();
        }
        if (!empty($system['cache'])) {
            $sqlcache = DATA_DIR . 'models' . DIRECTORY_SEPARATOR . md5($from . $where . $order . $limit) . '.sqlcache.php';
            if (is_file($sqlcache) && time() - filemtime($sqlcache) < $system['cache'] * 60) {
                $data = unserialize(file_get_contents($sqlcache));
            } else {
                $data = $db->query('SELECT * ' . $from . $where . $order . $limit)->fetchAll();
                file_put_contents($sqlcache, serialize($data), LOCK_EX);
            }
        } else {
            $data = $db->query('SELECT * ' . $from . $where . $order . $limit)->fetchAll();
        }
        if (isset($system['return']) && $system['return']) {
            return array(
                'pagelist_' . $system['return'] => $pagelist,
                'return_' . $system['return'] => $data,
            );
        }
        foreach ($data as $key => $t) {
            $data[$key]['url'] = self::get_show_url($t);
        }
        return array('pagelist' => $pagelist, 'return' => $data,);
    }

    protected function block($id)
    {
        $data = get_cache('block');
        $row = $data[$id];
        if (empty($row)) return null;
        echo htmlspecialchars_decode($row['content']);
    }

    public function get_category_url($data, $page = 0)
    {
        if ($data['typeid'] == 3) return $data['http'];
        if (!empty($this->site_config['diy_url']) && $this->site_config['list_url']) {
            $data['page'] = '[page]';
            if (!empty($page))
                $url = preg_replace('#{([a-z_0-9]+)}#e', "\$data[\\1]", $this->site_config['list_page_url']);
            else {
                $url = preg_replace('#{([a-z_0-9]+)}#e', "\$data[\\1]", $this->site_config['list_url']);
            }
        }
		else {
        $url = 'index.php?catid=' . $data['catid'];
        if (!empty($page)) $url = 'index.php?catid=' . $data['catid'] . '&page=[page]';
		}
        return SITE_PATH . $url;
    }

    public function get_show_url($data, $page = 0)
    {
        if (!empty($this->site_config['diy_url']) && $this->site_config['show_url']) {
            $data['catdir'] = $this->cats[$data['catid']]['catdir'];
            $data['catid'] = $this->cats[$data['catid']]['catid'];
            $data['page'] = '[page]';
            if (!empty($page))
                $url = preg_replace('#{([a-z_0-9]+)}#e', '\$data[\\1]', $this->site_config['show_page_url']);
            else {
                $url = preg_replace('#{([a-z_0-9]+)}#e', '\$data[\\1]', $this->site_config['show_url']);
            }
        } else {
        $url = 'index.php?id=' . $data['id'];
        if (!empty($page)) $url = 'index.php?id=' . $data['id'] . '&page=[page]';
		}
        return SITE_PATH . $url;
    }

    public function __destruct()
    {
        $this->_options = array();
    }

}