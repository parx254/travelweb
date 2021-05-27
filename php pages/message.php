<?

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'pamcclel');
define('DB_PASSWORD', 'Ozzie12!');
define('DB_NAME', 'socialdestinationsdatabase');
session_start();
include ('functions.php');
include ('control.php');
  $title = "Message | Social Destinations";   // Set the title
  $activePage = 'message';          // Set the active page
  $city = 'Nashville';              // Set the city
  $keywords = 'Message, Travel, Trips, Travel Tips, Excursions, Sports, Holidays, Social Destinations, Social, Destinations';          // Set the keywords
  $description = 'Message'; //Set the description
  $currentcolor = '#000';           // (5) Set the color
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: registration.php");
  exit;
}

if(isset($_SESSION['username'])){
	$sql = "SELECT authorized FROM users WHERE username = '$user'";
	$result = $con->query($sql);
	if (!result){
	echo "Error: " . mysql_error() . "\n";
	}
	if ($result->num_rows > 0){
	$row = $result->fetch_assoc();
		if ($row['authorized'] == 0){
			header("location: registration.php");
  			exit;
		}
	}

}

global $user;
$currentuser = $_GET['currentuser'];

if ($user == $currentuser){
	header("location: my-profile.php");
  	exit;
}



/* Attempt to connect to MySQL database */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()){
echo nl2br("Error connecting to MySQL: " . mysqli_connect_error() . "\n "); 
}else{ 

	if (isset($_POST['submit'])){
		$user = $_SESSION['username'];
		$currentuser = $_GET['currentuser'];
		$to_user = $_POST['to_user'];
		$from_user = $_POST['from_user'];
		$message = $_POST['message'];
		$sql = "INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')";
		$result = $con->query($sql);
		if (result){
		  echo "Message sent!"; 
		  }
		  header('location: sent.php');
		}
		
	if (isset($_POST['reply'])){
		global $user;
		$user = $_SESSION['username'];
		$currentuser = $_GET['currentuser'];
		$to_user = $_POST['to_user'];
		$from_user = $_POST['from_user'];
		$message = $_POST['message'];

		$q = "UPDATE messages SET replied = 'yes' WHERE id = '$row_id' AND to_user = '$user'";
		$result01 = $con->query($q);
		
		$sql = "INSERT INTO messages (to_user, message, from_user) VALUES ('$to_user', '$message', '$from_user')";
		$result = $con->query($sql);
		if (result){
		  echo "Reply sent!"; 
		  }
		  header('location: sent.php');
		}
	}
	  	include "header.php";             // Include the header
?>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBS5FHD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBS5FHD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <div id="wrapper">
            <div class="bodycontainer">
                <div class='coverpic'>
                    <img src="<?php currentcoverpic(); ?>" alt='coverPic'>
                </div>
                <div class="profile">
                    <div class="profiletop">
                        <img src="<?php currentprofpic(); ?>" alt='profilePic' align='middle'>
                        <div class='prof_names'>
                            <div class="text-box">
                                <h2><?php echo $currentuser; ?></h2>
                            </div>
                            <div class="text-box">
                                <h5><i class="fad fa-envelope"></i> Send Message</h5>
                            </div>
                        </div>
                    </div>
                    <div class='message'>
                        <form action='message.php' method='POST' enctype='multipart/form-data'>
                            <input type='hidden' name='to_user' maxlength='32' value='<?php echo $currentuser ?>' required>
                            <textarea name='message' maxlength='280' placeholder='Type here...' required></textarea><br><br>
                            From <?php echo $user; ?> <input type="hidden" name="from_user" maxlength="32" value='<?php echo $user; ?>'><br>
                            <button type="submit" name="submit" style="margin-top:20px"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </button>
                        </form>
                        <a href="my-profile.php"> Return to my profile </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    include "footer.php";
    ?>
    </body>
    <style>
        @media(max-width:768px) {
            nav {
                border-bottom: 1px solid #f5f5f5;
                height: 50px;
                z-index: 1;
                top: 0;
            }

            #toggle .span {
                background: #000
            }
        }

        @media(min-width:769px) {
            nav {
                background: #fff;
                border-bottom: 2px solid #f5f5f5;
            }

            nav #menu li a,
            nav #menu li.select,
            .dropbtn {
                color: #000;
            }
        }

    </style>

    </html>
