<?php
require_once ('header.php');
$type = safeGet('type');
$from = safeGet('from');
if($type == "add")
{
    if ($_POST['content'] != PASSWORD)
    {
        echo "Wrong password!";
        exit;
    }
    if($_FILES['file1']['error']>0)
    {
        echo "ERROR!";
        echo $_FILES['file1']['error'];
        exit;
    }

    $newFileName = $_FILES['file1']['name'];
    $upfile = "./".SHARE_DIR."/".$newFileName;
    echo $upfile;
    if(is_uploaded_file($_FILES['file1']['tmp_name']))
    {
        if(!move_uploaded_file($_FILES['file1']['tmp_name'],$upfile))
        {
            echo "could not move!";
            exit;
        }
    }
    echo "success";
}

require_once ('footer.php');
?>
