var mode = "dark";
function modeChangeCars(){
    if(mode === "dark"){
        //change to light mode
        mode = "light";
        //change background colour
       const content = document.getElementsByClassName("content")[0];
        content.style.backgroundColor = "white";
        const searchArea = document.getElementsByClassName("search-bar")[0];
        searchArea.style.backgroundColor = "white";
        const searchbar = document.getElementsByName("search")[0];
        searchbar.style.backgroundColor = "white";
        searchbar.style.color = "black";
        searchbar.style.borderBottomColor = "black";
        const searchBtn = document.getElementsByClassName("search-btn")[0];
        const filterBtn = document.getElementById("filter-btn");
        const sortBtn = document.getElementById("sort-btn");
        searchBtn.style.backgroundColor = "white";
        searchBtn.style.color = "black";
        filterBtn.style.backgroundColor = "white";
        filterBtn.style.color = "black";
        sortBtn.style.backgroundColor = "white";
        sortBtn.style.color = "black";
        searchbar.style.borderRight = "none";
        const sortArea = document.getElementsByClassName("dropdown-btn")[0];
        const filterArea = document.getElementsByClassName("dropdown-filter-btn")[0];
        sortArea.style.backgroundColor = "white";
        sortArea.style.color = "black";

        filterArea.style.backgroundColor = "white";
        filterArea.style.color = "black";

        const form = document.getElementsByTagName("form")[0];
        form.style.backgroundColor = "white";
        form.style.color = "black";

        const sortOptions = document.getElementsByClassName("sort-options")[0];
        const filterOptions = document.getElementsByClassName("filter-options")[0];

        sortOptions.style.backgroundColor = "white";
        sortOptions.style.color = "black";

        filterOptions.style.backgroundColor = "white";
        filterOptions.style.color = "black";

        const filterBtnDown = document.getElementById("filter-btn-submit");
        filterBtnDown.style.backgroundColor = "white";
        filterBtnDown.style.color = "black";

        const sortOptionsBtns = document.getElementsByClassName("options-btn");
        Array.from(sortOptionsBtns).forEach(function(btn){
            btn.style.backgroundColor = "white";
            btn.style.color = "black";
        });

    }
    else{
        //mode is in light mode -> change to dark mode
        mode = "dark";
        //change background colour
        const content = document.getElementsByClassName("content")[0];
        content.style.backgroundColor = "black";
        const searchArea = document.getElementsByClassName("search-bar")[0];
        searchArea.style.backgroundColor = "black";
        const searchbar = document.getElementsByName("search")[0];
        searchbar.style.backgroundColor = "black";
        searchbar.style.color = "black";
        searchbar.style.borderBottomColor = "white";

        const searchBtn = document.getElementsByClassName("search-btn")[0];
        const filterBtn = document.getElementById("filter-btn");
        const sortBtn = document.getElementById("sort-btn");
        const sortArea = document.getElementsByClassName("dropdown-btn")[0];
        const filterArea = document.getElementsByClassName("dropdown-filter-btn")[0];
        const sortOptions = document.getElementsByClassName("sort-options")[0];
        const filterOptions = document.getElementsByClassName("filter-options")[0];
        searchBtn.style.backgroundColor = "black";
        searchBtn.style.color = "white";
        filterBtn.style.backgroundColor = "black";
        filterBtn.style.color = "white";
        sortBtn.style.backgroundColor = "black";
        sortBtn.style.color = "white";

        sortArea.style.backgroundColor = "black";
        sortArea.style.color = "white";

        sortOptions.style.backgroundColor = "black";
        sortOptions.style.color = "white";

        filterOptions.style.backgroundColor = "black";
        filterOptions.style.color = "white";

        filterArea.style.backgroundColor = "black";
        filterArea.style.color = "white";
        const form = document.getElementsByTagName("form")[0];
        form.style.backgroundColor = "black";
        form.style.color = "white";

        const filterBtnDown = document.getElementById("filter-btn-submit");
        filterBtnDown.style.backgroundColor = "black";
        filterBtnDown.style.color = "white";

        const sortOptionsBtns = document.getElementsByClassName("options-btn");
        Array.from(sortOptionsBtns).forEach(function(btn){
            btn.style.backgroundColor = "black";
            btn.style.color = "white";
        });
    }
}

function modeChangeBrands(){
    if(mode === "dark")
    {
        mode = "light";
        const background = document.getElementsByClassName("content")[0];
        background.style.backgroundColor = "white";
    }
    else{
        mode = "dark";
        const background = document.getElementsByClassName("content")[0];
        background.style.backgroundColor = "black";
    }

}

function checkBrands(){
    //checks the state of the mode to carry over to other pages
    if(mode === "dark")
    {
        const background = document.getElementsByClassName("content")[0];
        background.style.backgroundColor = "black";
    }
    else{
        const background = document.getElementsByClassName("content")[0];
        background.style.backgroundColor = "white";
    }
}

