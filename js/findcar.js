/*Hayley Dodkins 21528790*/
const apikey = "jtNHItJM5pkouGLf"
const studentNum = "u21528790";
/*brands array*/
const brands = ["Alfa Romeo", "Aston Martin", "Audi", "AC","BMW","Bugatti","Ferrari","Genesis","Jaguar","Lamborghini","Maybach","Mercedes-Benz","Mini","Porsche","Rolls-Royce"]

/*array stores cars from API*/
var carArr = [];

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
        return:"*"
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

/*this function iss used to validate the data before anything is submitted*/
function checkValues(){
    // Get references to all the form elements
    var driveWheels = document.getElementById("drive-wheels");
    var bodyType = document.getElementById("body-type");
    var seats = document.getElementById("seats");
    var transmissionAuto = document.getElementById("transmission-type-auto");
    var transmissionManual = document.getElementById("transmission-type-man");
    var fuzzySearch = document.getElementById("fuzzy-search");
    var fuelTypeGasoline = document.getElementById("fuel-type-gasoline");
    var fuelTypeDiesel = document.getElementById("fuel-type-diesel");
    var fuelTypeHybrid = document.getElementById("fuel-type-hybrid");
    var fuelTypeElectric = document.getElementById("fuel-type-electric");

    console.log(driveWheels.value);
    // Check if any of the fields are empty
    if (driveWheels.value === "" || bodyType.value === "" || seats.value === "" || (!transmissionAuto.checked && !transmissionManual.checked) || (!fuzzySearch.checked) || (!fuelTypeGasoline.checked && !fuelTypeDiesel.checked && !fuelTypeHybrid.checked && !fuelTypeElectric.checked))
    {
        // Display an error message
        alert("Please fill in all the required fields.");
    } else {
        // All fields are filled -> can proceed with form submission
        filterCars();
    }
}

/*gathers the data from the form to get the matching cars*/
function filterCars() {
    /*hide the form*/
    const form = document.getElementById("form-container");
    form.style.display = "none";

    const contentArea = document.getElementsByClassName("content-card-area")[0];
    contentArea.style.display = "grid";

    var cars = carArr;
    var  filteredCarList= [];
    var driveWheels = document.getElementById("drive-wheels");
    var bodyType = document.getElementById("body-type");
    var seats = document.getElementById("seats");
    var transmissionAuto = document.getElementById("transmission-type-auto");
    var transmissionManual = document.getElementById("transmission-type-man");
    var fuelTypeGasoline = document.getElementById("fuel-type-gasoline");
    var fuelTypeDiesel = document.getElementById("fuel-type-diesel");
    var fuelTypeHybrid = document.getElementById("fuel-type-hybrid");
    var fuelTypeElectric = document.getElementById("fuel-type-electric");
    var fuzzySearch = document.getElementById("fuzzy-search");

    /*get the selected values for each field*/
    driveWheels = driveWheels.value;
    bodyType = bodyType.value;
    seats = seats.value;
    var transmission = "";
    if(transmissionAuto.checked)
    {
        transmission = transmissionAuto.value;
    }
    else{
        transmission =transmissionManual.value;
    }
    var fuel = "";
    if(fuelTypeGasoline.checked)
    {
        fuel = fuelTypeGasoline.value;
    }
    else if(fuelTypeDiesel.checked)
    {
        fuel = fuelTypeDiesel.value;
    }
    else if(fuelTypeHybrid.checked)
    {
        fuel = fuelTypeHybrid.value;
    }
    else{
        fuel = fuelTypeElectric.value;
    }
    var fuzzy = false;
    if(fuzzySearch.checked){
        fuzzy = true;
    }

    /*now have all the values pass into the api*/
    var FilteredCars = [];
    var j = 0;

    for(var i = 0; i < carArr.length;i++)
    {

        if(carArr[i].drive_wheels === driveWheels)
        {
            console.log(carArr[i].drive_wheels + " === " + driveWheels);
            if(carArr[i].transmission === transmission)
            {
                if(carArr[i].engine_type === fuel)
                {
                    FilteredCars.push(carArr[i]);
                }
            }
        }
        else{
            console.log(carArr[i].drive_wheels + " ! " + driveWheels);
        }
    }
    console.log(FilteredCars);
    displayFilteredCars(FilteredCars);
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
