<?php
    // Include the configuration file
    require_once 'config.php';
    require_once 'config_session.php';
?>

<div class="header">
    <!-- Used div to store the image since CSS enables more control over styling and for optimal loading -->
    <div class="top-header">
<?php
    if(isset($_SESSION['user_id'])){
        //user is logged in
        //display logout btn
        ?>

                <div><h3 id = "greeting">Hi <?php echo $_SESSION['username']?></h3></div>
                <div class="logo">
                    <div id="logoImg"></div>
                </div>
                <button id="login-btn"><a href="includes/logout.php"><h2>Logout</h2></a></button>

        <?php
    }
    else{
        ?>
                <div><h3 id = "greeting" style="color: black">Hi</h3></div>
                <div class="logo">
                    <div id="logoImg"></div>
                </div>
                <div><button id="login-btn"><a href="includes/login.php"><h2>Login</h2></a></button></div>

<?php
    }
?>

</div>

<!-- Navigation bar to switch between pages -->
<div class="navBar">
    <div class="Cars"><a href="Cars.php"><h2>Cars</h2></a></div>
    <div class="Brands"><a href="Brands.php"><h2>Brands</h2></a></div>
    <div class="Find"><a href="FindCar.php"><h2>Find A Car</h2></a></div>
    <div class="Compare"><a href="Compare.php"><h2>Compare</h2></a></div>
</div>
<br/>
<div class="bar"></div>

</div>


