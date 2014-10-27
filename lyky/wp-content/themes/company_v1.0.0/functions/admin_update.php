<?php
	global $junkie_obj;
	$server_file_url=$junkie_obj->get_fw_file_url();
	$print_log=$junkie_obj->fun_get_print_log();
	$remoteversion = $junkie_obj->fun_get_fw_version();
	$local_version = esc_html( get_option( 'junkie_framework_version' ) );
	
	// Test if new version
	$upd = false;
	$loc = explode( '.',$local_version);
	$rem = explode( '.',$remoteversion['version']);
	$loc[0]?$loc[0]:$loc[0]=0;
	$loc[1]?$loc[1]:$loc[1]=0;
	$loc[2]?$loc[2]:$loc[2]=0;
	$rem[0]?$rem[0]:$rem[0]=0;
	$rem[1]?$rem[1]:$rem[1]=0;
	$rem[2]?$rem[2]:$rem[2]=0;
	if($loc[0]<$rem[0])
	$upd = true;
	elseif($loc[1]<$rem[1])
	$upd = true;
	elseif($loc[2]<$rem[2])
	$upd = true;
	echo "<script>document.getElementById('framework-update').style.display='none';</script>";//hide warrnig	
	echo "<h2>Framework Update</h2>";
if( $upd ) {
	echo "
	<h3>A new version of Theme Junkie Framework is available.</h3>
	<p>This updater will download and extract the latest <strong>Theme Junkie Framework</strong> files to your current theme's functions folder. </p>
	<p>We recommend backing up your theme files and updating WordPress to latest version before proceeding.</p>
	<p>&rarr; <strong>Your version:</strong> ".$local_version."</p>
	<p>&rarr; <strong>Latest version:</strong> ".$remoteversion['version']."</p>
	<form method=\"post\"  enctype=\"multipart/form-data\" id=\"themeupform\" >";
	if(!isset($_POST['junkie_update_save']))
	echo "<input type=\"submit\" id=\"updatebt\" class=\"button\" value=\"Update Framework\" onsubmit=\"this.disabled='disabled'\" /><div class='updated' style='margin:10px 10px 0 0'><p>".$print_log."</p></div>";
	echo "<input type=\"hidden\" name=\"junkie_update_save\" value=\"save\" />
	<input type=\"hidden\" name=\"junkie_ftp_cred\" value=\"".esc_attr( base64_encode(serialize($_POST)))."\" />
	</form>
	";
}else{
	echo "<h3>You have the latest version of Theme Junkie Framework</h3>
	<p>&rarr; <strong>Your version:</strong> ".$local_version."</p>";
}
/*-------------------------------------------------------------------*/
//Setup Filesystem
if( isset( $_REQUEST['page'] ) )// Sanitize page being requested.
	$_page = esc_attr( $_REQUEST['page'] );
	
if( $_page == 'junkie-update-options' ) {
	$method = get_filesystem_method();
	if( isset( $_POST['junkie_ftp_cred'] ) ) {
		$cred = unserialize( base64_decode( $_POST['junkie_ftp_cred'] ) );
		$filesystem = WP_Filesystem($cred);
	} else {
	    $filesystem = WP_Filesystem();
	}
	if( $filesystem == false && $_POST['upgrade'] != 'Proceed' ) {
			$method = get_filesystem_method();
			echo "<div class='updated' style='margin:10px 10px 0 0'><p>Failed: Filesystem preventing downloads. ( ". $method .")</p></div>";
			return;
	}
		
	if(isset($_POST['junkie_update_save'])){
		// Sanitize action being requested.
		$_action = esc_attr( $_POST['junkie_update_save'] );
	
		if( $_action == 'save' ) {
			$server_file = download_url( esc_url($server_file_url),5000 );
			if ( is_wp_error($server_file) ) {
				$error = esc_html( $server_file->get_error_code() );
				//echo $error;
				if( $error == 'http_no_url') {
				//The source file was not found or is invalid
					echo "<div class='updated' style='margin:10px 10px 0 0'><p>Failed: Invalid URL Provided</p></div>";
				} else {
					echo "<div class='updated' style='margin:10px 10px 0 0'><p>".$error."</p></div>";
				}
				return;
			}
			//Unzip it
			$to = get_template_directory() . "/functions/";
			$dounzip = unzip_file($server_file, $to);
			unlink($server_file); // Delete Temp File
			if ( is_wp_error($dounzip) ){
				//DEBUG
				$error = esc_html( $dounzip->get_error_code() );
				$data = $dounzip->get_error_data($error);

				if($error == 'incompatible_archive'){
					//The source file was not found or is invalid
						echo "<div class='updated' style='margin:10px 10px 0 0'><p>Failed: Incompatible archive</p></div>";
				}
				if($error == 'empty_archive'){
						echo "<div class='updated' style='margin:10px 10px 0 0'><p>Failed: Empty Archive</p></div>";
				}
				if($error == 'mkdir_failed'){
						echo "<div class='updated' style='margin:10px 10px 0 0'><p>Failed: mkdir Failure</p></div>";
				}
				if($error == 'copy_failed'){
						echo "<div class='updated' style='margin:10px 10px 0 0'><p>Failed: Copy Failed</p></div>";
				}
				return;
			}
			echo "<div class='updated' style='margin:10px 10px 0 0'><p>New framework successfully downloaded, extracted and updated.</p></div>";
			remove_action('admin_notices', 'junkie_framework_update_warning');
			//set_transient( 'junkie_framework_version_data', $remoteversion['version'] , 60*60*24*2 );//reset version data
		}
	}else{
	}
}

?>