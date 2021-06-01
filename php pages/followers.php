<?php
  include ('functions.php');
  include ('control.php');
  $title = "Followers | Social Destinations";   // Set the title
  $activePage = 'none';          // Set the active page
  $city = 'Nashville';              // Set the city
  $keywords = 'Followers, Travel, Trips, Travel Tips, Excursions, Sports, Holidays, Social Destinations, Social, Destinations';          // Set the keywords
  $description = 'Followers'; //Set the description
  $currentcolor = '#000';           // (5) Set the color
  /*
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
  */
  $currentuser = $_GET['currentuser'];
  include "header.php";             // Include the header
  ?>
<?php allJS(); ?>

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
                <img src="<?php currentprofpic(); ?>" alt='profilePic' align='middle'>
                <div class='prof_names'>
                    <div class="text-box">
                        <h2><?php echo $currentuser; ?></h2>
                    </div>
                    <div class="text-box">
                        <h5><i class="fad fa-users"></i> Followers</h5>
                    </div>
                </div>
            </div>
            <div class='feed'>
                <?php allfollows();?>
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
