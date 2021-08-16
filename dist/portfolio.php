<?php
require_once "pdo.php";
session_start();

if(isset($_POST['submit']) || isset($_POST['name']) || isset($_POST['email'])){

	$name=htmlentities($_POST['name']);
	$email=htmlentities($_POST['email']);
	$feedback=htmlentities($_POST['feedback']);
	
	if (strlen($name) < 1) {
		$_SESSION['error']="Name field is compulsory!!";
		header('Location: portfolio.php#section3');
		return;
	}

	elseif (strlen($email) < 1) {
		$_SESSION['error']="E-mail field is compulsory!!";
		header('Location: portfolio.php#section3');
		return;
	}

	elseif (strlen($feedback) < 1) {
		$_SESSION['error']="Feedback field is compulsory!!";
		header('Location: portfolio.php#section3');
		return;
	}

	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$_SESSION['error'] = "Invalid email format";
		header('Location: portfolio.php#section3');
		return;
	}

	else{

		$sql="INSERT INTO users (user_name,user_email,user_feedback) VALUES (:name,:email,:feedback)";
		$stmt=$pdo->prepare($sql);
		$result=$stmt->execute(array(':name'=>$name,
							 ':email'=>$email,
							 ':feedback'=>$feedback));

		$_SESSION['success']="Thanks $name for your feedback :) We will work on your feedback and will update you soon!!";
		header('Location: portfolio.php#section3');
		return;
	}

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ajeet Kumar Jaiswal | Portfolio</title>
	<link rel="stylesheet" type="text/css" href="portfolio.css">
	<script src="index.js"></script>
	<link rel="stylesheet" type="text/css" href="https://
	stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

	
</head>
<body>
	<nav>
		<input type="checkbox" id="check" >
		<label for="check" class="checkbtn">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</label>
		<label class="logo"><i class="fa fa-handshake-o" aria-hidden="true"></i> Welcome!</label>
		<ul>
			<li><a href="#" class="active"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
		    <li><a class="scrollTo" href="#section1">About me</a></li>
		    <li><a class="scrollTo" href="#section2">Portfolio</a></li>
		    <li><a class="scrollTo" href="#section3">Contact</a></li>
		    <li><a class="scrollTo" href="#section3">Feedback</a></li>    
		</ul>
	</nav>
	<h2>Hi,I'm Ajeet Kumar Jaiswal</h2>
	<article class="article">
	<h2><a href="" style="text-decoration: none;color: inherit;"class="typewrite" data-period="2000" data-type='[ "HI, THIS IS  AJEET KUMAR JAISWAL."]'><span class="wrap"></span></a></h2>
	<h1><a href="" style="text-decoration: none;color: #e1c814;"class="typewrite" data-period="2000" data-type='[ "I AM A FULL STACK WEB DEVELOPER." ]'><span class="wrap"></span></a></h1>
	<h3><a href="" style="text-decoration: none;"class="typewrite" data-period="2000" data-type='[ "WELCOME TO MY WEBSITE."]'><span class="wrap"></span></a></h3>
	<h3 id="follow-on"><a class="scrollTo" href="#section1" style="text-decoration: none; color: #775656;">FOLLOW ON</a></h3>
	<p id="arrow"><i class="fa fa-arrow-down" aria-hidden="true"></i></p>
    </article>
	<div class="wrapper">
		<article class="img-info" id="section1">
			<h2 id="test">About me</h2>
		    <a href="https://drive.google.com/file/d/1ia36Wog4iBv4agdrGvK2bSsjewT7_cNH/view"><div class="img"></div></a>
		    <article id="info" style="margin-top: 30px">
			<p>Hi I am Ajeet . I am Second Year student at IIIT Jabalpur and currently studying Electronics and communication engineering here at IIIT Jabalpur.In past two years I learnt some good skills and tried to build some real time web applications.</p>
			<p>I am also a full stack web developer and tried to build some cool stuffs like a login signup system and in continue of all this currently I am working building some more stuffs like this.</p>
			<p>I am also a Machine learning enthusiast and learning new skills day by day,as well I am also enthusiastic in competitive programming and learning new data sturctures. </p>
		    </article>
		</article>
        <script type="text/javascript">
            $(document).ready(function(){
            $('#test').click(function(){
                $('#info').slideToggle(1000);
            });

	      })
		</script>
		<article class="portfolio-info" id="section2">
			<h2>Portfolio | CV</h2>
		    <a href="https://drive.google.com/file/d/1FCxymHZFUHfhGjexmbZ6xHs8QkeKXd75/view"><div class="pdf"></div></a>
		    <p>Please click on the above image to download the Resume</p>
			<p style="margin-top: 10px">Hey! Here with I have attached my Resume if you wants more info about me.You are free to vist my <a href="https://github.com/ajeet1308" style="color:wheat;text-decoration: none; font-size: 20px">LinkedIn</a> Profile.
			</p>
		</article>
		<article class="contact-info" id="section3">
			<h2>Contact</h2>
			<p class="feed">Want to Connect! Please mail me at <address>
				<a href="mailto:ajeetj1308@gmail.com" style="color:#46e512; text-decoration: none;"><i class="fa fa-envelope" aria-hidden="true"></i> ajeetj1308@gmail.com</a></p>
			 </address><br>
		    <h2>Feedback</h2>
			<p class="feed">Hi viewers!,I would be pleased to hear your feedbacks.</p><br>
			<form method="POST">
				<input type="text" name="name" placeholder="Name" id="name"><br><br>
				<input type="text" name="email" placeholder="E-mail" id="email"><br><br>
				<input type="text" name="feedback" placeholder="Please write Your Feedback here" id="feedback"><br><br>
				<input type="submit" name="submit" value="Submit" id="submit"><br><br>
			</form>

			<?php
			if (isset($_SESSION['error'])) {
				echo('<p style="color:#ff0a54;font-size:20px">'.htmlentities($_SESSION['error'])."</p>\n");
				unset($_SESSION['error']);
			}
			if (isset($_SESSION['success'])) {
				echo('<p style="color:#70e000;font-size:20px">'.htmlentities($_SESSION['success'])."</p>\n");
				unset($_SESSION['success']);
			}

			?>

		</article>
	</div>
	<footer class="footer">
		<div class="inner-footer">
			<div class="social-links">
				<ul>
					<li class="social-items"><a href="https://www.facebook.com/profile.php?id=100040654711182"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
					<li class="social-items"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li class="social-items"><a href="https://github.com/ajeet1308"><i class="fa fa-github" aria-hidden="true"></i></a></li>
					<li class="social-items"><a href="https://www.linkedin.com/in/ajeet-kumar-jaiswal-b60a541b1/"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		    <div class="quick-links">
				<ul>
					<li class="quick-items"><a href="#">HOME</a></li>
					<li class="quick-items" class="scrollTo"><a href="#section2">PORTFOLIO</a></li>
					<li class="quick-items" class="scrollTo"><a href="#section1">ABOUT ME</a></li>
					<li class="quick-items" class="scrollTo"><a href="#section3">CONTACT</a></li>
				</ul>
		    </div>
	    </div>
		<div class="outer-footer">
			Copyright &copy; Ajeet Kumar Jaiswal. All Rights Reserved
		</div>
	</footer>


</body>
</html>
<script type="text/javascript">
	$(function(){
		$(".scrollTo").on('click',function(){
		    $("html, body").animate({
		        scrollTop:$($.attr(this, 'href')).offset().top-79
		    }, 1000)
		})
	})
</script>