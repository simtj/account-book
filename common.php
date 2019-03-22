<?php
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
extract($_REQUEST,EXTR_SKIP);

$connect_db = mysql_connect('aa1upliolz4efvr.cjrgj1si50gz.ap-northeast-2.rds.amazonaws.com','root','test1234');
mysql_select_db('ebdb',$connect_db);
mysql_query('SET NAMES UTF8');


function alert_go_to($msg, $redirect) {
    if ($msg) {
        $alert = "alert('".$msg."');";
    }

    if ($redirect) {
        $url = "location.href='".$redirect."';";
    }

    $heredoc = <<< HERE
    <script type="text/javascript">
        $alert
        $url
    </script>
HERE;

    echo $heredoc;

}

function printr($arr) {
    if (is_array($arr)) {
        echo "<xmp>";
        print_r($arr);
        echo "</xmp>";
    }

    return false;
}

function all_company($field = "", $value = "", $inequality = "=") {
    $where = "";

    if ($field != "") {
        $where = "and `".$field."` ".$inequality." '".$value."'";
    }

    $sql = "select * from account where 1=1 ".$where." order by idx desc";
    $result = mysql_query($sql);
    

    while ($row = mysql_fetch_array($result)) {
        if ($row) {
            $rows[] = $row;
        }
    }
    
    if (isset($rows)) {
        return $rows;
    }
}


function get_company($field, $value) {
    $sql = "select * from `account` where `".$field."` = '".$value."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    return $row;
}

function wolbyeol_find($company_idx, $year, $month) {
    $sql = "select * from `wolbyeol` where `company_idx`='".$company_idx."' and `year`='".$year."' and `month`='".$month."' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    if (is_array($row)) {
        return true;
    } else {
        return false;
    }
}

function gyeolsan_find($company_idx, $year, $month) {
    $sql = "select * from `gyeolsan` where `company_idx`='".$company_idx."' and `year`='".$year."' and `month`='".$month."' ";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    if (is_array($row)) {
        return true;
    } else {
        return false;
    }    
}


function wolbyeol_total($company_idx, $year, $month) {
    $sql = "select * from `ilbyeol` where `company_idx`='".$company_idx."' and `year`='".$year."' and `month`='".$month."' ";
    $result = mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
        $rows['company_idx'] = $row['company_idx'];
        $rows['company'] = $row['company'];
        $rows['unit_price'] = $row['unit_price'];
        $rows['year'] = $row['year'];
        $rows['month'] = $row['month'];
        $rows['breakfast'] +=  $row['breakfast'];
        $rows['lunch'] +=  $row['lunch'];
        $rows['dinner'] +=  $row['dinner'];
        $rows['snack'] +=  $row['snack'];
        $rows['special'] +=  $row['special'];
        $rows['special_price'] +=  $row['special_price'];
        $rows['total_conut'] +=  $row['total_conut'];
        $rows['total_price'] +=  $row['total_price'];
    }

    return $rows;
}

function set_wolbyeol($company_idx, $year, $month) {
    $reg_date = date("Y-m-d h:i:s");

    $_rows = wolbyeol_total($company_idx, $year, $month);

    if (wolbyeol_find($company_idx, $year, $month) == true) {
        $sql = "update `wolbyeol` set  
            `breakfast` = '".$_rows['breakfast']."',
            `lunch` = '".$_rows['lunch']."',
            `dinner` = '".$_rows['dinner']."',
            `snack` = '".$_rows['snack']."',
            `special` = '".$_rows['special']."',
            `special_price` = '".$_rows['special_price']."',
            `total_conut` = '".$_rows['total_conut']."',
            `total_price` = '".$_rows['total_price']."'
        where company_idx = '".$company_idx."' and year = '".$year."' and month = '".$month."'
        ";
        mysql_query($sql);
    } else {
        $sql = "insert into `wolbyeol` set 
            `company_idx` = '".$_rows['company_idx']."',
            `company` = '".$_rows['company']."',
            `year` = '".$_rows['year']."',
            `month` = '".$_rows['month']."',
            `unit_price` = '".$_rows['unit_price']."',
            `breakfast` = '".$_rows['breakfast']."',
            `lunch` = '".$_rows['lunch']."',
            `dinner` = '".$_rows['dinner']."',
            `snack` = '".$_rows['snack']."',
            `special` = '".$_rows['special']."',
            `special_price` = '".$_rows['special_price']."',
            `total_conut` = '".$_rows['total_conut']."',
            `total_price` = '".$_rows['total_price']."',
            `reg_date` = '".$reg_date."'
        ";
        mysql_query($sql);
    }    
}

function set_gyeolsan($company_idx, $year, $month) {
    $_company = all_company("idx", $company_idx);

    $sql = "select * from `ilbyeol` where company_idx='".$company_idx."' and year='".$year."' and month='".$month."' ";   
    $result = mysql_query($sql);
    
    while ($row = mysql_fetch_array($result)) {
        if (is_array($row)) {
            $total_breakfast += ($row['breakfast']) ? $row['breakfast'] : 0;
            $total_lunch += ($row['lunch']) ? $row['lunch'] : 0;
            $total_dinner += ($row['dinner']) ? $row['dinner'] : 0;
            $total_snack += ($row['snack']) ? $row['snack'] : 0;
            $total_special += ($row['special']) ? $row['special'] : 0;
            $total_special_price += ($row['special_price']) ? $row['special_price'] : 0;
            
        } else {
            $total_breakfast = 0;
            $total_lunch = 0;
            $total_dinner = 0;
            $total_snack = 0;
            $total_special = 0;
            $total_special_price = 0;
        }        
    }
 
    $sales = ($_company[0]['unit_price']*$total_breakfast)
            +($_company[0]['unit_price']*$total_lunch)
            +($_company[0]['unit_price']*$total_dinner)
            +($_company[0]['unit_price']*$total_snack);
            
    $supply_value = floor($sales / 1.1);
    $tax_amount = $sales - $supply_value;
    
    if (gyeolsan_find($company_idx, $year, $month) == true) {
        $sql = "update `gyeolsan` set 
            `sales` = '".$sales."',
            `supply_value` = '".$supply_value."',
            `tax_amount` = '".$tax_amount."'
        where company_idx = '".$company_idx."' and year = '".$year."' and month = '".$month."'
        ";
        mysql_query($sql);
    } else {
        $sql = "insert into `gyeolsan` set 
            `company_idx` = '".$company_idx."',
            `company` = '".$_company[0]['company']."',
            `year` = '".$year."',
            `month` = '".$month."',
            `unit_price` = '".$_company[0]['unit_price']."',        
            `sales` = '".$sales."',
            `supply_value` = '".$supply_value."',
            `tax_amount` = '".$tax_amount."'
        ";
        mysql_query($sql);
    }
}

?>