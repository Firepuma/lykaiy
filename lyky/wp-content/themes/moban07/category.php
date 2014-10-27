<?php
if ( is_category('company-news') ) {
include(TEMPLATEPATH . '/category-news.php');
}
// elseif 在一次判断 想在加判断复制代码
elseif ( is_category('company-news1') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news2') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news3') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news4') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news5') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news6') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news7') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news8') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news9') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
elseif ( is_category('company-news10') ) { // plugin 为category的别名
include(TEMPLATEPATH . '/category-news.php');
}
// elseif 结束
else {
include(TEMPLATEPATH . '/category-all.php');
}
?>


