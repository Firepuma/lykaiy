   <div class="up">
                    <b class="bt">网站关键字填写（中文）</b>
                    <textarea name="keywords" cols="86" rows="3" id="keywords"><?php echo get_option('mytheme_keywords'); ?></textarea>   
                    <p>请填写网站的关键字，使用“ , ”分开，一个网站的关键字一般不超过100个字符。</p>
                </div>   
                
                 <div class="up">
                    <b class="bt">网站描述填写（中文）</b>
                    <textarea name="description" cols="86" rows="3" id="description"><?php echo get_option('mytheme_description'); ?></textarea>    
                    <p>请填写网站的描述，使用,分开，一个网站的描述一般不超过200个字符。</p>
                </div>   
                   

                      <div class="up">    
                    <b class="bt">网站统计代码添加</b>
                    <textarea name="analytics" cols="86" rows="4" id="analytics"><?php echo stripslashes(get_option('mytheme_analytics')); ?></textarea>    
                 
                 <a href="http://www.themepark.com.cn/wordpresswzseohj.html">网站的seo应该如何去做？ 我们给你一些文章作为参考</a>
  </div>  

  <div class="xiaot">
          
           <b class="bt">地图设置</b><br />
         <label  for="jdt1">地图名称：</label>
          <input type="text" size="40"  name="ditu_tit" id="ditu_tit" value="<?php echo get_option('mytheme_ditu_tit'); ?>"/>  <br />
 
          
          <label  for="jdt1">具体地址：</label>
          <input type="text" size="40"  name="ditu_cont" id="ditu_cont" value="<?php echo get_option('mytheme_ditu_cont'); ?>"/>  <br />
 
          
           <label  for="jdt1">坐标经度：</label>
          <input type="text" size="40"  name="ditu_zuob" id="ditu_zuob" value="<?php echo get_option('mytheme_ditu_zuob'); ?>"/> <br />  
           <label  for="jdt1">坐标纬度：</label>
          <input type="text" size="40"  name="ditu_zuob3" id="ditu_zuob3" value="<?php echo get_option('mytheme_ditu_zuob'); ?>"/>   <br />
           
           	<em style=" width:75%; float:left; margin-top:10px;">默认为天安门地图，坐标获得方法：
                 <br /> 1.点击进入<A href="http://api.map.baidu.com/lbsapi/creatmap/index.html">百度地图制作</A><br />2.点击侧边栏”定位中心点“，找到公司所在位置
               <br /> 3.点击“添加标注”，在地图上标注公司具体位置<br />
              <br />  4.点击下方”获取代码“，弹出对话框，在对话框找到定位点的经纬度:
              <br /> 找到title:"我的标记",content:"我的备注",point:"112.999439|28.174223"  （注意 这里是没有填写标注公司信息的时候显示的“我的标记”填写了之后就是你填写的名称，point后面的数字 前面的是经度，后面的是纬度，填写在上面的坐标即可！
                
            <br /> <br /><br /><br />   [ point: "<a style="color:#F00"> 113.004137|28.172525</a> "]红色数字为经纬度坐标。找到坐标后按照正确格式输入即可。
            <br />如有疑问，请查看附带说明，或者去主题公园查看视频教程。
            
                </em>
</div>
   