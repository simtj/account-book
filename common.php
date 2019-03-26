<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
extract($_REQUEST,EXTR_SKIP);

if (!empty($_SERVER['RDS_HOSTNAME'])) {
    $dbhost = $_SERVER['RDS_HOSTNAME'];
    $dbport = $_SERVER['RDS_PORT'];
    $dbname = $_SERVER['RDS_DB_NAME'];
    $username = $_SERVER['RDS_USERNAME'];
    $password = $_SERVER['RDS_PASSWORD'];
} else {
    $dbhost = "localhost";
    $dbport = "3306";
    $dbname = "phptest";
    $username = "root";
    $password = "test0";
}


$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset=utf8";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


try {
    $connection = new PDO($dsn, $username, $password,$options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}



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
    global $connection;

    $where = "";

    if ($field != "") {
        $where = "and `".$field."` ".$inequality." :".$field."";
    }

    $sql = "select * from account where 1=1 ".$where." order by idx desc"; 
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':'.$field => $value
    ]);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row) {
            $rows[] = $row;
        }
    }

    if (isset($rows)) {
        return $rows;
    }
}


function get_company($field, $value) {
    global $connection;

    $sql = "select * from account where `".$field."` = :".$field."";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':'.$field => $value
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function wolbyeol_find($company_idx, $year, $month) {
    global $connection;

    $sql = "select * from `wolbyeol` where `company_idx`= :company_idx and `year`= :year and `month`= :month ";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':company_idx' => $company_idx,
        ':year' => $year,
        ':month' => $month
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($row)) {
        return true;
    } else {
        return false;
    }
}

function gyeolsan_find($company_idx, $year, $month) {
    global $connection;

    $sql = "select * from `gyeolsan` where `company_idx`= :company_idx and `year`= :year and `month`= :month ";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':company_idx' => $company_idx,
        ':year' => $year,
        ':month' => $month
    ]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (is_array($row)) {
        return true;
    } else {
        return false;
    }    
}

function wolbyeol_total($company_idx, $year, $month) {
    global $connection;
 
    $sql = "select * from `ilbyeol` where `company_idx`= :company_idx and `year`= :year and `month`= :month ";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':company_idx' => $company_idx,
        ':year' => $year,
        ':month' => $month
    ]);


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
    global $connection;

    $reg_date = date("Y-m-d h:i:s");

    $_rows = wolbyeol_total($company_idx, $year, $month);

    if (wolbyeol_find($company_idx, $year, $month) == true) {

        $sql = "update `wolbyeol` set  
            `breakfast` = :breakfast,
            `lunch` = :lunch,
            `dinner` = :dinner,
            `snack` = :snack,
            `special` = :special,
            `special_price` = :special_price,
            `total_conut` = :total_conut,
            `total_price` = :total_price
        where company_idx = :company_idx and year = :year and month = :month";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':breakfast' => $_rows['breakfast'],
            ':lunch' => $_rows['lunch'],
            ':dinner' => $_rows['dinner'],
            ':snack' => $_rows['snack'],
            ':special' => $_rows['special'],
            ':special_price' => $_rows['special_price'],
            ':total_conut' => $_rows['total_conut'],
            ':total_price' => $_rows['total_price'],
            ':company_idx' => $company_idx,
            ':year' => $year,
            ':month' => $month
        ]);

    } else {

        $sql = "insert into `wolbyeol` set  
            `company_idx` = :company_idx,
            `company` = :company,
            `year` = :year,
            `month` = :month,
            `unit_price` = :unit_price,
            `breakfast` = :breakfast,
            `lunch` = :lunch,
            `dinner` = :dinner,
            `snack` = :snack,
            `special` = :special,
            `special_price` = :special_price,
            `total_conut` = :total_conut,
            `total_price` = :total_price,
            `reg_date` = :reg_date
        ";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':company_idx' => $_rows['company_idx'],
            ':company' => $_rows['company'],
            ':year' => $_rows['year'],
            ':month' => $_rows['month'],
            ':unit_price' => $_rows['unit_price'],
            ':breakfast' => $_rows['breakfast'],
            ':lunch' => $_rows['lunch'],
            ':dinner' => $_rows['dinner'],
            ':snack' => $_rows['snack'],
            ':special' => $_rows['special'],
            ':special_price' => $_rows['special_price'],
            ':total_conut' => $_rows['total_conut'],
            ':total_price' => $_rows['total_price'],
            ':reg_date' => $reg_date
        ]);
    }    
}

function set_gyeolsan($company_idx, $year, $month) {
    global $connection;

    $_company = all_company("idx", $company_idx);
      
    $sql = "select * from `ilbyeol` where `company_idx`= :company_idx and `year`= :year and `month`= :month ";
    $stmt = $connection->prepare($sql);
    $stmt->execute([
        ':company_idx' => $company_idx,
        ':year' => $year,
        ':month' => $month
    ]);


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
            `sales` = :sales, 
            `supply_value` = :supply_value, 
            `tax_amount` = :tax_amount
        where company_idx = :company_idx and year = :year and month = :month";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':sales' => $sales,
            ':supply_value' => $supply_value,
            ':tax_amount' => $tax_amount,
            ':company_idx' => $company_idx,
            ':year' => $year,
            ':month' => $month
        ]);
    } else {
        $sql = "insert into `gyeolsan` set 
            `company_idx` = :company_idx,
            `company` = :company,
            `year` = :year,
            `month` = :month,
            `unit_price` = :unit_price,        
            `sales` = :sales,
            `supply_value` = :supply_value,
            `tax_amount` = :tax_amount
        ";
        $stmt = $connection->prepare($sql);
        $stmt->execute([
            ':company_idx' => $company_idx,
            ':company' => $_company[0]['company'],
            ':year' => $year,
            ':month' => $month,
            ':unit_price' => $_company[0]['unit_price'],
            ':sales' => $sales,
            ':supply_value' => $supply_value,
            ':tax_amount' => $tax_amount,
        ]);
    }
}

?>