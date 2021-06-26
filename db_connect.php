<?php
    header("Content-Type:text/html; charset=utf-8");
    $serverName="LAPTOP-59N7GD2S\SQLEXPRESS";
    $connectionInfo=array("Database"=>"BUSINESS_408530036","UID"=>"CCU","PWD"=>"12345678","CharacterSet" => "UTF-8");
    $conn=sqlsrv_connect($serverName,$connectionInfo);
        if($conn){
            //echo "Connect Success!!!<br/><br/>";
        }else{
            //echo "Connect Error!!!<br/><br/>";
            die("sql error".sqlsrv_errors());
        }            
?>