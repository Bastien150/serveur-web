<?php
    session_start();
    $file = $_POST['filename'];
    $lf = explode("/", $file);
    
if(isset($_POST['home'])){
    unset($_SESSION['fileselect']);
}else if(isset($_POST['back'])){
    if (count($lf) > 1) {
        array_pop($lf);
        $chemin = implode("/", $lf);
        echo $chemin . " " . var_dump($lf);
        $_SESSION['fileselect'] = $chemin;
    }else{
        unset($_SESSION['fileselect']);
    }

}else{
    $fileselect = $_POST['filename'];
    $lastfileselect = $_POST['lastfilename'];
    echo $lastfileselect;
    if($lastfileselect ==''){
        $_SESSION['fileselect'] = $fileselect;
    }else {
        $_SESSION['fileselect'] = $lastfileselect.'/'.$fileselect;
    }
}

header("Location: ./index.php");
exit();