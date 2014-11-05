<?php
if (!defined('IN_XIAOCMS')) exit();

class pager
{

    protected $_url = null;
    protected $_page = 1;
    protected $_total = 0;
    protected $_totalPages = 0;
    protected $_num = 10;
    protected $_perCircle = 10;
    protected $_ext = false;
    protected $_center = 3;
    protected $_isAjax = false;
    protected $_ajaxActionName = null;
    protected $_styleFile = null;
    protected $_hiddenStatus = false;
    public $firstPage = '第一页';
    public $prePage = '上一页';
    public $nextPage = '下一页';
    public $lastPage = '最末页';
    public $note = '<a  href="#">共{$totalNum}条</a>';

    protected function _getTotalPage()
    {
        return ceil($this->_total / $this->_num);
    }

    protected function _getPageNum()
    {
        return ($this->_page > $this->_totalPages) ? $this->_totalPages : $this->_page;
    }

    public function num($num = null)
    {
        if ($num) $this->_num = $num;
        return $this;
    }

    public function total($totalNum = null)
    {
        if ($totalNum) $this->_total = $totalNum;
        return $this;
    }

    public function hide($item = true)
    {
        if ($item === true) {
            $this->_hiddenStatus = true;
        }
        return $this;
    }

    public function url($url = null)
    {
        if ($url) {
            $this->_url = trim($url);
        }
        return $this;
    }

    public function page($page = null)
    {

        if ($page) {
            $this->_page = $page;
        }
        return $this;
    }

    public function ext($ext = true)
    {
        $this->_ext = ($ext) ? true : false;
        return $this;
    }

    public function center($num)
    {
        if ($num && is_int($num)) {
            $this->_center = $num;
        }
        return $this;
    }

    public function circle($num)
    {
        if ($num && is_int($num)) {
            $this->_perCircle = $num;
        }
        return $this;
    }

    public function ajax($action)
    {
        if ($action) {
            $this->_isAjax = true;
            $this->_ajaxActionName = $action;
        }
        return $this;
    }

    public function output()
    {
        $data = $this->_processData();
        if (!$data) return null;
        $html = '<div class="xiaocms-page">';
        if ($data['ext'] === true && $this->note) {
            $html .= str_replace(array('{$totalNum}', '{$totalPage}', '{$num}'), array($data['total'], $data['totalpage'], $data['num']), $this->note);
        }
        if (isset($data['prepage'])) {
            foreach ($data['prepage'] as $lines) {
                $content = ($data['ajax'] === true) ? "<a href='{$lines['url']}' onclick='{$data['ajaxaction']}('{$lines['url']}'); return false;'>{$lines['text']}</a>" : "<a href='{$lines['url']}' target='_self'>{$lines['text']}</a>";
                $html .= $content;
            }
        }
        foreach ($data['listpage'] as $lines) {
            if ($lines['current'] === true) {
                $html .= '<span >' . $lines['text'] . '</span >';
            } else {
                $content = ($data['ajax'] === true) ? "<a href='{$lines['url']}' onclick='{$data['ajaxaction']}('{$lines['url']}'); return false;'>{$lines['text']}</a>" : "<a href='{$lines['url']}' >{$lines['text']}</a>";
                $html .= $content;
            }
        }
        if (isset($data['nextpage'])) {
            foreach ($data['nextpage'] as $lines) {
                $content = ($data['ajax'] === true) ? "<a href='{$lines['url']}' onclick='{$data['ajaxaction']}('{$lines['url']}'); return false;'>{$lines['text']}</a>" : "<a href='{$lines['url']}' >{$lines['text']}</a>";
                $html .= $content;
            }
        }
        $html .= '</div>';
        return $html;
    }

    public function render()
    {
        return $this->_processData();
    }

    protected function _processData()
    {
        $this->_url = trim(str_replace(array("\n", "\r"), '', $this->_url));
        $this->_totalPages = $this->_getTotalPage();
        $this->_page = $this->_getPageNum();
        $data = array();
        if (!$this->_totalPages) {
            return $data;
        }
        if (($this->_hiddenStatus === true) && ($this->_total <= $this->_num)) {
            return $data;
        }
        $data['total'] = $this->_total;
        $data['num'] = $this->_num;
        $data['totalpage'] = $this->_totalPages;
        $data['page'] = $this->_page;
        $data['url'] = $this->_url;
        $data['ajax'] = $this->_isAjax;
        if ($this->_isAjax) {
            $data['ajaxAction'] = $this->_ajaxActionName;
        }
        $data['ext'] = $this->_ext;
        if ($this->_page != 1 && $this->_totalPages > 1) {
            $data['prepage'] = array(
                array('text' => $this->firstPage, 'url' => str_replace('[page]', 1, $this->_url)),
                array('text' => $this->prePage, 'url' => str_replace('[page]', ($this->_page - 1), $this->_url)),
            );
        }
        if ($this->_page != $this->_totalPages && $this->_totalPages > 1) {
            $data['nextpage'] = array(
                array('text' => $this->nextPage, 'url' => str_replace('[page]', ($this->_page + 1), $this->_url)),
                array('text' => $this->lastPage, 'url' => str_replace('[page]', $this->_totalPages, $this->_url)),
            );
        }
        if ($this->_totalPages > $this->_perCircle) {
            if ($this->_page + $this->_perCircle >= $this->_totalPages + $this->_center) {
                $list_start = $this->_totalPages - $this->_perCircle + 1;
                $list_end = $this->_totalPages;
            } else {
                $list_start = ($this->_page > $this->_center) ? $this->_page - $this->_center + 1 : 1;
                $list_end = ($this->_page > $this->_center) ? $this->_page + $this->_perCircle - $this->_center : $this->_perCircle;
            }
        } else {
            $list_start = 1;
            $list_end = $this->_totalPages;
        }
        for ($i = $list_start; $i <= $list_end; $i++) {
            if ($i == $this->_page) {
                $data['listpage'][] = array('text' => $i, 'current' => true);
            } else {
                $data['listpage'][] = array('text' => $i, 'current' => false, 'url' => str_replace('[page]', $i, $this->_url));
            }
        }
        return $data;
    }

    public function select()
    {
        $data = $this->_processData();
        if (!$data) return null;
        $string = '<select name="xiaocms_select_pagelist" class="pagelist_select_box" onchange="self.location.href=this.options[this.selectedIndex].value">';
        for ($i = 1; $i <= $data['totalpage']; $i++) {
            $string .= ($i == $data['page']) ? '<option value="' . $data['url'] . $i . '" selected="selected">' . $i . '</option>' : '<option value="' . $data['url'] . $i . '">' . $i . '</option>';
        }
        $string .= '</select>';
        return $string;
    }

}