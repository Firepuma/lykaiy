<?php
if (!defined('IN_XIAOCMS')) exit();

class session
{

    protected static $_start = false;

    public function __construct()
    {
        $this->_setTimeout();
        $this->start();
        return true;
    }

    public static function start()
    {
        if (self::$_start === true) return true;
        $sessionPath = XIAOCMS_PATH . 'data' . DIRECTORY_SEPARATOR . 'session' . DIRECTORY_SEPARATOR;
        if (is_dir($sessionPath) && is_writable($sessionPath)) {
            session_save_path($sessionPath);
        }
        if (isset($_POST['session_id'])) {
            session_id($_POST['session_id']);
        }
        session_start();
		header("Cache-control:private");
        header('X-Powered-By: XiaoCms ' . XIAOCMS_RELEASE);
        self::$_start = true;
        return true;
    }

    public static function set($key, $value = null)
    {
        if (!$key) return false;
        if (self::$_start === false) self::start();
        $_SESSION[$key] = $value;
        return true;
    }

    public static function get($key, $default = null)
    {
        if (!$key) return isset($_SESSION) ? $_SESSION : null;
        if (self::$_start === false) self::start();
        if (!isset($_SESSION[$key])) return $default;
        return $_SESSION[$key];
    }

    public static function delete($key)
    {
        if (!$key) return false;
        if (!isset($_SESSION[$key])) return false;
        unset($_SESSION[$key]);
        return true;
    }

    public static function clear()
    {
        $_SESSION = array();
        return true;
    }

    public static function destory()
    {
        if (self::$_start === true) {
            unset($_SESSION);
            session_destroy();
        }
        return true;
    }

    public static function close()
    {
        if (self::$_start === true) {
            session_write_close();
        }
        return true;
    }

    protected static function _setTimeout()
    {
        return ini_set('session.gc_maxlifetime', 21600);
    }

    public function __destruct()
    {
        $this->close();
        return true;
    }
	
}
