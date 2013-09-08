<?php
require_once('./config.php');


error_reporting(E_ALL);
date_default_timezone_set('PRC');

function get_user_ip() {
    if(isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] !='unknown')
    { $ip = $_SERVER['HTTP_CLIENT_IP'];}
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']!='unknown')
    {$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}
    else{ $ip = $_SERVER['REMOTE_ADDR']; }
    return $ip;
}


function safePost($str)
{
    $val = !empty($_POST["$str"]) ? $_POST["$str"]:null;
    $val = htmlentities($val,ENT_QUOTES,"UTF-8");
    if(!get_magic_quotes_gpc())
        $val = addslashes($val);
    return $val;
}

function safeGet($str)
{
    $val = !empty($_GET["$str"]) ? $_GET["$str"]:null;
    if(!get_magic_quotes_gpc())
    {
        $val = addslashes($val);
    }
    return $val;
}


function sortFileByDate($dir)
{
  if(is_dir($dir))
  {
    $scanArray=scandir($dir);
    $finalArray = array();
    for($i=0; $i<count($scanArray);$i++)
    {
      if($scanArray[$i]!="."&&$scanArray[$i]!="..")
      {
        $finalArray[$scanArray[$i]]=filectime($dir."/".$scanArray[$i]); 
      }
    }
    arsort($finalArray);
    return($finalArray);
    //返回数组，key为文件名，value为文件时间
  }
  else 
    echo "sorry,".$dir."is not a dir";

}


function ListFiles($Spath){
  $orginSpath =$Spath;
  echo' <table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th style="text-align:center;">#</th>
    <th>名称(按上传时间排序)</th>
    <th style="width:80px;">文件大小</th>
    <th style="width:90px;" class="hidden-phone">下载时间</th>
    <th style="width:45px;" class="hidden-phone">操作</th>
    </tr>
    </thead>
    <tbody> '; 

  date_default_timezone_set("Asia/Shanghai");
  $sortedPath = sortFileByDate($Spath);
  $index = 0;
  while ($element =each($sortedPath))
  {
    $longPath = "".$Spath."/".$element['key'];
    $size =filesize($longPath)/1024/1024;
    $size = number_format($size,2);
    //两位小数
    $filedownloadtime = $element['value']; 
    $downtime_fomat = date('m/d H:i',$filedownloadtime);
    //格式化显示
    $index++;

    echo '<tr>
      <td style="text-align:center;width:60px;">'.$index.'</td>
      <td><a target="_blank" title="点击下载" href=./'.$Spath.'/'.urlencode($element['key']).'>'.$element['key']."</a></td>
      <td>".$size."MB</td>
      <td class='hidden-phone'>".$downtime_fomat."</td>
      ";
    echo '<td class="hidden-phone">
        <a href="#" class="btn btn-small url"  data-toggle="tooltip" data-placement="left" data-html="true" title="" data-original-title="
        <img src=\'https://chart.googleapis.com/chart?cht=qr&amp;chs=300x300&amp;choe=UTF-8&amp;chld=L|1&amp;chl=http://'.$_SERVER['SERVER_NAME'].'/'.SUB_DIR.'/'.$longPath.'\'>
        ">QR</a>
        </td></tr>';
  }
  echo "</table>";

}

?>
