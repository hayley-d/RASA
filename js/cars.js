/*u21528790 Hayley Dodkins*/
const apikey = "jtNHItJM5pkouGLf"
const studentNum = "u21528790";

/*brands array*/
const brands = ["Alfa Romeo", "Aston Martin", "Audi", "AC","BMW","Bugatti","Ferrari","Genesis","Jaguar","Lamborghini","Maybach","Mercedes-Benz","Mini","Porsche","Rolls-Royce"]

/*Brands arrays for the filtering*/
const brandsAI = ["Alfa Romeo", "Aston Martin", "Audi", "AC","BMW","Bugatti","Ferrari","Genesis"];
const brandsJQ = ["Jaguar","Lamborghini","Maybach","Mercedes-Benz","Mini","Porsche"];
const brandsRZ = ["Rolls-Royce"];

/*array stores cars from API*/
var carArr = [];

var filtered = [];

var totalRequests = brands.length; // Total number of requests to make
var completedRequests = 0; // Counter for completed requests

/*loading spinner*/
function showLoadingSpinner() {
    var spinner = document.getElementById('loading-spinner');
    spinner.style.display = "flex";
}

function hideLoadingSpinner() {
    var spinner = document.getElementById('loading-spinner');
    spinner.style.display = "none";
}

showLoadingSpinner();

/*function to create new card*/
function contentCard(imageUrl,CarName,price, fuelType,acceleration,gearbox)
{
    /*main card*/
    var newCard = document.createElement('div');
    newCard.classList.add("content-card");

    /*picture div*/
    var carPicArea = document.createElement('div');
    carPicArea.classList.add("car-pic");
    var carPic = document.createElement('div');
    carPic.classList.add("car-img");
    carPicArea.appendChild(carPic);
    carPic.style.backgroundImage = `url('${imageUrl}')`;

    /*car name element*/
    var carNameArea = document.createElement('div');
    carNameArea.classList.add('car-name');
    var carName = document.createElement('h2');
    carName.textContent = CarName;
    carNameArea.appendChild(carName);
    var rule = document.createElement('hr');

    /*car price info*/

    var carPriceArea = document.createElement('div');
    carPriceArea.classList.add('car-info');
    var carPrice = document.createElement('p');
    carPrice.textContent = price;
    carPriceArea.appendChild(carPrice);

    /*Car fuel type info*/
    var carFuelArea = document.createElement('div');
    carFuelArea.classList.add('car-info');
    var carFuel = document.createElement('p');
    carFuel.textContent = fuelType;
    carFuelArea.appendChild(carFuel);

    /*Car acceleration info*/

    var carAccArea = document.createElement('div');
    carAccArea.classList.add('car-info');
    var carAcc = document.createElement('p');
    carAcc.textContent = acceleration;
    carAccArea.appendChild(carAcc);

    /*Car gearbox info*/
    var carGearArea = document.createElement('div');
    carGearArea.classList.add('car-info');
    var carGear = document.createElement('p');
    carGear.textContent = gearbox;
    carGearArea.appendChild(carGear);

    /*add all elements as children to the card*/
    newCard.appendChild(carPicArea);
    newCard.appendChild(carNameArea);
    newCard.appendChild(rule);
    newCard.appendChild(carPriceArea);
    newCard.appendChild(carFuelArea);
    newCard.appendChild(carAccArea);
    newCard.appendChild(carGearArea);
    /*card has been created return the card*/
    return newCard;
}
/*call API and get image for the car*/
function ApiCallImage(model,brandName, callback) {
    const defaultUrl = "https://dealeraccelerate-all.s3.amazonaws.com/fastlane/marketing_assets/428/90020_a1909487_v2.jpg";
    var xhr = new XMLHttpRequest();
    var url =  "https://wheatley.cs.up.ac.za/api/getimage";
    var params = `brand=${brandName}&&model=${model}`;

    // Append the parameters to the URL
    url += "?" + params;

    xhr.open("GET", url, true);

    // Set the Content-Type header BEFORE sending the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var responseData = xhr.responseText;
                callback(responseData); // Call the callback function with the response data
            } else {
                // Handle an error (e.g., display an error message)
                console.error("Request failed with status:", xhr.status);
                callback(defaultUrl); // Call the callback function with the default URL
            }
        }
    };

    // Send the request to the API
    xhr.send();

    xhr.onerror = function () {
        console.error("Request failed due to a network error or server issue.");
        callback(defaultUrl); // Call the callback function with the default URL
    };
}
function ApiCallModel(brandName, callback) {
    const defaultUrl = "https://dealeraccelerate-all.s3.amazonaws.com/fastlane/marketing_assets/428/90020_a1909487_v2.jpg";
    var xhr = new XMLHttpRequest();
    var url =  "../api2.php";
    var params = {
        type:`GetAllCars`,
        limit:100,
        apikey:`${apikey}`,
        fuzzy: false,
        search:{
            make:`${brandName}`

        },
        return:[
            "make","model","year_from","number_of_seats","engine_type","drive_wheels","max_speed_km_per_h","transmission"
        ]
    };
    var requestBody = JSON.stringify(params);

    // Append the parameters to the URL
    url += "?" + params;

    xhr.open("POST", url, true);

    // Set the Content-Type header BEFORE sending the request
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                /*returns an array of objects*/
                var responseData = JSON.parse(xhr.responseText);

                callback(responseData); // Call the callback function with the response data
            } else {
                // Handle an error (e.g., display an error message)
                console.error("Request failed with status:", xhr.status);
                callback(defaultUrl); // Call the callback function with the default URL
            }
        }
    };

    // Send the request to the API
    xhr.send(requestBody);

    xhr.onerror = function () {
        console.error("Request failed due to a network error or server issue.");
        callback(defaultUrl); // Call the callback function with the default URL
    };
}
function callApiAndStoreData(brandName) {
    ApiCallModel(brandName, function (carData) {
        const carArray = carData.data;
        // Store the data in an array
        for(var i = 0; i < carArray.length;i++)
        {
            /*for each object add into the cars array*/
            carArr.push(carArray[i]);
        }
        completedRequests++;

        // Check if all requests are completed
        if (completedRequests === totalRequests) {
            console.log(carArr.length+ " models have been loaded.")
            processData(carArr);
        }
    });
}

