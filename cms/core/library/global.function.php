<?php

if (!defined('IN_XIAOCMS')) exit();

/**
 * 图片路径自动补全
 */
function image($url)
{
    if (empty($url) || strlen($url) < 4) return SITE_PATH . 'data/upload/nopic.gif';
    if (substr($url, 0, 7) == 'http://') return $url;
    if (strpos($url, SITE_PATH) !== false && SITE_PATH != '/') return $url;
    if (substr($url, 0, 1) == '/') $url = substr($url, 1);
    return SITE_PATH . $url;
}

/**
 * 缩略图片
 */
function thumb($img, $width=200, $height=200)  {
    if (empty($img) || strlen($img)  < 4) return SITE_PATH . 'data/upload/nopic.gif';
    if (file_exists(XIAOCMS_PATH.$img)) {
        $ext = fileext($img);
		$thumb = $img . '.thumb.' . $width . 'x' . $height . '.' . $ext;
		if (!file_exists(XIAOCMS_PATH.$thumb)) {
		    $image = xiaocms::load_class('image');
		    $image->thumb(XIAOCMS_PATH.$img, XIAOCMS_PATH.$thumb, $width, $height); // 生成图像缩略图
		}
		return $thumb;
    }
    return $img;
}

/**
 * 字符截取 支持UTF8/GBK
 */
function strcut($string, $length, $dot = '')
{
    if (strlen($string) <= $length) return $string;
    $string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array('&', '"', '<', '>'), $string);
    $strcut = '';
    $n = $tn = $noc = 0;
    while ($n < strlen($string)) {
        $t = ord($string[$n]);
        if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1;
            $n++;
            $noc++;
        } elseif (194 <= $t && $t <= 223) {
            $tn = 2;
            $n += 2;
            $noc += 2;
        } elseif (224 <= $t && $t <= 239) {
            $tn = 3;
            $n += 3;
            $noc += 2;
        } elseif (240 <= $t && $t <= 247) {
            $tn = 4;
            $n += 4;
            $noc += 2;
        } elseif (248 <= $t && $t <= 251) {
            $tn = 5;
            $n += 5;
            $noc += 2;
        } elseif ($t == 252 || $t == 253) {
            $tn = 6;
            $n += 6;
            $noc += 2;
        } else {
            $n++;
        }
        if ($noc >= $length) break;
    }
    if ($noc > $length) $n -= $tn;
    $strcut = substr($string, 0, $n);
    $strcut = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
    return $strcut . $dot;
}

/**
 * 取得文件扩展
 */
function fileext($filename)
{
	return pathinfo($filename, PATHINFO_EXTENSION);
}

/**
 * 正则表达式验证email格式
 */
function is_email($email)
{
    return strlen($email) > 6 && strlen($email) <= 32 && preg_match("/^([A-Za-z0-9\-_.+]+)@([A-Za-z0-9\-]+[.][A-Za-z0-9\-.]+)$/", $email);
}

/**
 * 栏目面包屑导航 当前位置
 */
function position($catid, $symbol = ' > ')
{
    if (empty($catid)) return false;
    $cats = get_cache('category');
    $catids = parentids($catid, $cats);
    $catids = array_filter(explode(',', $catids));
    krsort($catids);
    $html = '';
    foreach ($catids as $t) {
        $html .= "<a href=\"" . $cats[$t]['url'] . "\" title=\"" . $cats[$t]['catname'] . "\">" . $cats[$t]['catname'] . "</a>";
        if ($catid != $t) $html .= $symbol;
    }
    return $html;
}

/**
 * 递归获取上级栏目集合
 */
function parentids($catid, $cats)
{
    if (empty($catid)) return false;
    $catids = $catid . ',';
    if ($cats[$catid]['parentid'])
        $catids .= parentids($cats[$catid]['parentid'], $cats);
    return $catids;
}

/**
 * 获取当前栏目顶级栏目
 */
function get_top_cat($catid)
{
    $cats = get_cache('category');
    $cat = $cats[$catid];
    if ($cat['parentid']) $cat = get_top_cat($cat['parentid']);
    return $cat;
}

/**
 * 程序执行时间
 */
