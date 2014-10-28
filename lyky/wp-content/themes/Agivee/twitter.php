                <h3 class="twitter_icon"><?php echo ($titletwitter) ? $titletwitter: __('Twitter Update..!!','agivee');?></h3>
                <div id="twitter_update_list">
                <?php 
                $twitter_id = get_option('agivee_twitter_id');
                $twitter_num = ($twitternum) ? $twitternum : 2;
                ?>
                <script src="http://twitter.com/javascripts/blogger.js" type="text/javascript"></script>
                <script src="http://twitter.com/statuses/user_timeline/<?php echo $twitter_id;?>.json?callback=twitterCallback2&amp;count=<?php echo $twitter_num;?>" type="text/javascript"></script>      
                </div>          
