(function($) {

$(function() {

$(document).ready(function () {

$('#nav li').hover(

function () {

//显示二级菜单，括号中的数字表示下拉菜单完全显示出来需要200毫秒。

$('ul'， this).slideDown(200);

},

function () {

//隐藏二级菜单

$('ul', this).slideUp(150);

}

);

);

});

})(jQuery);