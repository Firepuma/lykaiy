<?php
/* junkie_framework */
class junkie_framework{
	
	private $fw_version='',$fw_log_url='',$fw_file_url='',$theme_name='',$theme_version='',$themelog_url='',$print_log_url='',$themes_array_list= array(),$transient_day=1,$check_if_critical=false;

	public function set_fw_version($value){
		$this->fw_version=$value;
	}
	public function set_fw_log($url){
		$this->fw_log_url=$url;
	}
	public function set_fw_file_url($url){
		$this->fw_file_url=$url;
	}
	public function set_theme_name($value){
		$this->theme_name=$value;
	}
	public function set_theme_version($value){
		$this->theme_version=$value;
	}
	public function set_theme_log($url){
		$this->themelog_url=$url;
	}
	public function set_print_log($value){
		$this->print_log_url=$value;
	}
	public function set_themes_array_list($value){
		$this->themes_array_list=$value;
	}
	public function set_transient_day($value){
		$this->transient_day=$value;
	}
	public function set_critical($value){
		$this->check_if_critical=$value;
	}
	//end settings
	
	public function get_fw_version() {
		return $this->fw_version;
	}
	public function get_fw_file_url() {
		return $this->fw_file_url;
	}
	public function get_theme_name() {
		return $this->theme_name;
	}
	public function get_theme_version() {
		return $this->theme_version;
	}
	public function get_themes_array_list(){
		return $this->themes_array_list;
	}
	public function fun_get_fw_version() {
		$fw_log_url=$this->fw_log_url;
		
		if(empty( $fw_log_url ) )
		$fw_log_url = 'http://www.theme-junkie.com/framework/framework-changelog.txt';
		
		$output = array( 'version' => '', 'is_critical' => $this->check_if_critical );		
		$version_data =get_transient( 'junkie_framework_version_data' );//judge the transient containing
		
		if ( $version_data != '' && $this->check_if_critical == false )
		return $version_data;
		
		$temp_file_addr = download_url( $fw_log_url );
		if( ! is_wp_error( $temp_file_addr ) && $file_contents = file( $temp_file_addr ) ) {
			foreach ( $file_contents as $line_num => $line ) {
				$current_line =  $line;
				if( $line_num > 1 ) {    // Not the first or second... dodgy :P
					if ( preg_match( '/^[0-9]/', $line ) ) {
							// Do critical update check.
							if ( $check_if_critical && ( strtolower( trim( substr( $line, -10 ) ) ) == 'critical' ) ) {
								$output['is_critical'] = true;
							}
							$current_line = stristr( $current_line, 'version' );
							$current_line = preg_replace( '~[^0-9,.]~','',$current_line );
							$output['version'] = $current_line;
							break;
					}
				}
			}
			unlink( $temp_file_addr );
		} else {
			$output['version'] = get_option( 'junkie_framework_version' );
		}
		// Set the transient containing the latest version number.
		set_transient( 'junkie_framework_version_data', $output , 60*60*24*$transient_day );
		return $output;
	}
	
	public function fun_get_theme_version() {//GET the server version

		$theme_name=strtolower($this->theme_name);
		$theme_version=$this->theme_version;
		$themelog_url=$this->themelog_url;
		
		if(empty( $themelog_url ) )
		$themelog_url = 'http://demo.theme-junkie.com/wp-content/themes/'.$theme_name.'/changelog.txt';
	
		$output = array( 'version' => '', 'is_critical' => $this->check_if_critical );		
		$version_data =get_transient($theme_name.'_theme_version_data');//judge the transient containing
		
		if ( $version_data != '' && $this->check_if_critical == false )
		return $version_data;
		
		$temp_file_addr = download_url( $themelog_url );
		if( ! is_wp_error( $temp_file_addr ) && $file_contents = file( $temp_file_addr ) ) {
			foreach ( $file_contents as $line_num => $line ) {
				$current_line =  $line;
				if( $line_num > 1 ) {    // Not the first or second... dodgy :P
					if ( preg_match( '/^[0-9]/', $line ) ) {
							// Do critical update check.
							if ( $check_if_critical && ( strtolower( trim( substr( $line, -10 ) ) ) == 'critical' ) ) {
								$output['is_critical'] = true;
							}
							$current_line = stristr( $current_line, 'version' );
							$current_line = preg_replace( '~[^0-9,.]~','',$current_line );
							$output['version'] = $current_line;
							break;
					}
				}
			}
			unlink( $temp_file_addr );
		} else {
			$output['version'] =$theme_version;
		}
		// Set the transient containing the latest version number.
		set_transient( $theme_name.'_theme_version_data', $output , 60*60*24*$transient_day );
		return $output;
	}
	
	
	public function fun_get_print_log(){
		$log_url=$this->print_log_url;
		
		if( empty( $log_url ) )
		$log_url = 'http://www.theme-junkie.com/framework/framework-changelog.txt';
			
		$log_data =get_transient( 'junkie_framework_log_data' );//judge the transient containing
		
		if ( $log_data != '' && $this->check_if_critical == false )
		return $log_data;
		
		$temp_file_addr = download_url( $log_url );
		$myFile=file($temp_file_addr);
		unlink($temp_file_addr);
		$content='';
		for($index=0;$index<count($myFile);$index++)
		{
			$content=$content.$myFile[$index]."<br>";
		}
		set_transient( 'junkie_framework_log_data', $content , 60*60*24*$transient_day );
		return $content;
	}
	
}
?>