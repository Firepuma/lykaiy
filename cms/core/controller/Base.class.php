<?php
if (!defined('IN_XIAOCMS')) exit();

abstract class Base
{

    protected $db;
    protected $view;
    protected $cookie;
    protected $session;
    protected $site_config;
    protected $category_cache;
    protected $content_model;
    protected $member_info;

    public function __construct()
    {
        if (get_magic_quotes_runtime()) @set_magic_quotes_runtime(0);
        if (get_magic_quotes_gpc()) {
            $_POST = $this->strip_slashes($_POST);
            $_GET = $this->strip_slashes($_GET);
            $_SESSION = $this->strip_slashes($_SESSION);
            $_COOKIE = $this->strip_slashes($_COOKIE);
        }
        if (defined('XIAOCMS_ADMIN') || defined('XIAOCMS_MEMBER')) {
            define('SITE_PATH', self::get_a_url());
        } else {
            define('SITE_PATH', self::get_base_url());
        }
        if (!is_file(XIAOCMS_PATH . 'data/install.lock')) self::redirect(url('install/index'));
        if (is_file(XIAOCMS_PATH . 'member' . DIRECTORY_SEPARATOR . 'index.php'))
		define('XIAOCMS_MEMBER', XIAOCMS_PATH . 'member' . DIRECTORY_SEPARATOR);
        $this->db = xiaocms::load_class('Model');
        $this->view = xiaocms::load_class('view');
        $this->cookie = xiaocms::load_class('cookie');
        $this->session = xiaocms::load_class('session');
        $this->site_config = xiaocms::load_config('config');
        $this->category_cache = get_cache('category');
        $this->content_model = get_cache('content_model');
        $this->member_info =  self::get_member_info();
        $this->view->assign(array(
            'cats' => $this->category_cache,
            'member' => $this->member_info,
            'site_url' => self::get_http_host() . SITE_PATH,
            'site_name' => $this->site_config['site_name'],
            'page' => (int)self::get('page') ? (int)self::get('page') : 1,
            'site_template' => SITE_PATH . basename(TEMPLATE_DIR) . '/' . basename(SYS_THEME_DIR) . '/',
        ));
    }

    public function show_message($msg, $status = 2, $url = HTTP_REFERER, $time = 1800)
    {
        include CORE_PATH . 'img' . DIRECTORY_SEPARATOR . 'message' . DIRECTORY_SEPARATOR . 'xiaocms_msg.tpl.php';
        exit;
    }

    protected function get_user_ip($default = '0.0.0.0')
    {
        $keys = array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR');
        foreach ($keys as $key) {
            if (!isset($_SERVER[$key]) || !$_SERVER[$key]) {
                continue;
            }
            return htmlspecialchars($_SERVER[$key]);
        }
        return $default;
    }

    public static function get($string)
    {
        if (!isset($_GET[$string])) return null;
        if (!is_array($_GET[$string])) return htmlspecialchars(trim($_GET[$string]));
        return null;
    }

    public static function post($string)
    {
        if (!isset($_POST[$string])) return null;
        if (!is_array($_POST[$string])) return htmlspecialchars(trim($_POST[$string]));
        $postArray = self::array_map_htmlspecialchars($_POST[$string]);
        return $postArray;
    }

    protected static function array_map_htmlspecialchars($string)
    {
        foreach ($string as $key => $value) {
            $string[$key] = is_array($value) ? self::array_map_htmlspecialchars($value) : htmlspecialchars(trim($value));
        }
        return $string;
    }

    public static function get_http_host()
    {
        $http_host = strtolower($_SERVER['HTTP_HOST']);
        $secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;
        return ($secure ? 'https://' : 'http://') . $http_host;
    }

    public static function get_base_url()
    {
        $url = str_replace(array('\\', '//'), '/', $_SERVER['SCRIPT_NAME']);
        $po= strripos($url,'/');
        return substr($url,0,$po+1);
    }

    public static function get_a_url()
    {
        $url = str_replace(array('\\', '//'), '/', $_SERVER['SCRIPT_NAME']);
        $po = strripos($url,'/');
        $url = substr($url,0,$po);
        $po = strripos($url,'/');
        return substr($url,0,$po+1);
    }

    protected function redirect($url)
    {
        if (!$url) return false;
        if (!headers_sent()) header("Location:" . $url);
        else  echo '<script type="text/javascript">location.href="' . $url . '";</script>';
        exit();
    }

    protected static function strip_slashes($string)
    {
        if (!$string) return $string;
        if (!is_array($string)) return stripslashes($string);
        foreach ($string as $key => $value) {
            $string[$key] = self::strip_slashes($value);
        }
        return $string;
    }

    protected function checkCode($value)
    {
        $code = $this->session->get('checkcode');
        $value = strtolower($value);
        $this->session->delete('checkcode');
        return $code == $value ? true : false;
    }

    protected function watermark($file)
    {
        if (!$this->site_config['site_watermark']) return false;
        $image = xiaocms::load_class('image');
        $image->watermark($file, $this->site_config['site_watermark_pos']);
    }

