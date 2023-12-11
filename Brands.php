<?php

?>
<!DOCTYPE html>
<html lang="en">
<!--By Hayley Dodkins u21528790-->
<head>
    <meta charset="UTF-8">
    <title>RASA</title>
    <link rel = "stylesheet" href = "css/Brands.css"/>
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
    <br>
    <div id="loading-spinner" class="spinner"></div>
</div>

<?php
global $currentPage;
$currentPage = 'brands';
include 'footer.php';
?>
<script src = "js/brands.js"></script>
<script src = "js/lightMode.js">checkBrands();</script>
</body>

</html>