function processData(carArr) {

    carArr.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });

    hideLoadingSpinner();
}

// Loop through the brand names and call the API for each one
brands.forEach(callApiAndStoreData);

/*sort implementation*/
function ascYear()
{
    deleteCards();

    var carArray = carArr;

    // Sort the carArray in ascending order by year
    carArray.sort((a, b) => a.year_from - b.year_from);
    carArray.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });
}

function decYear()
{
    deleteCards();
    var carArray = carArr;

    // Sort the carArray in ascending order by year
    carArray.sort((a, b) => b.year_from - a.year_from);
    console.log(carArray[0].year_from);
    carArray.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });
}

function ascName()
{
    console.log("hi");
    deleteCards();

    var carArray = carArr;

    // Sort the carArray in ascending order by year
    carArray.sort((a, b) => a.make.localeCompare(b.make));

    carArray.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });
}

function decName()
{
    deleteCards();
    var carArray = carArr;

    // Sort the carArray in ascending order by year
    carArray.sort((a, b) => b.make.localeCompare(a.make));
    console.log(carArray[0].year_from);
    carArray.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });
}

function ascSpeed()
{
    console.log("hi");
    deleteCards();

    var carArray = carArr;

    // Sort the carArray in ascending order by year
    carArray.sort((a, b) => a.max_speed_km_per_h - b.max_speed_km_per_h);
    carArray.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });
}

function decSpeed()
{
    deleteCards();
    var carArray = carArr;

    // Sort the carArray in ascending order by year
    carArray.sort((a, b) => b.max_speed_km_per_h - a.max_speed_km_per_h);

    carArray.forEach(function(car)
    {
        ApiCallImage(car.model,car.make,function(imageUrl){

            const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
            const area = document.getElementsByClassName("content-card-area")[0];
            area.appendChild(card);
        });
    });
}

function deleteCards()
{
    //delete current cards
    const cards = document.getElementsByClassName("content-card");
    const cardsArray = Array.from(cards);

    cardsArray.forEach(function(card) {
        card.remove();
    });

    const element = document.getElementById("error-res");
    if(element){
        element.remove();
    }
}


// Function to filter cars based on the search query
function searchCars(query) {
    var cars = carArr;
    query = query.toLowerCase();
    const results = cars.filter((car) => {
        const make = car.make.toLowerCase();
        const model = car.model.toLowerCase();
        return make.includes(query) || model.includes(query);
    });
    return results;
}

// Function to display search results
function displaySearchResults(results) {
    const area = document.getElementsByClassName("content-card-area")[0];
    const element = document.createElement("p");
    element.id = "error-res";
    deleteCards();

    if (results.length === 0) {
        element.textContent = "No results found.";
        area.appendChild(element);
    } else {
        results.forEach((car) => {
            ApiCallImage(car.model,car.make,function(imageUrl){

                const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
                area.appendChild(card);
            });
        });
    }
}

// Event listener for form submission
const searchBarForm = document.getElementById("search-bar");
searchBarForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Prevent the default form submission

    const searchInput = searchBarForm.elements.search;
    const searchQuery = searchInput.value;
    const searchResults = searchCars(searchQuery);

    displaySearchResults(searchResults);
});






