<!DOCTYPE html>
<html lang="en">
<!--By Hayley Dodkins u21528790-->
<head>

    <meta charset="UTF-8">
    <title>RASA</title>
    <link rel = "stylesheet" href = "css/Cars.css"/>
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
<!--header div stores logo, nav, log in and out btn-->
<?php include 'header.php'; ?>

<!--content div stores photo and information-->
<div class = "content">

    <!--image is displayed using div for performance and styling reasons-->
    <!--decore for webpage showcase products-->
    <div class = "displayImg">
    </div>
    <br/>

    <div class = "search-bar">
        <form action = "#" id = "search-bar">
            <input type="text" placeholder="Search Car" name = "search">
            <button class = "search-btn">Search</button>
        </form>
        <!--<div id="search-bar"></div>-->
        <!-- <button id="search-btn">Search</button>-->
        <div class = "dropdown-filter-btn">
            <button id = "filter-btn" onclick="filterCars()">Filter</button>
            <div class = "filter-options">
                <fieldset>
                    <p>Fuel Type</p>
                    <hr/>
                    <br/>
                    <label>
                        <input class="cb cb1 fuel-check" type="checkbox" name="diesel" value="diesel" />
                        <i></i>
                        <span>Diesel</span>
                    </label>
                    <label>
                        <input class="cb cb2 fuel-check" type="checkbox" name="gasoline" value="gasoline" />
                        <i></i>
                        <span>Gasoline</span>
                    </label>
                    <label>
                        <input class="cb cb3 fuel-check" type="checkbox" name="hybrid" value="hybrid" />
                        <i></i>
                        <span>Hybrid</span>
                    </label>
                    <br>
                    <button id = "filter-btn-submit">Filter</button>
                </fieldset>
                <fieldset>
                    <p>Brands</p>
                    <hr/>
                    <br/>
                    <label>
                        <input class="cb cb1 name-check" type="checkbox" name="a-i" value="a"  />
                        <i></i>
                        <span>A-I</span>
                    </label>
                    <label>
                        <input class="cb cb2 name-check" type="checkbox" name="j-q" value="j" />
                        <i></i>
                        <span>J-Q</span>
                    </label>
                    <label>
                        <input class="cb cb3 name-check" type="checkbox" name="r-z" value="r"  />
                        <i></i>
                        <span>R-Z</span>
                    </label>
                </fieldset>
                <fieldset>
                    <p>Gearbox</p>
                    <hr/>
                    <br/>
                    <label>
                        <input class="cb cb1 transmission-check" type="checkbox" name="automatic"  value="automatic"  />
                        <i></i>
                        <span>Automatic</span>
                    </label>
                    <label>
                        <input class="cb cb2 transmission-check" type="checkbox" name="manual" value="manual" />

                        <i></i>
                        <span>Manual</span>
                    </label>
                </fieldset>
            </div>
        </div>
        <div class = "dropdown-btn">
            <button id="sort-btn">Sort</button>
            <div class = "sort-options">
                <button  class = "options-btn" onclick="ascYear()">Year (ASC)</button>
                <button class = "options-btn" onclick="decYear()">Year (DEC)</button>
                <button class = "options-btn" onclick="ascName()">Name (ASC)</button>
                <button class = "options-btn" onclick="decName()">Name (DEC)</button>
                <button class = "options-btn" onclick="ascSpeed()">Speed (ASC)</button>
                <button class = "options-btn" onclick="decSpeed()">Speed (DEC)</button>
            </div>
        </div>




    </div>
    <div class = "content-card-area">
        <div id="loading-spinner" class="spinner"></div>
    </div>



</div>

<!--footer div stores contact info, location and socials-->
<?php
global $currentPage;
$currentPage = 'cars';
include 'footer.php';
?>

<script src = "./js/cars.js"></script>
<script src = "./js/lightMode.js">checkCars();</script>
</body>

</html>