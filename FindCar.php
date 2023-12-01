<?php?>

<!DOCTYPE html>
<html lang="en">
<!--By Hayley Dodkins u21528790-->
<head>
    <meta charset="UTF-8">
    <title>RASA</title>
    <link rel = "stylesheet" href = "css/FindCar.css"/>
    <link rel = "stylesheet" href = "css/Header.css"/>
    <link rel = "stylesheet" href = "css/Footer.css"/>
    <link rel = "stylesheet" href = "css/findCarForm.css"/>
    <!--link for additional font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat&family=Playfair+Display:wght@500&family=Roboto+Condensed&display=swap" rel="stylesheet">
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

    <div class="form-container" id = "form-container">
        <div class="left-container">
        </div>
        <div class="right-container">

            <div id = "form-heading-div"><h1 id = "form-heading">Find Your Car</h1></div>

            <div class="set" id = "drive-selection">
                <!--selector for drive wheels of the car-->
                <div class="drive-wheels" id = "drivewheels">
                    <label for="drive-wheels">Drive Wheels<span class="required">*</span></label>
                    <select id="drive-wheels" required>
                        <option value="">Drive Wheels</option>
                        <option value="Rear wheel drive">Rear wheel drive</option>
                        <option value="Front wheel drive">Front wheel drive</option>
                        <option value="All wheel drive (AWD)">All wheel drive</option>
                    </select>
                </div>
            </div>



            <div class="set" id = "body-seat-container">
                <!--selector for body type of the car-->
                <div class="body-type">
                    <label for="body-type">Body Type</label>
                    <select id = "body-type">
                        <option value="">Body Type</option>
                        <option value="Cabriolet">Cabriolet</option>
                        <option value="Coupe">Coupe</option>
                        <option value="Roadster">Roadster</option>
                        <option value="Crossover">Crossover</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Hatchback">Hatchback</option>
                        <option value="Liftback">Liftback</option>
                        <option value="Wagon">Wagon</option>
                        <option value="Minivan">Minivan</option>
                        <option value="Fastback">Fastback</option>
                        <option value="Pickup">Pickup</option>
                        <option value="hardtop">hardtop</option>
                        <option value="Targa">Targa</option>
                        <option value="Limousine">Limousine</option>
                    </select>
                </div>
                <!--selector for drive type of the car-->
                <div class="seats">
                    <label for="seats">Number of Seats</label>
                    <select id = "seats">
                        <option value="">Seats</option>
                        <option value="1">2</option>
                        <option value="2">4</option>
                        <option value="3">5</option>
                    </select>
                </div>
            </div>

            <div class="set" id = "transmission-fuzzy-container">
                <div id = "trans-fuz-container">
                    <div class="transmission-type" id = "transmission-container">
                        <label for="transmission-type-auto">Transmission<span class="required">*</span></label>
                        <div class="radio-container">
                            <input id="transmission-type-auto" name="transmission-type" type="radio" value="Automatic" required></input>
                            <label for="transmission-type-auto">Automatic</label>
                            <input id="transmission-type-man" name="transmission-type" type="radio" value="Manual" required></input>
                            <label for="transmission-type-man">Manual</label>
                        </div>
                    </div>

                    <div class="transmission-type" id = "fuzzy-container">
                        <label for="fuzzy-search">Fuzzy Search<span class="required">*</span></label>
                        <div class="radio-container">
                            <input id="fuzzy-search" name="door-num" type="radio" value="true" required></input>
                            <label for="fuzzy-search">Fuzzy</label>
                            <input id="nfuzzy-search" name="door-num" type="radio" value="false" required></input>
                            <label for="nfuzzy-search">Non fuzzy</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fuel-type" id = "fuel-type">
                <div><label for="fuel-type-gasoline">Fuel Type<span class="required">*</span></label></div>
                <div class="radio-container" id = "container-fuel">
                    <input id="fuel-type-gasoline" name="fuel-type" type="radio" value="Gasoline" required></input>
                    <label for="fuel-type-gasoline">Gasoline</label>
                    <input id="fuel-type-diesel" name="fuel-type" type="radio" value="Diesel" required></input>
                    <label for="fuel-type-diesel">Diesel</label>
                    <input id="fuel-type-hybrid" name="fuel-type" type="radio" value="Hybrid" required></input>
                    <label for="fuel-type-hybrid">Hybrid</label>
                    <input id="fuel-type-electric" name="fuel-type" type="radio" value="Gasoline, Electric" required></input>
                    <label for="fuel-type-electric">Electric</label>
                </div>
            </div>




            <div class="set" id = "find-btn-container">
                <div >
                    <a onclick="checkValues()">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Find Car
                    </a>
                </div>

            </div>


        </div>
    </div>
    <br>
    <br>
    <div class="bar"></div>
    <br>
    <div class = "content-card-area">
        <div id="loading-spinner" class="spinner"></div>

    </div>


</div>



<?php
global $currentPage;
$currentPage = 'find';
include 'footer.php';
?>
<script src = "./js/findcar.js"></script>
<script src = "./js/lightMode.js"></script>
</body>

</html>
