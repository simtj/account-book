<?
    include_once "common.php";

    $company = $_POST['company'];
    
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
        `unit_price` = '$unit_price'
     ";

     mysql_query($sql);

     $sql = "insert into `closing_account` set  
     `company` = '$company',
     `unit_price` = '0',
     `accounts_receivable` = '0',
     `sales` = '0',
     `supply_value` = '0',
     `tax_amount` = '0',
     `bill_amount` = '0',
     `accounts_alloy` = '0',
     `deposit` = '0',
     `deposit_date` = '-'
  ";

  mysql_query($sql);


    Header("Location:index.php"); 
?>