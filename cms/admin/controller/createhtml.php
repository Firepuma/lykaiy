<?php

class createhtml extends Admin {
    
    public function __construct() {
        parent::__construct();
		if ($this->site_config['diy_url'] != 2) $this->show_message('生成静态功能是收费的',2,  'http://www.xiaocms.com/buy/');
	}
}