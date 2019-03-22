<?php
    include_once "common.php";

    $company = $_POST['company'];
    
    $sql = "select * from `account` where `company` = '$company'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    

    if ($company == $row['company']) {
        alert_go_to("등록 되어 있는 업체 입니다.", "index.php");
    }

    $reg_date = date("Y-m-d h:i:s");

    /* 거래처 등록 */
    $sql = "insert into `account` set  
        `company` = '$company',
        `phone_number` = '$phone_number',
        `mutual` = '$mutual',
        `registration_number` = '$registration_number',
        `ceo_name` = '$ceo_name',
        `business_address` = '$business_address',
        `business_conditions` = '$business_conditions',
        `company_stock` = '$company_stock',
        `product` = '$product',
        `email` = '$email',        
        `account_holder` = '$account_holder',        
        `expected_date` = '$expected_date',
        `unit_price` = '$unit_price',
        `reg_date` = '".$reg_date."'
     ";
    mysql_query($sql);
 


  alert_go_to("등록 되었습니다.", "index.php");
?>