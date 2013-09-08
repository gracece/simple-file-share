<?php
require_once('./functions.php');
$type = safeGet('type');
$from = safeGet('from');
if($type == "add")
{
    if($_FILES['file1']['error']>0)
    {
        echo "ERROR!";
        echo $_FILES['file1']['error'];
        exit;
    }

    $newFileName = time().$_FILES['file1']['name'];
    $upfile = "./".UPLOAD_DIR."/".$newFileName;
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

?>
