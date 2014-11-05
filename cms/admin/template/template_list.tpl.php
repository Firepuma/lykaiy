<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '模板管理';
</script>
<div class="subnav">
	<div class="content-menu">
		<a href="<?php echo url('template/add', array('dir'=>$dir))?>"  class="add"><em>添加模板</em></a>
		<a href="<?php echo url('template/index')?>" class="on"><em>模板管理</em></a>
		<a href="<?php echo url('template/cache')?>"  class="on"><em>更新缓存</em></a>
	</div>
	<div class="bk10"></div>
        <form action="<?php echo url('template/updatefilename')?>" method="post">
		<table width="100%"  class="m-table m-table-row">
		<thead class="m-table-thead s-table-thead">
                    <tr>
                        <th align="left" >文件</th>
                        <th align="left" >备注</th>
                        <th align="left" >操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td align="left" colspan="3">当前位置：<?php echo $local?></td>
                    </tr>
                    <?php if ($dir !='' ):?>
                        <tr>
                            <td align="left" colspan="3"><a href="<?php if (urldecode(dirname($dir)) =='.')  echo url('template') ; else echo url('template', array('dir'=>urldecode(dirname($dir).DIRECTORY_SEPARATOR))) ;?>" >
							<img src="./img/folder-closed.gif" />返回上一层目录</a></td>
                        </tr>
                    <?php endif;?>

					
					<?php
                    if(is_array($list)):

     					foreach($list as $v):
                            $filename = basename($v);
							if (is_dir($v))
                            echo '<tr><td align="left"><img src="./img/folder-closed.gif" /> <a href="?c=template&dir='.urldecode($dir.$filename.DIRECTORY_SEPARATOR).'">'.$filename.'</a></td><td align="left"><input type="text" class="input-text" name="file_explan['.$encode_local.']['.$filename.']" value="'.(isset($file_explan[$encode_local][$filename]) ? $file_explan[$encode_local][$filename] : "").'"></td><td></td> </tr>';
                        endforeach;

                        foreach($list as $v):
                            $filename = basename($v);
							
							if (!is_dir($v)){
                            echo '<tr><td align="left"><img src="./img/file.gif" /> '.$filename.'</td><td align="left"><input type="text" class="input-text" name="file_explan['.$encode_local.']['.$filename.']" value="'.(isset($file_explan[$encode_local][$filename]) ? $file_explan[$encode_local][$filename] : "").'"></td>';
							
							$ext  = fileext($filename);
							if (in_array($ext, array('html', 'css', 'js'))) 
							echo '<td> <a href="?c=template&a=edit&dir='.urldecode($dir).'&file='.urldecode($filename).'">[编辑]</a> </td></tr>';
							else
							echo '<td></td></tr>';
							}
							
                        endforeach;
						
                    endif;
                    ?>
                    <tr>
                    <td colspan="3" align="left" style="border-bottom:0px;"><input type="submit" class="button" name="dosubmit" value="更新备注" ></td>
                    </tr>
					</tbody>
                </table>
            </form>

	<div class="bk10"></div>
</div>
</body>
</html>