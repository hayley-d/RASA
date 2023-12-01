<?php
?>

<!DOCTYPE html>
<html lang="en">
<!--By Hayley Dodkins u21528790-->
<head>
    <meta charset="UTF-8">
    <title>RASA</title>
    <link rel = "stylesheet" href = "css/Compare.css"/>
    <link rel = "stylesheet" href = "css/Header.css"/>
    <link rel = "stylesheet" href = "css/Footer.css"/>
    <!--link for additional font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Playfair+Display:wght@500&family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;1,200&display=swap" rel="stylesheet">
</head>

<body>
<?php include 'header.php'; ?>

<!--content div stores photo and information-->
<div class = "content">

    <!--image is displayed using div for performance and styling reasons-->
    <!--decore for webpage showcase products-->
    <div class = "displayImg">

    </div>


    <!--Compare table-->
    <!--Display Car photos for up to 3 cars)-->
    <div id = compare-container>
        <div class = "card black-card">

        </div>

        <div class = "card car-display">
            <div id="loading-spinner" class="spinner"></div>
            <div class = "car-img-container" id = "car-img-1"></div>
            <div><h2 id = "car-1-name">Brabus Rocket</h2></div>
            <div><a><button class = "choose-btn" onclick="openPopup(1)">Choose Car</button></a></div>
        </div>

        <div class = "card car-display">
            <div id="loading-spinner2" class="spinner"></div>
            <div class = "car-img-container" id = "car-img-2"></div>
            <div><h2 id = "car-2-name">BMW Z4</h2></div>
            <div><a><button class = "choose-btn" onclick="openPopup(2)">Choose Car</button></a></div>
        </div>

        <div class = "card car-display">
            <div id="loading-spinner3" class="spinner"></div>
            <div class = "car-img-container" id = "car-img-3"></div>
            <div><h2 id = "car-3-name">Tesla Model S</h2></div>
            <div><a><button class = "choose-btn" onclick="openPopup(3)">Choose Car</button></a></div>
        </div>

        <div class = "card" id = "attributes">
            <!--attribute names-->
            <div><h2>Top Speed</h2><hr/></div>
            <div><h2>Year</h2><hr/></div>
            <div><h2>Fuel Type</h2><hr/></div>
            <div><h2>Gearbox</h2><hr/></div>
            <div><h2>Drive Wheels</h2><hr/></div>
            <div><h2>Seats</h2><hr/></div>
        </div>
        <div class = "card comparison-values">
            <div id = "top-speed-1"><h2>320km/h</h2><hr/></div>
            <div  id = "year-1"><h2>2018</h2><hr/></div>
            <div  id = "fuel-type-1"><h2>Eletric</h2><hr/></div>
            <div  id = "gear-box-1"><h2>Automatic</h2><hr/></div>
            <div  id = "drive-1"><h2>R4 903 000</h2><hr/></div>
            <div  id = "seats-1"><h2>4.1s</h2><hr/></div>
        </div>
        <div class = "card comparison-values">
            <div id = "top-speed-2"><h2>320km/h</h2><hr/></div>
            <div  id = "year-2"><h2>2018</h2><hr/></div>
            <div  id = "fuel-type-2"><h2>Eletric</h2><hr/></div>
            <div  id = "gear-box-2"><h2>Automatic</h2><hr/></div>
            <div  id = "drive-2"><h2>R5 903 000</h2><hr/></div>
            <div  id = "seats-2"><h2>2.1s</h2><hr/></div>
        </div>
        <div class = "card comparison-values">
            <div id = "top-speed-3"><h2>320km/h</h2><hr/></div>
            <div  id = "year-3"><h2>2018</h2><hr/></div>
            <div  id = "fuel-type-3"><h2>Eletric</h2><hr/></div>
            <div  id = "gear-box-3"><h2>Automatic</h2><hr/></div>
            <div  id = "drive-3"><h2>R2 903 000</h2><hr/></div>
            <div  id = "seats-3"><h2>4.3s</h2><hr/></div>
        </div>
    </div>

    <!--div for popup search and choose the car to compare-->
    <div id="carPopup" class="popup">
        <div class="popup-content">
            <button id = "popup-close" onclick="closePopup()">X</button>
            <!--<span class="close" onclick="closePopup()">&times;</span>-->
            <input type="text" id="searchInput" placeholder="Search cars...">
            <ul id="carList">
                <!-- Cars will be dynamically added here -->
            </ul>
        </div>
    </div>


</div>



<?php
global $currentPage;
$currentPage = 'compare';
include 'footer.php';
?>
<script src = "js/compare.js"></script>
<script src = "js/lightMode.js"></script>
</body>

</html>
