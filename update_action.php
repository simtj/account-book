<?php
    include_once "common.php";

    $company = $_POST['company'];
    
    $sql = "update `account` set  
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
        `unit_price` = '$unit_price'
        where idx = '$idx'
     ";
     mysql_query($sql);

     $sql = "update `closing_account` set  
     `unit_price` = '$unit_price'
     where `company` = '$company'";
     mysql_query($sql);


    alert_go_to("수정 되었습니다.", "index.php");
?>