
jQuery(document).ready(function($) {
$('#nav li').hover(function() {
$('ul', this).slideDown(300)
},
function() {
$('ul', this).slideUp(300)
});
});