function runtime()
{
    $temptime = explode(' ', SYS_START_TIME);
    $time = $temptime[1] + $temptime[0];
    $temptime = explode(' ', microtime());
    $now = $temptime[1] + $temptime[0];
    return number_format($now - $time, 6);
}


/**
 * 返回经stripslashes处理过的字符串或数组
 */
function new_stripslashes($string)
{
    if (!is_array($string)) return stripslashes($string);
    foreach ($string as $key => $val) $string[$key] = new_stripslashes($val);
    return $string;
}


/**
 * 将字符串转换为数组
 */
function string2array($data)
{
    if ($data == '') return array();
    return unserialize($data);
}

/**
 * 将数组转换为字符串
 */
function array2string($data, $isformdata = 1)
{
    if ($data == '') return '';
    if ($isformdata) $data = new_stripslashes($data);
    return serialize($data);
}

/**
 * 字节格式化
 */
function file_size_count($size, $dec = 2)
{
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $pos++;
    }
    return round($size, $dec) . " " . $a[$pos];
}

/**
 * 汉字转为拼音
 */
function word2pinyin($word)
{
    if (empty($word)) return '';
    $pin = xiaocms::load_class('pinyin');
    return str_replace('/', '', $pin->output($word));
}

/**
 * 判断是否手机访问
 */
function is_mobile()
{
    static $is_mobile;
    if (isset($is_mobile)) return $is_mobile;
    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false
    ) {
        $is_mobile = true;
    } else {
        $is_mobile = false;
    }
    return $is_mobile;
}

/**
 * 转化 \ 为 /
 */
function dir_path($path)
{
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/') $path = $path . '/';
    return $path;
}

/**
 * 递归创建目录
 */
function mkdirs($dir)
{
    if (empty($dir)) return false;
    if (!is_dir($dir)) {
        mkdirs(dirname($dir));
        mkdir($dir);
    }
}

/**
 * 删除目录及目录下面的所有文件
 */
function delete_dir($dir)
{
    $dir = dir_path($dir);
    if (!is_dir($dir)) return FALSE;
    $list = glob($dir . '*');
    foreach ($list as $v) {
        is_dir($v) ? delete_dir($v) : @unlink($v);
    }
    return @rmdir($dir);
}

/**
 * 写入缓存
 */
function set_cache($cache_file, $value)
{
    if (!$cache_file) return false;
    $cache_file = DATA_DIR . 'cache' . DIRECTORY_SEPARATOR . $cache_file . '.cache.php';
    $value = (!is_array($value)) ? serialize(trim($value)) : serialize($value);
    if (!is_dir(DATA_DIR . 'cache' . DIRECTORY_SEPARATOR)) {
        mkdirs(DATA_DIR . 'cache' . DIRECTORY_SEPARATOR);
    }
    return file_put_contents($cache_file, $value, LOCK_EX) ? true : false;
}

/**
 * 获取缓存
 */
function get_cache($cache_file)
{
    if (!$cache_file) return false;
    $cache_file = DATA_DIR . 'cache' . DIRECTORY_SEPARATOR . $cache_file . '.cache.php';
    return is_file($cache_file) ? unserialize(file_get_contents($cache_file)) : false;
}

/**
 * 删除缓存
 */
function delete_cache($cache_file)
{
    if (!$cache_file) return true;
    $cache_file = DATA_DIR . 'cache' . DIRECTORY_SEPARATOR . $cache_file . '.cache.php';
    return is_file($cache_file) ? unlink($cache_file) : true;
}

/**
 * 组装url
 */
function url($route, $params = null)
{
    if (!$route) return false;
    $arr = explode('/', $route);
    $arr = array_diff($arr, array(''));
    $url = 'index.php';
    if (isset($arr[0]) && $arr[0]) {
        $url .= '?c=' . strtolower($arr[0]);
        if (isset($arr[1]) && $arr[1] && $arr[1] != 'index') $url .= '&a=' . strtolower($arr[1]);
    }
    if (!is_null($params) && is_array($params)) {
        $params_url = array();
        foreach ($params as $key => $value) {
            $params_url[] = trim($key) . '=' . trim($value);
        }
        $url .= '&' . implode('&', $params_url);
    }
    $url = str_replace('//', '/', $url);
    return Base::get_base_url() . $url;
}
