<?

extract($_REQUEST,EXTR_SKIP);

$connect_db = mysql_connect('localhost','root','test0');
mysql_select_db('phptest',$connect_db);
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

function get_company($field, $value) {
    $sql = "select * from `account` where `".$field."` = '".$value."'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    return $row;
}

?>