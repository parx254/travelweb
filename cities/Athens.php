<?php
  include('functions.php');
  $title = "Athens | Social Destinations";      // (1) Set the title
  $description = 'Discover Athens';  // (2) Set the description
  $city = 'Athens';                  // (3) Set the city
  $keywords = 'Athens, Travel, Trips, Travel Tips, Excursions, Sports, Holidays, Social Destinations, Social, Destinations';          // Set the keywords
  $activePage = 'explore';             // (4) Set the active page
  $currentcolor = '#3e75ad';           // (5) Set the color
  include "header.php";                // (6) Include the header
  ?>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBS5FHD" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="wrapper">
        <div class="topslide">
            <video playsinline autoplay loop muted controls="false">
                <source src="SiteVideos/athens.mp4" type="video/mp4">
                <source src="SiteVideos/athens.webm" type="video/webm">
                <source src="SiteVideos/athens.ogv" type="video/ogg">
                Your browser does not support the video tag.
            </video>
            <div class="city-hero-text">
                <h1>Athens</h1>
                <a href="#" class="scroll-down" address="true"></a>
            </div>
        </div>
        <div class="bodycontainer">
            <div class="maintitle">
                <div class="text-box">
                    <h2>POSTS</h2>
                </div>
            </div>
            <div class='feedposts'>
                <?php all_Athens(); ?>
            </div>
            <div class='videofeedposts'>
                <?php all_Athens_Videos(); ?>
            </div>
            <?php cityweather(); ?>
        </div>
        <?php citysearch(); ?>
    </div>
    <?php
    include "footer.php";
    ?>
</body>

</html>