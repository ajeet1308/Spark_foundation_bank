<?php require_once "header.php"?>
<?php
require_once "pdo.php";
session_start();

if(isset($_POST['submit']) || isset($_POST['reciever']) || isset($_POST['sender']) || isset($_POST['balance'])){

	$sender=htmlentities($_POST['sender']);
	$reciever=htmlentities($_POST['reciever']);
	$balance=htmlentities($_POST['balance']);
	$timezone=date('Y-m-d H:i:s');
	$s1="SELECT * FROM users WHERE name='$sender'";
	$r1=$pdo->query($s1);
	$s2="SELECT * FROM users WHERE name='$reciever'";
	$r2=$pdo->query($s2);
	$row1=$r1->fetch(PDO::FETCH_ASSOC);
	$row2=$r2->fetch(PDO::FETCH_ASSOC);
	$cal1=$row1['balance']-$balance;
	$cal2=$row2['balance']+$balance;
	$q1="UPDATE users SET balance=$cal1 WHERE name='$sender'";
	$pdo->query($q1);
	$q2="UPDATE users SET balance=$cal2 WHERE name='$reciever'";
	$pdo->query($q2);

	
	if ($sender=="Choose") {
		$_SESSION['error']="Please Enter the Sender Details.";
		header('Location: money-transfer.php');
		return;
	}

	elseif ($reciever=="Choose") {
		$_SESSION['error']="Please Enter the Reciever Details.";
		header('Location: money-transfer.php');
		return;
	}
	elseif (is_int($balance)==0 && $balance<0) {
		$_SESSION['error']="Please Enter an Appropriate Amount (i.e Amount should be Non-Negative Number.)";
		header('Location: money-transfer.php');
		return;
	}
	else if($cal1<1){
		$_SESSION['error']="Sender is not allowed to transfer Money due to Low Balance!!";
		header('Location: money-transfer.php');
		return;
	}
	else{
		$sql="INSERT INTO transfers (sender,reciever,balance,timedate) VALUES (:sender,:reciever,:balance,:timedate)";
		$stmt=$pdo->prepare($sql);
		$result=$stmt->execute(array(':sender'=>$sender,
							 ':reciever'=>$reciever,
							 ':balance'=>$balance,
							 ':timedate'=>$timezone));

		$_SESSION['success']="Transaction Successful:))";
		header('Location: money-transfer.php');
		return;
	}

}

?>
<body>
	<?php require_once "header.php"?>
	<article class="article">
		<p style="padding-top: 50px;padding-bottom: -10px;">
			<h1><a href="" style="text-decoration: none;color: #e1c814;"class="typewrite" data-period="2000" data-type='[ "Transfer Money" ]'><span class="wrap"></span></a></h1>
		</p>
		
    </article>
    <form method="POST">
	  <div class="form-group" style="width:80%;margin-left: 135px;
    margin-top: -55px;">
	    <label for="sender">Transfer From:</label>
	    <div class="form-group">
	    <select class="form-control" id="sender" name="sender">
	    	<option selected value="Choose">Choose</option>
	    	<option value="Ansh">Ansh (Account ID: spark@ansh1001)</option>
	    	<option value="Akhilesh">Akhilesh (Account ID: spark@akhi1002)</option>
	    	<option value="Manjeet">Manjeet (Account ID: spark@manjeet1003)</option>
	    	<option value="Arpit">Arpit (Account ID: spark@arpit1004)</option>
	    	<option value="Ajeet">Ajeet (Account ID: spark@ajeet1005)</option>
	    	<option value="Ram">Ram (Account ID: spark@ram1006)</option>
	    	<option value="Shyam">Shyam (Account ID: spark@shyam1007)</option>
	    	<option value="Shreya">Shreya (Account ID: spark@shreya1008)</option>
	    	<option value="Sarita">Sarita (Account ID: spark@sarita1009)</option>
	    	<option value="Ajay">Ajay (Account ID: spark@ajay1010)</option>
	    </select>
	    <br><br>
	  </div>
	  <div class="form-group" style="width:100%;margin-left: 0px;
    margin-top: -55px;">
	    <label for="reciever">Transfer To:</label>
	    <div class="form-group">
	    <select class="form-control" id="reciever" name="reciever">
	    	<option selected value="Choose">Choose</option>
	    	<option value="Ansh">Ansh (Account ID: spark@ansh1001)</option>
	    	<option value="Akhilesh">Akhilesh (Account ID: spark@akhi1002)</option>
	    	<option value="Manjeet">Manjeet (Account ID: spark@manjeet1003)</option>
	    	<option value="Arpit">Arpit (Account ID: spark@arpit1004)</option>
	    	<option value="Ajeet">Ajeet (Account ID: spark@ajeet1005)</option>
	    	<option value="Ram">Ram (Account ID: spark@ram1006)</option>
	    	<option value="Shyam">Shyam (Account ID: spark@shyam1007)</option>
	    	<option value="Shreya">Shreya (Account ID: spark@shreya1008)</option>
	    	<option value="Sarita">Sarita (Account ID: spark@sarita1009)</option>
	    	<option value="Ajay">Ajay (Account ID: spark@ajay1010)</option>
	    </select>
	    <br><br>
	  </div>
	  <div class="form-group" style="width:100%;margin-left: 0px;
    margin-top: -55px;">
	    <label for="balance">Transaction Amount:</label>
	    <input type="number" class="form-control" id="balance" placeholder="Amount" name="balance" value=0><br><br><br>
	  </div>
	  <div class="form-group" style="width:10%;margin-left: 0px;
    margin-top: -55px;">
	    <input type="submit" value="Pay" class="form-control" id="submit" name="submit"><br><br>
	  </div>
	  
	</form>
	<?php
		if (isset($_SESSION['error'])) {
			echo('<p style="color:#ff0a54;font-size:50px; text-align:center;">'.htmlentities($_SESSION['error'])."</p>\n");
			unset($_SESSION['error']);
		}
		if (isset($_SESSION['success'])) {
			echo('<p style="color:#70e000;font-size:50px;text-align:center;">'.htmlentities($_SESSION['success'])."</p>\n");
			unset($_SESSION['success']);
		}

	?>
</body>