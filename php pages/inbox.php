<?php
  include ('control.php');
  include ('functions.php');
  $title = "Inbox | Social Destinations";      // (1) Set the title
  $description = 'Inbox';  // (2) Set the description
  $city = 'Houston';                  // (3) Set the city
  $keywords = 'Inbox, Travel, Trips, Travel Tips, Excursions, Sports, Holidays, Social Destinations, Social, Destinations';          // Set the keywords
  $activePage = 'message';             // (4) Set the active page
  $currentcolor = '#000';           // (5) Set the color
  session_start();
  global $user;
  global $con;
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
  }
  if(isset($_SESSION['username'])){
  	$sql = "SELECT * FROM users WHERE username = '$user'";
  	$result = $con->query($sql);
  	if (!$result){
  	echo "Error: " . mysql_error() . "\n";
  	}
  	if ($result->num_rows > 0){
  	$row = $result->fetch_assoc();
  	$fname = $row['firstname'];
  	$lname = $row['lastname'];
  		if ($row['authorized'] == 0){
  			header("location: login.php");
    			exit;
  		}
  	}
  }
  $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if (mysqli_connect_errno()){
  	echo nl2br("Error connecting to MySQL: " . mysqli_connect_error() . "\n "); 
  }else{ 
  	if (isset($_POST['delete'])) {
  		$id = $_POST['id'];  
  		$q = "UPDATE messages SET deleted = 'yes' WHERE to_user = '$user' AND id = '$id'";
  		$result = $con->query($q);
  		if ($result){
  		header("location: inbox.php");
  		}
  	}
  }
    include "header.php";                // (6) Include the header
  ?>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBS5FHD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="wrapper">
        <div class="bodycontainer">
            <div class='coverpic'>
                <img src="<?php mycurrentcoverpic(); ?>" alt='coverPic'>
            </div>
            <div class="profile">
                <img src="<?php mycurrentprofpic(); ?>" alt='profilePic' align='middle'>
                <div class='prof_names'>
                    <div class="text-box">
                        <h2><?php echo $user; ?></h2>
                    </div>
                    <div class="text-box">
                        <h5><i class="fad fa-id-card"></i> <?php echo $fname; ?> <?php echo $lname; ?> </h5>
                    </div>
                </div>
                <div class='prof_section'>
                    <div class='myfollowers'><?php profileFollowers(); ?></div>
                    <div class='myfollowees'><?php profileFollowees(); ?></div>
                    <?php profile(); ?>
                </div>
            </div>
            <div class='prof_actions'>
                <form action="my-profile.php">
                    <button type="submit">
                        <i class="fad fa-home-alt"></i>
                        <p>Home</p>
                    </button>
                </form>
                <form action="inbox.php">
                    <button type="submit" class="highlighted">
                        <i class="fad fa-inbox"></i>
                        <p>Inbox</p>
                    </button>
                </form>
                <form action="sent.php">
                    <button type="submit">
                        <i class="fad fa-envelope"></i>
                        <p>Sent</p>
                    </button>
                </form>
                <form action="edit-profile.php">
                    <button type="submit">
                        <i class="fad fa-edit"></i>
                        <p>Edit</p>
                    </button>
                </form>
                <form action="control.php" method='POST'>
                    <button type="submit" name='logout'>
                        <i class="fad fa-sign-out"></i>
                        <p>Logout</p>
                    </button>
                </form>
                <button id='changePic'>
                    <i class='fad fa-image' aria-hidden='true'></i>
                    <p>Edit Photos</p>
                </button>
            </div>
            <div class="messages">
                <div class="maintitle">
                    <div class="text-box">
                        <h2>INBOX</h2>
                    </div>
                </div>
                <?php Received(); ?>
                <a href="trash.php">Deleted Received Messages</a>
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
            color: #000
        }
    }

    nav #menu li.active,
    nav #menu li.active:hover,
    nav #menu li:hover {
        border-bottom: 2px solid #000
    }
</style>

</html>