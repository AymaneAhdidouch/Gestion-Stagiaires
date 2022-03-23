<?php

    ///////////////////////////////////////////////////
    //Create The Table That Contains all The Trainee//
    /////////////////////////////////////////////////

    function CreateTable(){
        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if(isset($t[0]) && isset($t[1]) && isset($t[2]) && isset($t[3])){
                    echo "<tr><td>$t[0]</td><td>$t[1]</td><td>$t[2]</td><td>$t[3]</td></tr>";
                }
            }
            echo "</table>";
            fclose($f);
        }
    }

    ///////////////////////////
    //Select The Trainee//////
    /////////////////////////


    function BySelector($opt){
        $option = $opt;
        if($option == 'All'){
            CreateTable();
        }
        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if(isset($t[0]) && isset($t[1]) && isset($t[2]) && isset($t[3])){
                    if($t[3] == $option && $option != 'All'){
                        echo "<tr><td>$t[0]</td><td>$t[1]</td><td>$t[2]</td><td>$t[3]</td></tr>";
                    }
                }
            }
            fclose($f);
            echo '</table>';
        }

    }


    // function BySelector(){
    //     $option = $_POST['lisT'];
    //     if(file_exists('STG.txt') && $option == 'All'){
    //         $f = fopen('STG.txt', 'r');
    //         while(!feof($f)){
    //             $line = fgets($f);
    //             $t = explode('-', $line);
    //             if(isset($t[0]) && isset($t[1]) && isset($t[2]) && isset($t[3])){
    //                 echo "<tr><td>$t[0]</td><td>$t[1]</td><td>$t[2]</td><td>$t[3]</td></tr>";
    //             }
    //         }
    //         echo "</table>";
    //         fclose($f);
    //     }elseif(file_exists('TDI.txt') && $option == 'TDI'){
    //         $f = fopen('TDI.txt', 'r');
    //         while(!feof($f)){
    //             $line = fgets($f);
    //             $t = explode('-', $line);
    //             if(isset($t[0]) && isset($t[1]) && isset($t[2]) && isset($t[3])){
    //                 echo "<tr><td>$t[0]</td><td>$t[1]</td><td>$t[2]</td><td>$t[3]</td></tr>";
    //             }
    //         }
    //         echo "</table>";
    //         fclose($f);
    //     }
    // }

    //////////////////////////////////////////////////////////////////////////////////
    //Copy The trainee With The division 'TDI' Into a New file called 'TDI.txt'...///
    /////////////////////////////////////////////////////////////////////////////////

    function CopyIntoTDI(){
        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            $nf = fopen('TDI.txt', 'w');
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if(!empty($t[3])){
                    if($t[3] == 'TDI'){
                        $str = $t[0].'-'.$t[1].'-'.$t[2].'-'.$t[3].'-'."\n";
                        fwrite($nf, $str);
                    }
                }
            }
        }
        fclose($f);
    }
    /////////////////////////////////////////////////
    //Delete the Trainee from the File STG.txt...///
    ///////////////////////////////////////////////

    function DeleteFromSTG($deleteNb){
        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            $lines = array();
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if($t[0] != $deleteNb){
                    array_push($lines, $line);
                }
            }
            fclose($f);

            $nf = fopen('DELE.txt', 'w');
            foreach($lines as $linne){
                fwrite($nf, $linne);
            }
            fclose($nf);

            $newf = fopen('STG.txt', 'w');
            $nf = fopen('DELE.txt', 'r');
            while(!feof($nf)){
                $lline = fgets($nf);
                fwrite($newf, $lline);
            }
        }
    }

    /////////////////////////////
    ///Search For a Trainee...///
    ////////////////////////////

    function Search($searchNb){
        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if($t[0] == $searchNb){
                    echo "<tr><td>$t[0]</td><td>$t[1]</td><td>$t[2]</td><td>$t[3]</td></tr></table>";
                    exit();
                }
            }
            echo "<div class='alert alert-danger mt-2 mb-2'>";
            echo "The Number Does not Exist! Enter another Number";
            echo "</div>";
        }
    }
    
    /////////////////////////
    //Modify Information ///
    ///////////////////////

    function Modify($connb, $nnom, $nem, $ndiv){

        $confirmNb = $connb;
        $newName = $nnom;
        $newEmail = $nem;
        $newDivision = $ndiv;

        if(file_exists('STG.txt')){
            $f = fopen('STG.txt', 'r');
            while(!feof($f)){
                $line = fgets($f);
                $t = explode('-', $line);
                if(isset($t[0])){
                    if($t[0] == $confirmNb){
                        $exist = true;
                        $f = fopen('STG.txt', 'a');
                        DeleteFromSTG($confirmNb);
                        CopyIntoTDI();
                        $str = $confirmNb."-".$newName."-".$newEmail."-".$newDivision.'-'."\n";
                        fwrite($f, $str);
                        CopyIntoTDI();
                        header('location: index.php?modify=true');
                    }
                }    
            }
        }
        header('location: index.php?modify=false');
    }


    function alertExist(){
        echo "<div class='alert alert-success mt-2 mb-2'>";
        echo "Edited Successfully!";
        echo "</div>";
    }

    function alertNotExist(){
        echo "<div class='alert alert-danger mt-2 mb-2'>";
        echo "The Number Does not Exist! Enter another Number";
        echo "</div>";
    }

?>