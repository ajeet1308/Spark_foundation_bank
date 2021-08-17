<?php

try{
$pdo=new PDO('mysql::host=localhost;port=your port no.;dbname=your file name in php my admin','root','root');
//See the "errors" folder for detail...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	//echo $e->getMessage();
	// OR die('Sorry,database problem');
	echo "Internal error, please contact support";
}

?>
