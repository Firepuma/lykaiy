<?php
/**
 * xiaocms.php
 * 框架入口文件
 */
header('Content-Type: text/html; charset=utf-8');
define('IN_XIAOCMS', true);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$config         = xiaocms::load_config('config');
/**
 * 配置
 */
define('SYS_START_TIME',     microtime(true));
define('HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
define('CORE_PATH',           dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('DATA_DIR',         XIAOCMS_PATH . 'data' . DIRECTORY_SEPARATOR);
define('TEMPLATE_DIR',           XIAOCMS_PATH . 'template' . DIRECTORY_SEPARATOR);
if (!defined('CONTROLLER_DIR')) define('CONTROLLER_DIR',     CORE_PATH . 'controller' . DIRECTORY_SEPARATOR);
define('COOKIE_PRE',			'xiaocms_');//Cookie 前缀，同一域名下安装多套系统时，请修改Cookie前缀
date_default_timezone_set('Asia/Shanghai');
xiaocms::load_file(CORE_PATH . 'library' . DIRECTORY_SEPARATOR . 'global.function.php');
xiaocms::load_file(CORE_PATH . 'version.php');
xiaocms::load_file(CORE_PATH . 'controller/Base.class.php'); 

/**
 * 系统核心全局控制类
 */
abstract class xiaocms {
	public static $controller;
	public static $action;
	/**
	 * 分析URL信息
	 */
	private static function parse_request() {
		$path_url_string = isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] ? $_SERVER['QUERY_STRING'] : $_SERVER['REQUEST_URI'];
		parse_str($path_url_string, $url_info_array);		
		$controller_name  = trim((isset($url_info_array['c']) && $url_info_array['c']) ? $url_info_array['c'] : 'index');
		$action_name      = trim((isset($url_info_array['a']) && $url_info_array['a']) ? $url_info_array['a'] : 'index'); 
		self::$controller = self::_safe(strtolower($controller_name));
		self::$action 	  = self::_safe(strtolower($action_name));
		$_GET             = array_merge($_GET, $url_info_array);
		return true;
	}
	
	/**
	 * 项目运行函数
	 */
	public static function run() {
		global $config ;
		if (!empty($config['site_mobile']) && is_mobile()) {
			$config['site_theme'] =  (is_dir(TEMPLATE_DIR . 'mobile') ? 'mobile' : $config['site_theme']);
		}
		static $_app	= array();
		$app_id 		= self::$controller . '_' . self::$action;
		define('SYS_THEME_DIR',	$config['site_theme'] . DIRECTORY_SEPARATOR);	//模板风格
		self::parse_request();
		if (!isset($_app[$app_id])) {
			$controller = self::$controller;
			$action     = self::$action . 'Action';
			if (is_file(CONTROLLER_DIR . $controller . '.php')) {	
				self::load_file(CONTROLLER_DIR . $controller . '.php');				
			} else {
			   exit('XiaoCms：Controller does not exist.');
			}
			$app_object = new $controller();
			if (method_exists($controller, $action)) {
				$_app[$app_id] = $app_object->$action();
			} else {
				exit('XiaoCms：Action does not exist.');
			}
		}
		return $_app[$app_id];
	}
	
	/**
	 * 静态加载文件(相当于PHP函数require_once)
	 */
	public static function load_file($file_name) {
		static $_inc_files = array();
		//参数分析
		if (!$file_name) return false;
		 if (!isset($_inc_files[$file_name])) {
			if (!file_exists($file_name)) {
				exit('The file:' . $file_name . ' not found!');
			}
			include_once $file_name;
			$_inc_files[$file_name] = true;
		}
		return $_inc_files[$file_name];
	}
	
	/**
	 * 加载配置文件
	 */
	public static function load_config($file) {
		static $configs = array();
		$path = XIAOCMS_PATH . 'data' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . $file . '.ini.php';
		if (file_exists($path)) {
			$configs[$file] = include $path;
			return $configs[$file];
		}
	}
	
	/**
	 * 加载类
	 */
	public static function load_class($classname, $initialize = 1) {
		static $classes = array();
		
		$key = md5($classname);
		if (isset($classes[$key])) {
			if (!empty($classes[$key])) {
				return $classes[$key];
			} else {
				return true;
			}
		}
		if (file_exists(CORE_PATH.'library'.DIRECTORY_SEPARATOR.$classname.'.class.php')) {
			include CORE_PATH.'library'.DIRECTORY_SEPARATOR.$classname.'.class.php';
			$name = $classname;
			if ($initialize) {
				$classes[$key] = new $name;
			} else {
				$classes[$key] = true;
			}
			return $classes[$key];
		} else {
			return false;
		}
	}
	
    /**
	 * 安全处理函数controller
	 */
	private static function _safe($str) {
		return str_replace(array('/', '.'), '', $str);
	}
	
	/**
	 * 获取当前运行的controller名称
	 */
	public static function get_controller_id() {
		return self::$controller;
	}
	
	/**
	 * 获取当前运行的action名称
	 */
	public static function get_action_id() {
		return self::$action;
	}

}
