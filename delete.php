<?
    include_once "common.php";

   
    $sql = "delete from `account` where idx = '$idx'";
    mysql_query($sql);

    $sql = "delete from `closing_account` where idx = '$idx'";
    mysql_query($sql);    
    


    Header("Location:index.php"); 
?>