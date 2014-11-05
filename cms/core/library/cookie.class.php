<?php
if (!defined('IN_XIAOCMS')) exit();

class cookie
{

    protected static $_defaultConfig = array(
        'expire' => 86400,
        'path' => '/',
        'domain' => null
    );

    public static function get($cookieName = null, $default = null)
    {
        if (!$cookieName) {
            return isset($_COOKIE) ? $_COOKIE : null;
        }
        $cookieName = COOKIE_PRE . $cookieName;
        return isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : $default;
    }

    public static function set($name, $value, $expire = null, $path = null, $domain = null)
    {
        if (!$name) return false;
        $name = COOKIE_PRE . $name;
        $expire = is_null($expire) ? self::$_defaultConfig['expire'] : time() + $expire;
        if (is_null($path)) $path = '/';
        $expire = time() + $expire;
        setcookie($name, $value, $expire, $path, $domain);
        $_COOKIE[$name] = $value;
        return true;
    }

    public static function delete($name)
    {
        if (!$name) return false;
        self::set($name, null, '-86400');
        unset($_COOKIE[COOKIE_PRE . $name]);
        return true;
    }

    public static function clear()
    {
        if (isset($_COOKIE)) {
            unset($_COOKIE);
        }
        return true;
    }

}