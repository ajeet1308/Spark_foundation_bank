<?php require_once "header.php"?>
<?php require_once "pdo.php"?>
<body>
	<?php require_once "header.php"?>
	<article class="article">
		<p style="padding-top: 50px;padding-bottom: -10px;">
			<h1><a href="" style="text-decoration: none;color: #e1c814;"class="typewrite" data-period="2000" data-type='[ "Customers Details" ]'><span class="wrap"></span></a></h1>
		</p>
		
    </article>
</body>
<?php
	$sql="SELECT * FROM users";
	echo '<table class="table table-striped" class="table" style="width:80%;margin-left: 135px;
    margin-top: -55px;">
	  <thead>
	    <tr>
	      <th scope="col">ID</th>
	      <th scope="col">NAME</th>
	      <th scope="col">EMAIL</th>
	      <th scope="col">BALANCE</th>
	      <th scope="col">Account ID</th>
	    </tr>
	  </thead>
	  <tbody>';
      if($result=$pdo->query($sql)){
      	while($row=$result->fetch(PDO::FETCH_ASSOC)){
      		$field1name=$row["user_id"];
      		$field2name=$row["name"];
      		$field3name=$row["email"];
      		$field4name=$row["balance"];
      		$field5name=$row["account_id"];
      	    echo '<tr> 
	                  <th scope="row">'.$field1name.'</th> 
	                  <td>'.$field2name.'</td> 
	                  <td>'.$field3name.'</td> 
	                  <td>'.$field4name.'</td> 
	                  <td>'.$field5name.'</td>
	              </tr>';
	    }
	    echo '</tbody>
	    </table>';
    }
?>

