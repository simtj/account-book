<?
    include_once "common.php";

    $sql = "select * from `account` where `idx` = '$idx'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
   
    $company = $row['company'];


    $sql = "delete from `account` where company = '$company'";
    mysql_query($sql);

    $sql = "delete from `closing_account` where company = '$company'";
    mysql_query($sql);    
    
    alert_go_to("삭제 되었습니다.", "index.php");
?>