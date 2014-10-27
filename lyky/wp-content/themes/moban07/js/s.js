$(document).ready(function () {
//Append a div with hover class to all the LI

$('.sycp').hover(
//Mouseover, fadeIn the hidden hover class
function() {
$(this).children('.week_bok').stop(true, true).fadeIn('1000');
},
//Mouseout, fadeOut the hover class
function() {
$(this).children('.week_bok').stop(true, true).fadeOut('1000');
}).click (function () {
//Add selected class if user clicked on it
$(this).addClass('selected');
});
});




$(document).ready(function () {
//Append a div with hover class to all the LI

$('.e1_1').hover(
//Mouseover, fadeIn the hidden hover class
function() {
$(this).children('.e1_2').stop(true, true).fadeIn('1000');
},
//Mouseout, fadeOut the hover class
function() {
$(this).children('.e1_2').stop(true, true).fadeOut('1000');
}).click (function () {
//Add selected class if user clicked on it
$(this).addClass('selected');
});
});