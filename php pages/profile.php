<?php
  include ('control.php');
  include ('functions.php');
  $title = "$currentuser Profile | Social Destinations";   // Set the title
  $activePage = 'profile';          // Set the active page
  $city = 'Nashville';              // Set the city
  $keywords = 'Profile, Travel, Trips, Travel Tips, Excursions, Sports, Holidays, Social Destinations, Social, Destinations';          // Set the keywords
  $description = 'Discover Nashville'; //Set the description
  $currentcolor = '#000';           // (5) Set the color
  session_start();
  //user must sign in to go to someone profile
  /*
  if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
    header("location: login.php");
    exit;
  }
  */
  if(isset($_SESSION['username'])){
  	$sql = "SELECT authorized FROM users WHERE username = '$user'";
  	$result = $con->query($sql);
  	if (!$result){
  	echo "Error: " . mysql_error() . "\n";
  	}
  	if ($result->num_rows > 0){
  	$row = $result->fetch_assoc();
  		if ($row['authorized'] == 0){
  			header("location: login.php");
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
  $sql2 = "SELECT * FROM users WHERE username = '$currentuser'";
  	$result = $con->query($sql2);
  	if (!$result){
  	echo "Error: " . mysql_error() . "\n";
  	}
  	if ($result->num_rows > 0){
  	$row2 = $result->fetch_assoc();
  	$fname = $row2['firstname'];
  	$lname = $row2['lastname'];
  	}
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
                        <h5><i class="fad fa-id-card"></i> <?php echo $fname; ?> <?php echo $lname; ?> </h5>
                    </div>
                </div>
                <div class='prof_section'>
                    <div class='myfollowers'><?php otherFollowers(); ?></div>
                    <div class='myfollowees'><?php otherFollowees(); ?></div>
                    <?php profileOption(); ?>
                    <?php otherprofile();?>
                </div>
            </div>
            <div class='bottomprof'>
                <div class="secondtitle">
                    <div class="text-box">
                        <h2>POSTS</h2>
                    </div>
                </div>
                <div class='myprofposts'>
                    <?php allOtherPosts(); ?>
                </div>
                <div class='myprofvideoposts'>
                    <?php allOtherVideoPosts(); ?>
                </div>
            </div>
        </div>
        <div class='myprofplaces'>
            <div class="bodycontainer">
                <div class="secondtitle">
                    <div class="text-box">
                        <h2>PLACES VISITED</h2>
                    </div>
                </div>
                <ul id="myid">
                    <?php otherplacesVisited(); ?>
                    <?php otherplacesVideoVisited(); ?>
                </ul>
            </div>
        </div>
    </div>
    </div>
    <?php
    include "footer.php";
    ?>
</body>
<script>
    $("li.placesvisited > a[href='']").closest('li').remove()

    var liText = '',
        liList = $('#myid li'),
        listForRemove = [];

    $(liList).each(function() {

        var text = $(this).text();

        if (liText.indexOf('|' + text + '|') == -1)
            liText += '|' + text + '|';
        else
            listForRemove.push($(this));

    });

    $(listForRemove).each(function() {
        $(this).remove();
    });
</script>
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