    protected function get_member_info()
    {
        if (!defined('XIAOCMS_MEMBER') || defined('XIAOCMS_ADMIN')) return false;
        if ($this->cookie->get('member_id') && $this->cookie->get('member_code')) {
            $id = (int)$this->cookie->get('member_id');
            $code = $this->cookie->get('member_code');
            if (!empty($id) && $code == substr(md5($this->site_config['rand_code'] . $id), 5, 20)) {
                $member = $this->db->setTableName('member')->find($id);
                if ($member) {
				    $member_model = get_cache('member_model');
                    $member_info = $this->db->setTableName($member_model[$member['modelid']]['tablename'])->find($id);
                    if ($member_info) {
                        $member = array_merge($member, $member_info);
                    }
                   return $member;
                }
            }
        }
        return false;
    }

    protected function get_data_fields($fields, $data = array())
    {
        if (empty($fields)) return false;
        $field = xiaocms::load_class('field');
        $data_fields = '';
        foreach ($fields as $t) {
            if (!defined('XIAOCMS_ADMIN') && !$t['isshow']) continue;
            $data_fields .= '<tr><th>' . (!empty($t['pattern']) ? ' <font color="red">*</font> ' : '') . $t['name'] . '：</th><td>';
            $t['setting'] = $t['setting'] ? string2array($t['setting']) : 0;
            $content = !isset($data[$t['field']]) ? $t['setting']['defaultvalue'] : $data[$t['field']];
            if (method_exists($field, $t['formtype']))
                $data_fields .= $field->$t['formtype']($t['field'], $content, $t['setting']);
            $data_fields .= ($t['tips'] ? '<div class="onShow">' . $t['tips'] . '</div>' : '') . '</td></tr>';
        }
        return $data_fields;
    }

    protected function post_check_fields($fields, $data)
    {
        foreach ($fields as $t) {
            if (!defined('XIAOCMS_ADMIN') && !$t['isshow']) continue;
            if ($t['pattern']) {
                if ($t['pattern'] == 1) {
                    if ($data[$t['field']] == '') $this->show_message(empty($t['errortips']) ? $t['name'] . '不能为空' : $t['errortips'],2,1);
                } else {
                    if (!preg_match($t['pattern'], $data[$t['field']])) $this->show_message(empty($t['errortips']) ? $t['name'] . '格式不正确' : $t['errortips'],2,1);
                }
            }
//			if (in_array($t['formtype'], array('checkbox', 'files', 'diy'))) $data[$t['field']] = array2string($data[$t['field']]);
			if ($t['formtype']=='related'){
				$data[$t['field']]= explode(',', $data[$t['field']]);
				foreach( $data[$t['field']] as $k=>$v){
				   if(!$v) unset( $data[$t['field']][$k] );
				}
				$data[$t['field']] = implode(',', $data[$t['field']]);
			}
            if (is_array($data[$t['field']])) $data[$t['field']] = array2string($data[$t['field']]);
        }
        return $data;
    }

    protected function handle_fields($fields, $data)
    {
        foreach ($fields as $t) {
            if (in_array($t['formtype'], array('checkbox', 'files', 'diy'))) $data[$t['field']] = string2array($data[$t['field']]);
            if ($t['formtype'] == 'editor') $data[$t['field']] = htmlspecialchars_decode($data[$t['field']]);
        }
        return $data;
    }

    protected function listSeo($cat, $page = 1)
    {
        $seo_title = $seo_keywords = $seo_description = '';
        $seo_title = empty($cat['seo_title']) ? self::get_title($cat['catid']) : $cat['seo_title'] . ' - ';
        $seo_title = $page > 1 ? $cat['catname'] . ' - 第' . $page . '页 - ' . $this->site_config['site_name'] : $seo_title . $this->site_config['site_name'] . ' - ' . base64_decode('UG93ZXJlZCBieSBYaWFvQ21z');
        $seo_keywords = empty($cat['seo_keywords']) ? self::get_title($cat['catid']) . ',' . $this->site_config['site_keywords'] : $cat['seo_keywords'];
        $seo_description = empty($cat['seo_description']) ? $this->site_config['site_description'] : $cat['seo_description'];
        return array('site_title' => $seo_title, 'site_keywords' => $seo_keywords, 'site_description' => $seo_description);
    }

    protected function showSeo($data, $page = 1)
    {
        $seo_title = $seo_keywords = $seo_description = '';
        $listseo = self::listSeo($this->category_cache[$data['catid']]);
        $seo_title = $data['title'] . ' - ' . ($page > 1 ? '第' . $page . '页' . ' - ' : '') . $listseo['site_title'];
        $seo_keywords = empty($data['keywords']) ? $listseo['site_keywords'] : $data['keywords'] . ',' . $listseo['seo_keywords'];
        $seo_description = empty($data['description']) ? $listseo['site_description'] : $data['description'];
        return array('site_title' => $seo_title, 'site_keywords' => $seo_keywords, 'site_description' => $seo_description);
    }

    protected function get_title($catid)
    {
        $catids = parentids($catid, $this->category_cache);
        $catids = explode(',', $catids);
        $title = '';
        foreach ($catids as $t) {
            if ($t) $title .= $this->category_cache[$t]['catname'] . ' - ';
        }
        return $title;
    }

}