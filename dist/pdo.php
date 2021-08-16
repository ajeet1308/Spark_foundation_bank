<?php

try{
$pdo=new PDO('mysql::host=localhost;port=3306;dbname=portfolio','root','root');
//See the "errors" folder for detail...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	//echo $e->getMessage();
	// OR die('Sorry,database problem');
	echo "Internal error, please contact support";
}

?>