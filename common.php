<?
extract($_REQUEST,EXTR_SKIP);

$connect_db = mysql_connect('localhost','root','test0');
mysql_select_db('phptest',$connect_db);
mysql_query('SET NAMES UTF8');

?>