function checkCars()
{
    //used to check state of the light mode to carry over to other pages
    if(mode === "dark")
    {
        const content = document.getElementsByClassName("content")[0];
        content.style.backgroundColor = "black";
        const searchArea = document.getElementsByClassName("search-bar")[0];
        searchArea.style.backgroundColor = "black";
        const searchbar = document.getElementsByName("search")[0];
        searchbar.style.backgroundColor = "black";
        searchbar.style.color = "black";
        searchbar.style.borderBottomColor = "white";

        const searchBtn = document.getElementsByClassName("search-btn")[0];
        const filterBtn = document.getElementById("filter-btn");
        const sortBtn = document.getElementById("sort-btn");
        const sortArea = document.getElementsByClassName("dropdown-btn")[0];
        const filterArea = document.getElementsByClassName("dropdown-filter-btn")[0];
        const sortOptions = document.getElementsByClassName("sort-options")[0];
        const filterOptions = document.getElementsByClassName("filter-options")[0];
        searchBtn.style.backgroundColor = "black";
        searchBtn.style.color = "white";
        filterBtn.style.backgroundColor = "black";
        filterBtn.style.color = "white";
        sortBtn.style.backgroundColor = "black";
        sortBtn.style.color = "white";

        sortArea.style.backgroundColor = "black";
        sortArea.style.color = "white";

        sortOptions.style.backgroundColor = "black";
        sortOptions.style.color = "white";

        filterOptions.style.backgroundColor = "black";
        filterOptions.style.color = "white";

        filterArea.style.backgroundColor = "black";
        filterArea.style.color = "white";
        const form = document.getElementsByTagName("form")[0];
        form.style.backgroundColor = "black";
        form.style.color = "white";

        const filterBtnDown = document.getElementById("filter-btn-submit");
        filterBtnDown.style.backgroundColor = "black";
        filterBtnDown.style.color = "white";

        const sortOptionsBtns = document.getElementsByClassName("options-btn");
        Array.from(sortOptionsBtns).forEach(function(btn){
            btn.style.backgroundColor = "black";
            btn.style.color = "white";
        });
    }
    else{
        const content = document.getElementsByClassName("content")[0];
        content.style.backgroundColor = "white";
        const searchArea = document.getElementsByClassName("search-bar")[0];
        searchArea.style.backgroundColor = "white";
        const searchbar = document.getElementsByName("search")[0];
        searchbar.style.backgroundColor = "white";
        searchbar.style.color = "black";
        searchbar.style.borderBottomColor = "black";
        const searchBtn = document.getElementsByClassName("search-btn")[0];
        const filterBtn = document.getElementById("filter-btn");
        const sortBtn = document.getElementById("sort-btn");
        searchBtn.style.backgroundColor = "white";
        searchBtn.style.color = "black";
        filterBtn.style.backgroundColor = "white";
        filterBtn.style.color = "black";
        sortBtn.style.backgroundColor = "white";
        sortBtn.style.color = "black";
        searchbar.style.borderRight = "none";
        const sortArea = document.getElementsByClassName("dropdown-btn")[0];
        const filterArea = document.getElementsByClassName("dropdown-filter-btn")[0];
        sortArea.style.backgroundColor = "white";
        sortArea.style.color = "black";

        filterArea.style.backgroundColor = "white";
        filterArea.style.color = "black";

        const form = document.getElementsByTagName("form")[0];
        form.style.backgroundColor = "white";
        form.style.color = "black";

        const sortOptions = document.getElementsByClassName("sort-options")[0];
        const filterOptions = document.getElementsByClassName("filter-options")[0];

        sortOptions.style.backgroundColor = "white";
        sortOptions.style.color = "black";

        filterOptions.style.backgroundColor = "white";
        filterOptions.style.color = "black";

        const filterBtnDown = document.getElementById("filter-btn-submit");
        filterBtnDown.style.backgroundColor = "white";
        filterBtnDown.style.color = "black";

        const sortOptionsBtns = document.getElementsByClassName("options-btn");
        Array.from(sortOptionsBtns).forEach(function(btn){
            btn.style.backgroundColor = "white";
            btn.style.color = "black";
        });
    }
}

function modeChangeCompare(){
    if(mode === "dark")
    {
        mode = "light";
        const content = document.getElementsByClassName("content")[0];
        const block = document.getElementsByClassName("card black-card")[0];
        const container = document.getElementById("compare-container");
        content.style.backgroundColor = "white";
        container.style.backgroundColor = "white";
        block.style.backgroundColor = "white";
        //card black-card
    }
    else{
        mode = "dark";
        const content = document.getElementById("compare-container");
        const container = document.getElementsByClassName("content")[0];
        const block = document.getElementsByClassName("card black-card")[0];
        content.style.backgroundColor = "black";
        container.style.backgroundColor = "black";
        block.style.backgroundColor = "black";
    }
}

function modeChangeFind(){
    //
    const background = document.getElementsByClassName("content")[0];
    const form = document.getElementsByClassName("form-container")[0];
    const rightContainer = document.getElementsByClassName("right-container")[0];
    const heading = document.getElementById("form-heading");
    const labels = document.getElementsByTagName("label");

    if(mode === "dark")
    {
        mode = "light";
        background.style.backgroundColor = "white";
        form.style.backgroundColor = "white";
        form.style.color = "black";
        rightContainer.style.backgroundColor = "white";
        rightContainer.style.color = "black";
        heading.style.color = "black";
        Array.from(labels).forEach(function(btn){
            /*btn.style.backgroundColor = "white";*/
            btn.style.color = "black";
        });
    }
    else{
        mode = "dark";
        background.style.backgroundColor = "black";
        form.style.backgroundColor = "black";
        form.style.color = "white";
        rightContainer.style.backgroundColor = "black";
        rightContainer.style.color = "white";
        heading.style.color = "white";
        Array.from(labels).forEach(function(btn){
            /*btn.style.backgroundColor = "black";*/
            btn.style.color = "white";
        });
    }
}