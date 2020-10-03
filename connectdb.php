<?php 
define("server","mysql:host=localhost;dbname=pmsdb");
define("user","root");
define("pass","");
	$db_error_msg="";
 TRY{
	//for store Arabic character 
	$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
); 
	$db=new pDO(server,user,pass,$options);//with pdo
	 $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
}
CATCH(PDOException $e){
$db_error_msg=" : خطاء في الإتصال بقاعدة البيانات ";
	die($db_error_msg."<br>".$e->getMessage());
}
	
	?>
