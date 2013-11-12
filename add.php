<?php 
require_once ('header.php');
?>

<div class="span1"></div>
<div class="span8">
<form action="./action.php?type=add" method="post" enctype="multipart/form-data">
<p>有什么想说的:-)<small class="pull-right muted"> 说了也不会帮你保存</small></p>
<textarea  name="content" style="width:98%" rows="3"></textarea>
<input  type="file" name="file1">
<input type="submit" class="btn btn-primary  pull-right" value="上传！">
</div>

</form>

<?php require_once('footer.php')?>
