<?php
if ( in_category('company-news') ) {
include(TEMPLATEPATH . '/single-news.php');
}
elseif ( in_category('company-product') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/single-product.php');
}
// elseif 结束
else {
include(TEMPLATEPATH . '/single-all.php');
}
?>