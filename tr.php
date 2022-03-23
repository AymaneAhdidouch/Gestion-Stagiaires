<?php
include 'function.php';

if (isset($_POST['name']) and  isset($_POST['number']) and isset($_POST['email']) and isset($_POST['listDivision'])) {
    
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $division = $_POST['listDivision'];

    if(!empty($name) && !empty($number) && !empty($email) && !empty($division)){
        $found = false;
        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if($t[0] == $number){
                    $found = true;
                    header('location: index.php?found=$found');
                }
            }
        }
        if(!$found){
            $f = fopen('STG.txt', 'a');
            $str = $number."-".$name."-".$email."-".$division.'-'."\n";
            fwrite($f, $str);
            fclose($f);
        }
    }
    CopyIntoTDI();
 
}

if(isset($_POST['delete-nb'])){
    $deleteNb = $_POST['delete-nb'];
    DeleteFromSTG($deleteNb);
    CopyIntoTDI();
}

if(isset($_POST['confirm-nb']) && isset($_POST['new-name']) && isset($_POST['new-email']) && isset($_POST['new-division'])){
    Modify($_POST['confirm-nb'], $_POST['new-name'], $_POST['new-email'], $_POST['new-division']);
}

header('location: index.php')
?>