// Function to filter cars based on selected checkboxes
function filterCars() {
    var cars = carArr;
    var  filteredCarList= [];
    const fuelCheckboxes = document.getElementsByClassName("fuel-check");
    const brandCheckboxes = document.getElementsByClassName("name-check");
    const gearboxCheckboxes = document.getElementsByClassName("transmission-check");

    var fuelSelected = [];
    var brandsSelected = [];
    var gearSelected = [];
    // Loop through the fuel checkboxes
    for (var i = 0; i < fuelCheckboxes.length; i++) {
        if (fuelCheckboxes[i].checked) {
            fuelSelected.push(fuelCheckboxes[i].value);
        }
    }

// Loop through the brand checkboxes
    for (var j = 0; j < brandCheckboxes.length; j++) {
        if (brandCheckboxes[j].checked) {
            brandsSelected.push(brandCheckboxes[j].value);
        }
    }

// Loop through the gearbox checkboxes
    for (var k = 0; k < gearboxCheckboxes.length; k++) {
        if (gearboxCheckboxes[k].checked) {
            gearSelected.push(gearboxCheckboxes[k].value);
        }
    }
    var filteredArray = cars;
    //apply filters
    //filter by fuel
    if(fuelSelected.length === 0)
    {
        //nothing selected apply nothing
    }
    else if(fuelSelected.length === 1)
    {
        filteredArray = filteredArray.filter(car => car.engine_type.toLowerCase() === fuelSelected[0]);

    }
    else if(fuelSelected.length === 2)
    {
        filteredArray = filteredArray.filter(car => car.engine_type.toLowerCase() === fuelSelected[0] || car.engine_type.toLowerCase() === fuelSelected[1]);
    }
    else if(fuelSelected.length === 3)
    {
        filteredArray = filteredArray.filter(car => car.engine_type.toLowerCase() === fuelSelected[0] || car.engine_type.toLowerCase() === fuelSelected[1] || car.engine_type.toLowerCase() === fuelSelected[2]);
    }

    /*apply gearbox filter*/
    if(gearSelected.length === 0)
    {
        //nothing selected apply nothing
    }
    else if (gearSelected.length === 1)
    {
        filteredArray = filteredArray.filter(car => car.transmission.toLowerCase() === gearSelected[0]);
    }
    else if (gearSelected.length === 2)
    {
        filteredArray = filteredArray.filter(car => car.transmission.toLowerCase() === gearSelected[0] || car.transmission.toLowerCase() === fuelSelected[1]);
    }

    var filteredArrayFinal = [];
    //filter by brand name
    if(brandsSelected.length === 0)
    {
        filteredArrayFinal = filteredArray;
    }
    else if(brandsSelected.length === 1)
    {
        if(brandsSelected[0] === "a"){
            brandsAI.forEach(function(brand){
                filteredArray.forEach(function(car){
                    if(car.make === brand){
                        filteredArrayFinal.push(car);
                    }
                });
            });
        }
        else if(brandsSelected[0] === "j"){
            brandsJQ.forEach(function(brand){
                filteredArray.forEach(function(car){
                    if(car.make === brand){
                        filteredArrayFinal.push(car);
                    }
                });
            });
        }
        else if(brandsSelected[0] === "r"){
            brandsRZ.forEach(function(brand){
                filteredArray.forEach(function(car){
                    if(car.make === brand){
                        filteredArrayFinal.push(car);
                    }
                });
            });
        }
    }
    else if(brandsSelected.length === 2)
    {
        if(brandsSelected[0] === "a" || brandsSelected[1] === "a"){
            brandsAI.forEach(function(brand){
                filteredArray.forEach(function(car){
                    if(car.make === brand){
                        filteredArrayFinal.push(car);
                    }
                });
            });
        }
        else if(brandsSelected[0] === "j" || brandsSelected[1] === "j"){
            brandsJQ.forEach(function(brand){
                filteredArray.forEach(function(car){
                    if(car.make === brand){
                        filteredArrayFinal.push(car);
                    }
                });
            });
        }
        else if(brandsSelected[0] === "r" || brandsSelected[1] === "r"){
            brandsRZ.forEach(function(brand){
                filteredArray.forEach(function(car){
                    if(car.make === brand){
                        filteredArrayFinal.push(car);
                    }
                });
            });
        }
    }
    else if(brandsSelected.length === 3)
    {
        filteredArrayFinal = filteredArray;
    }


    console.log(filteredArrayFinal);
    displayFilteredCars(filteredArrayFinal);
}

// Function to display filtered cars (implement as needed)
function displayFilteredCars(filteredCars) {
    console.log(filteredCars);
    // Clear the current list of displayed cars and add the filtered cars
    const area = document.getElementsByClassName("content-card-area")[0];
    const element = document.createElement("p");
    element.id = "error-res";
    deleteCards();

    if (filteredCars.length === 0) {
        element.textContent = "No cars match the selected filters.";
        area.appendChild(element);
    } else {
        filteredCars.forEach((car) => {
            ApiCallImage(car.model,car.make,function(imageUrl){
                const card = contentCard(imageUrl,car.make + " " + car.model,car.year_from,car.engine_type,car.transmission,car.drive_wheels);
                area.appendChild(card);
            });
        });
    }
    hideLoadingSpinner();
}

// Event listeners for checkbox changes and filter button click
const checkboxes = document.getElementsByClassName("cb");
const checkboxesArray = Array.from(checkboxes);
checkboxesArray.forEach((checkbox) => {
    checkbox.addEventListener("change", filterCars);
    showLoadingSpinner();
});


