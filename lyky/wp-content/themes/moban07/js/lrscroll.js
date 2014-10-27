(function($){$.fn.jCarouselLite=function(o){o=$.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,auto:null,speed:1000,easing:null,vertical:false,circular:true,visible:3,start:0,scroll:3,beforeStart:null,afterEnd:null},o||{});return this.each(function(){var b=false,animCss=o.vertical?"top":"left",sizeCss=o.vertical?"height":"width";var c=$(this),ul=$("ul",c),tLi=$("li",ul),tl=tLi.size(),v=o.visible;if(o.circular){ul.prepend(tLi.slice(tl-v-1+1).clone()).append(tLi.slice(0,v).clone());o.start+=v}var f=$("li",ul),itemLength=f.size(),curr=o.start;c.css("visibility","visible");f.css({overflow:"hidden",float:o.vertical?"none":"left"});ul.css({margin:"0",padding:"0",position:"relative","list-style-type":"none","z-index":"1"});c.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var g=o.vertical?height(f):width(f);var h=g*itemLength;var j=g*v;f.css({width:f.width(),height:f.height()});ul.css(sizeCss,h+"px").css(animCss,-(curr*g));c.css(sizeCss,j+"px");if(o.btnPrev)$(o.btnPrev).click(function(){return go(curr-o.scroll)});if(o.btnNext)$(o.btnNext).click(function(){return go(curr+o.scroll)});if(o.btnGo)$.each(o.btnGo,function(i,a){$(a).click(function(){return go(o.circular?o.visible+i:i)})});if(o.mouseWheel&&c.mousewheel)c.mousewheel(function(e,d){return d>0?go(curr-o.scroll):go(curr+o.scroll)});if(o.auto)setInterval(function(){go(curr+o.scroll)},o.auto+o.speed);function vis(){return f.slice(curr).slice(0,v)};function go(a){if(!b){if(o.beforeStart)o.beforeStart.call(this,vis());if(o.circular){if(a<=o.start-v-1){ul.css(animCss,-((itemLength-(v*2))*g)+"px");curr=a==o.start-v-1?itemLength-(v*2)-1:itemLength-(v*2)-o.scroll}else if(a>=itemLength-v+1){ul.css(animCss,-((v)*g)+"px");curr=a==itemLength-v+1?v+1:v+o.scroll}else curr=a}else{if(a<0||a>itemLength-v)return;else curr=a}b=true;ul.animate(animCss=="left"?{left:-(curr*g)}:{top:-(curr*g)},o.speed,o.easing,function(){if(o.afterEnd)o.afterEnd.call(this,vis());b=false});if(!o.circular){$(o.btnPrev+","+o.btnNext).removeClass("disabled");$((curr-o.scroll<0&&o.btnPrev)||(curr+o.scroll>itemLength-v&&o.btnNext)||[]).addClass("disabled")}}return false}})};function css(a,b){return parseInt($.css(a[0],b))||0};function width(a){return a[0].offsetWidth+css(a,'marginLeft')+css(a,'marginRight')};function height(a){return a[0].offsetHeight+css(a,'marginTop')+css(a,'marginBottom')}})(jQuery);


$(function() {
$("#botton-scroll").jCarouselLite({
btnNext: ".next",
btnPrev: ".prev"
});
});

$(function () {
$('#top-menu li').hover(
function () {$('ul', this).slideDown(200);}, 
function () {$('ul', this).slideUp(200);
});
});

$(function () {
$(".click").click(function(){
$("#panel").slideToggle("slow");
$(this).toggleClass("active"); return false;
}); 
});

$(function () {
$('.fade').hover(
function() {$(this).fadeTo("slow", 0.5);},
function() {$(this).fadeTo("slow", 5);
});
});















(function($){
		$.fn.extend({
			Scroll:function(opt,callback){
					//参数初始化
					if(!opt) var opt={};
					var _btnUp = $("#"+ opt.up);//Shawphy:向上按钮
					var _btnDown = $("#"+ opt.down);//Shawphy:向下按钮
					var timerID;
					var _this=this.eq(0).find("ul:first");
					var     lineH=_this.find("li:first").height(), //获取行高
							line=opt.line?parseInt(opt.line,10):parseInt(this.height()/lineH,10), //每次滚动的行数，默认为一屏，即父容器高度
							speed=opt.speed?parseInt(opt.speed,10):800; //卷动速度，数值越大，速度越慢（毫秒）
							timer=opt.timer?parseInt(opt.timer,10):80000; //滚动的时间间隔（毫秒）
					if(line==0) line=1;
					var upHeight=0-line*lineH;
					//滚动函数
					var scrollUp=function(){
							_btnUp.unbind("click",scrollUp); //Shawphy:取消向上按钮的函数绑定
							_this.animate({
									marginTop:upHeight
							},speed,function(){
									for(i=1;i<=line;i++){
											_this.find("li:first").appendTo(_this);
									}
									_this.css({marginTop:0});
									_btnUp.bind("click",scrollUp); //Shawphy:绑定向上按钮的点击事件
							});
	
					}
					//Shawphy:向下翻页函数
					var scrollDown=function(){
							_btnDown.unbind("click",scrollDown);
							for(i=1;i<=line;i++){
									_this.find("li:last").show().prependTo(_this);
							}
							_this.css({marginTop:upHeight});
							_this.animate({
									marginTop:0
							},speed,function(){
									_btnDown.bind("click",scrollDown);
							});
					}
				   //Shawphy:自动播放
					var autoPlay = function(){
							if(timer)timerID = window.setInterval(scrollUp,timer);
					};
					var autoStop = function(){
							if(timer)window.clearInterval(timerID);
					};
					 //鼠标事件绑定
					_this.hover(autoStop,autoPlay).mouseout();
					_btnUp.css("cursor","pointer").click( scrollUp ).hover(autoStop,autoPlay);//Shawphy:向上向下鼠标事件绑定
					_btnDown.css("cursor","pointer").click( scrollDown ).hover(autoStop,autoPlay);
	
			}      
		})
	})(jQuery);
	
	$(document).ready(function(){
		$("#s3").Scroll({line:1,speed:500,timer:5000,up:"btn1",down:"btn2"});
	});