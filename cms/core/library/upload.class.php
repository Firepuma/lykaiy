<?php
if (!defined('IN_XIAOCMS')) exit();

class upload
{

    protected $limit_size;
    protected $file_name;
    protected $limit_type;

    public function  __construct()
    {
        $this->limit_size = 8388608;
        return true;
    }

    protected function parse_init($file)
    {
        $this->file_name = $file;
        if ($this->file_name['size'] > $this->limit_size) {
            echo '您上传的文件:' . $this->file_name['name'] . ' 大小超出上传限制!';
            exit();
        }
        if ($this->limit_type) {
            if (!in_array($this->get_file_ext(), $this->limit_type)) {
                echo '您上传的:' . $this->file_name['name'] . ' 文件格式不正确!';
                exit();
            }
        }
        return true;
    }

    public function get_file_ext()
    {
        return strtolower(substr(strrchr($this->file_name['name'], '.'), 1));
    }

    public function set_limit_size($size)
    {
        if ($size) $this->limit_size = $size;
        return $this;
    }

    public function set_limit_type($type)
    {
        if (!$type || !is_array($type)) return false;
        $this->limit_type = $type;
        return $this;
    }

    public function upload($file_upload, $file_name)
    {
        if (!is_array($file_upload) || empty($file_name)) return false;
        $this->parse_init($file_upload);
        if (!@move_uploaded_file($this->file_name['tmp_name'], $file_name)) return '文件上传失败，请检查服务器目录权限';
        return true;
    }

}