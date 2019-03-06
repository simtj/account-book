<?
    include_once "common.php";

    //$breakfas = "fasdf";
    if (!is_numeric($company)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); }
    if ($breakfast) { if (!is_numeric($breakfast)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($lunch) { if (!is_numeric($lunch)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($dinner) { if (!is_numeric($dinner)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($snack) { if (!is_numeric($snack)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($special) { if (!is_numeric($special)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    if ($special_price) { if (!is_numeric($special_price)) { alert_go_to("숫자를 입력하세요.", "wolbyeol_list.php"); } }
    

    $_company = get_company("idx", $company);

    if ($mode == "w") {
        
    
    }




    exit;
?>