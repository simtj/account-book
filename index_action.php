<?
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

    /* 결산 관리 */
     $sql = "insert into `closing_account` set  
        `company` = '$company',
        `unit_price` = '$unit_price',
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


    /* 월별 입력 */
    $_company = get_company("company", $company); 

    $year = date("Y");
    $month = date("n");
    $day = date("j");
    $reg_date = date("Y-m-d h:i:s");    

    $sql = "insert into `wolbyeol` set 
        `company_idx` = '".$_company['idx']."',
        `company` = '".$_company['company']."',
        `year` = '".$year."',
        `month` = '".$month."',
        `day` = '".$day."',
        `unit_price` = '".$_company['unit_price']."',
        `breakfast` = '0',
        `lunch` = '0',
        `dinner` = '0',
        `snack` = '0',
        `special` = '0',
        `special_price` = '0',
        `total_conut` = '0',
        `total_price` = '0',
        `reg_date` = '".$reg_date."'
    ";
    mysql_query($sql);    


  alert_go_to("등록 되었습니다.", "index.php");
?>