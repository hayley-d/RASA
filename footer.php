<?php
global $currentPage;
if ($currentPage === 'cars')
{?>
    <div class = "footer">
    <!--Random info about Company-->
    <div id = "info-contact">
        <div id="info-about">
            <h3>About</h3>
            <hr class = "underline"/>
            <a><p>We sell and buy supercars</p></a>
            <a><p>Terms and Conditions apply</p></a>
        </div>
        <!--Contact Information with location and google maps given-->
        <div id="info-email">
            <h3>Contact</h3>
            <hr class = "underline"/>
            <a href = "https://www.google.com/maps/@35.7040744,139.5577317,3a,80.9y,292.44h,75.21t/data=!3m6!1e1!3m4!1sgT28ssf0BB2LxZ63JNcL1w!2e0!7i13312!8i6656?entry=ttu"><p>Where to Find us</p></a>
            <a><p><span>T </span>+27 674 152 597</p></a>
            <a><p><span>E </span>sales@rasacars.co.za</p></a>
        </div>

        <button class = "mode-btn"><a onclick="modeChangeCars()"><h3>Light Mode</h3></a></button>
    </div>
    <!--mock copyright data-->
    <br/>
    <hr/>
    <div id="info-name">© COPYRIGHT 2023 RASA™ | All Rights Reserved | Get Shwifty </div>
    <br/>

</div>
<?php
} else if($currentPage === 'brands') {?>
    <!--footer div stores contact info, location and socials-->
    <div class = "footer">
        <!--Random info about Company-->
        <div id = "info-contact">
            <div id="info-about">
                <h3>About</h3>
                <hr class = "underline"/>
                <a><p>We sell and buy supercars</p></a>
                <a><p>Terms and Conditions apply</p></a>
            </div>
            <!--Contact Information with location and google maps given-->
            <div id="info-email">
                <h3>Contact</h3>
                <hr class = "underline"/>
                <a href = "https://www.google.com/maps/@35.7040744,139.5577317,3a,80.9y,292.44h,75.21t/data=!3m6!1e1!3m4!1sgT28ssf0BB2LxZ63JNcL1w!2e0!7i13312!8i6656?entry=ttu"><p>Where to Find us</p></a>
                <a><p><span>T </span>+27 674 152 597</p></a>
                <a><p><span>E </span>sales@rasacars.co.za</p></a>
            </div>

            <button class = "mode-btn"><a onclick="modeChangeBrands()"><h3>Light Mode</h3></a></button>
        </div>
        <!--mock copyright data-->
        <br/>
        <hr/>
        <div id="info-name">© COPYRIGHT 2023 RASA™ | All Rights Reserved | Get Shwifty </div>
        <br/>

    </div>
    <?php
} else if($currentPage === 'compare') {?>
    <!--footer div stores contact info, location and socials-->
    <div class = "footer">
        <!--Random info about Company-->
        <div id = "info-contact">
            <div id="info-about">
                <h3>About</h3>
                <hr class = "underline"/>
                <a><p>We sell and buy supercars</p></a>
                <a><p>Terms and Conditions apply</p></a>
            </div>
            <!--Contact Information with location and google maps given-->
            <div id="info-email">
                <h3>Contact</h3>
                <hr class = "underline"/>
                <a href = "https://www.google.com/maps/@35.7040744,139.5577317,3a,80.9y,292.44h,75.21t/data=!3m6!1e1!3m4!1sgT28ssf0BB2LxZ63JNcL1w!2e0!7i13312!8i6656?entry=ttu"><p>Where to Find us</p></a>
                <a><p><span>T </span>+27 674 152 597</p></a>
                <a><p><span>E </span>sales@rasacars.co.za</p></a>
            </div>

            <button class = "mode-btn"><a onclick="modeChangeCompare()"><h3>Light Mode</h3></a></button>
        </div>
        <!--mock copyright data-->
        <br/>
        <hr/>
        <div id="info-name">© COPYRIGHT 2023 RASA™ | All Rights Reserved | Get Shwifty </div>
        <br/>

    </div>
    <?php
} else if($currentPage === 'find') {?>
    <!--footer div stores contact info, location and socials-->
    <div class = "footer">
        <!--Random info about Company-->
        <div id = "info-contact">
            <div id="info-about">
                <h3>About</h3>
                <hr class = "underline"/>
                <a><p>We sell and buy supercars</p></a>
                <a><p>Terms and Conditions apply</p></a>
            </div>
            <!--Contact Information with location and google maps given-->
            <div id="info-email">
                <h3>Contact</h3>
                <hr class = "underline"/>
                <a href = "https://www.google.com/maps/@35.7040744,139.5577317,3a,80.9y,292.44h,75.21t/data=!3m6!1e1!3m4!1sgT28ssf0BB2LxZ63JNcL1w!2e0!7i13312!8i6656?entry=ttu"><p>Where to Find us</p></a>
                <a><p><span>T </span>+27 674 152 597</p></a>
                <a><p><span>E </span>sales@rasacars.co.za</p></a>
            </div>

            <button class = "mode-btn"><a onclick="modeChangeFind()"><h3>Light Mode</h3></a></button>
        </div>
        <!--mock copyright data-->
        <br/>
        <hr/>
        <div id="info-name">© COPYRIGHT 2023 RASA™ | All Rights Reserved | Get Shwifty </div>
        <br/>

    </div>
    <?php
}
?>








