<?php
// Translations can be filed in the /languages/ directory
//load_theme_textdomain( 'junkie', TEMPLATEPATH . '/languages' );	

$themename = wp_get_theme()->Name;
$shortname = strtolower(wp_get_theme()->Name);

load_theme_textdomain( 'junkie', get_template_directory() . '/languages' );

require_once('includes/sidebar-init.php');
require_once('includes/custom-functions.php');
require_once('includes/post-thumbnails.php');
require_once('includes/theme-options.php');
require_once('includes/theme-widgets.php');
//require_once('includes/theme-comments.php');
require_once('functions/theme_functions.php');
require_once('functions/admin_functions.php');

require_once('includes/theme-posttypes.php');

require_once('includes/meta-portfolio-items.php');
require_once('includes/meta-mini-features.php');
require_once('includes/meta-testimonials.php');

require_once('includes/get-plugins.php');

?>
