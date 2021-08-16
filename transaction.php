<?php require_once "header.php"?>
<?php require_once "pdo.php"?>
<body>
	<?php require_once "header.php"?>
	<article class="article">
		<p style="padding-top: 50px;padding-bottom: -10px;">
			<h1><a href="" style="text-decoration: none;color: #e1c814;"class="typewrite" data-period="2000" data-type='[ "Transactions" ]'><span class="wrap"></span></a></h1>
		</p>
		
    </article>
</body>
<?php
	$sql="SELECT * FROM transfers";
	echo '<table class="table table-striped" class="table" style="width:80%;margin-left: 135px;
    margin-top: -55px;">
	  <thead>
	    <tr>
	      <th scope="col">S.No.</th>
	      <th scope="col">Sender</th>
	      <th scope="col">Reciever</th>
	      <th scope="col">Amount Transaction</th>
	      <th scope="col">Date & Time</th>
	    </tr>
	  </thead>
	  <tbody>';
      if($result=$pdo->query($sql)){
      	while($row=$result->fetch(PDO::FETCH_ASSOC)){
      		$field1name=$row["sno"];
      		$field2name=$row["sender"];
      		$field3name=$row["reciever"];
      		$field4name=$row["balance"];
      		$field5name=$row["timedate"];
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

