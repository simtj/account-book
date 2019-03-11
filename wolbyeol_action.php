<?
    include_once "common.php";


    if ($breakfast) { if (!is_numeric($breakfast)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($lunch) { if (!is_numeric($lunch)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($dinner) { if (!is_numeric($dinner)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($snack) { if (!is_numeric($snack)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($special) { if (!is_numeric($special)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($special_price) { if (!is_numeric($special_price)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    

    if ($mode == "w") {

        if (!is_numeric($company)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); }
        $_company = get_company("idx", $company);        


        $year = empty($_POST['year']) ? date("Y") : $_POST['year'] ;
        $month = empty($_POST['month']) ? date("n") : $_POST['month'] ;
        $day = empty($_POST['day']) ? date("d") : $_POST['day'] ;

        $reg_date = date("Y-m-d h:i:s");

        $total_conut = $breakfast + $lunch + $dinner + $snack + $special;
        $total_price = (($breakfast + $lunch + $dinner + $snack) * $_company['unit_price']) + ($special * $special_price);

        $sql = "insert into `wolbyeol` set 
        `company_idx` = '".$_company['idx']."',
        `company` = '".$_company['company']."',
        `year` = '".$year."',
        `month` = '".$month."',
        `day` = '".$day."',
        `unit_price` = '".$_company['unit_price']."',
        `breakfast` = '".$breakfast."',
        `lunch` = '".$lunch."',
        `dinner` = '".$dinner."',
        `snack` = '".$snack."',
        `special` = '".$special."',
        `special_price` = '".$special_price."',
        `total_conut` = '".$total_conut."',
        `total_price` = '".$total_price."',
        `reg_date` = '".$reg_date."'
        ";

        mysql_query($sql);

        alert_go_to("등록 되었습니다.", "wolbyeol_list.php");

    } else if ($mode == "u") {

        $_company = get_company("idx", $company_idx);

        $total_conut = $breakfast + $lunch + $dinner + $snack + $special;
        $total_price = (($breakfast + $lunch + $dinner + $snack) * $_company['unit_price']) + ($special * $special_price);
 
        $sql = "update `wolbyeol` set  
        `unit_price` = '".$_company['unit_price']."',
        `breakfast` = '".$breakfast."',
        `lunch` = '".$lunch."',
        `dinner` = '".$dinner."',
        `snack` = '".$snack."',
        `special` = '".$special."',
        `special_price` = '".$special_price."',
        `total_conut` = '".$total_conut."',
        `total_price` = '".$total_price."'
        where idx = '$idx'
        ";

        mysql_query($sql);

        alert_go_to("수정 되었습니다.", "wolbyeol_list.php");

    }

?>