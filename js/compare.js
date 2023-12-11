/*Hayley Dodkins 21528790*/
// Define the CORS Anywhere proxy URL
const corsProxyUrl = "https://cors-anywhere.herokuapp.com/";

const apikey = "jtNHItJM5pkouGLf"
const studentNum = "u21528790";
//array of brand names
const brands = ["Alfa Romeo", "Aston Martin", "Audi", "AC","BMW","Bugatti","Ferrari","Genesis","Jaguar","Lamborghini","Maybach","Mercedes-Benz","Mini","Porsche","Rolls-Royce"]
/*array for models*/
var models = [];

var carArr = [];



var totalRequests = brands.length; // Total number of requests to make
var completedRequests = 0; // Counter for completed requests


/*max car limit */
const carLimit = 9 + 9 + 7 + 30 + 2 + 9 + 23 + 4 + 3 + 10 +11 + 32 + 33 + 18 +10;
function showLoadingSpinner() {
    const carImages = document.getElementsByClassName("car-img-container");
    const carNames = [document.getElementById("car-1-name"),document.getElementById("car-2-name"),document.getElementById("car-3-name")]
    for(var i = 0; i < 3; i++)
    {
        carImages[i].style.display = 'none';
        carNames[i].style.display = 'none';
    }
    var spinners = [document.getElementById('loading-spinner'),document.getElementById('loading-spinner2'),document.getElementById('loading-spinner3')];
    for(var j = 0; j < 3; j++)
    {
        spinners[j].style.display = "flex";

    }

}

function hideLoadingSpinner() {
    const carImages = document.getElementsByClassName("car-img-container");
    const carNames = [document.getElementById("car-1-name"),document.getElementById("car-2-name"),document.getElementById("car-3-name")]
    for(var i = 0; i < 3; i++)
    {
        carImages[i].style.display = 'flex';
        carNames[i].style.display = 'flex';
    }
    var spinners = [document.getElementById('loading-spinner'),document.getElementById('loading-spinner2'),document.getElementById('loading-spinner3')];
    for(var j = 0; j < 3; j++)
    {
        spinners[j].style.display = "none";

    }
}

showLoadingSpinner();

/*call API and get image for the car*/
function ApiCallImage(model,brandName, callback) {
    const defaultUrl = "https://dealeraccelerate-all.s3.amazonaws.com/fastlane/marketing_assets/428/90020_a1909487_v2.jpg";
    var xhr = new XMLHttpRequest();
    var url =  "https://wheatley.cs.up.ac.za/api/getimage";
    var params = `brand=${brandName}&&model=${model}`;

    // Append the parameters to the URL
    url += "?" + params;

    xhr.open("GET", url, true);

    

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
                var responseData = xhr.responseText;
                callback(responseData); // Call the callback function with the response data
            } else {
                // Handle an error (e.g., display an error message)
                console.error("Request failed with status:", xhr.status);
                callback(defaultUrl); // Call the callback function with the default URL
            }

    };

    // Send the request to the API
    xhr.send();

    xhr.onerror = function () {
        console.error("Request failed due to a network error or server issue.");
        callback(defaultUrl); // Call the callback function with the default URL
    };
}

/*api call to get all the models of the brands*/
function ApiCallModel(brandName, callback) {
    const defaultUrl = "https://dealeraccelerate-all.s3.amazonaws.com/fastlane/marketing_assets/428/90020_a1909487_v2.jpg";
    var xhr = new XMLHttpRequest();
    var url =  "../api2.php";
    var params = {
        type:`GetAllCars`,
        limit:100,
        apikey:`${apikey}`,
        fuzzy: false,
        search:{make:`${brandName}`},
        return:[
            "make","model","year_from","number_of_seats","engine_type","drive_wheels","max_speed_km_per_h","transmission"
        ]
    };

    var requestBody = JSON.stringify(params);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                /*returns an array of objects*/
                console.log(xhr.responseText);
                var responseData = JSON.parse(xhr.responseText);

                callback(responseData); // Call the callback function with the response data
            } else {
                // Handle an error (e.g., display an error message)
                console.error("Request failed with status:", xhr.status);
                callback(defaultUrl); // Call the callback function with the default URL
            }
        }
    };

    xhr.open("POST", url, true);

    // Set the Content-Type header BEFORE sending the request
    xhr.setRequestHeader("Content-Type", "application/json");

    // Send the request to the API
    xhr.send(requestBody);

    xhr.onerror = function () {
        console.error("Request failed due to a network error or server issue.");
        callback(defaultUrl); // Call the callback function with the default URL
    };
}

// Function to call the API for a brand and store the model data
var count = 0;
function callApiAndStoreData(brandName) {
    ApiCallModel(brandName, function (carData) {
        const carArray = carData.data;
        // Store the data in an array using the model as the key
        for(var i = 0; i < carArray.length;i++)
        {
            /*for each object add into the models array*/
            models[carArray[i].model] = carArray[i];
            carArr.push(carArray[i]);
        }
        completedRequests++;

        // Check if all requests are completed
        if (completedRequests === totalRequests) {
            console.log(models.length+ " models have been loaded.")
            processData(models);

        }
        else{

        }
    });
}

/*Function loads attribute values into the table*/
function loadAttributes(carNum,speed,year,fuel,gearbox,drive,seats)
{
    var carSpeed;
    var carYear;
    var carFuel;
    var carGear;
    var carDrive;
    var carSeats;

    if(carNum === 1)
    {
        /*get all elements*/
        carSpeed = document.getElementById('top-speed-1').children[0];
        carYear = document.getElementById('year-1').children[0];
        carFuel = document.getElementById('fuel-type-1').children[0];
        carGear = document.getElementById('gear-box-1').children[0];
        carDrive = document.getElementById('drive-1').children[0];
        carSeats = document.getElementById('seats-1').children[0];

    }
    else if (carNum === 2)
    {
        /*get all elements*/
        carSpeed = document.getElementById('top-speed-2').children[0];
        carYear = document.getElementById('year-2').children[0];
        carFuel = document.getElementById('fuel-type-2').children[0];
        carGear = document.getElementById('gear-box-2').children[0];
        carDrive = document.getElementById('drive-2').children[0];
        carSeats = document.getElementById('seats-2').children[0];
    }
    else{
        /*get all elements*/
        carSpeed = document.getElementById('top-speed-3').children[0];
        carYear = document.getElementById('year-3').children[0];
        carFuel = document.getElementById('fuel-type-3').children[0];
        carGear = document.getElementById('gear-box-3').children[0];
        carDrive = document.getElementById('drive-3').children[0];
        carSeats = document.getElementById('seats-3').children[0];
    }

    /*set all text values*/
    carSpeed.textContent = speed + " km/h";
    carYear.textContent = year;
    carFuel.textContent = fuel;
    carGear.textContent = gearbox;
    carDrive.textContent = drive;
    carSeats.textContent = seats;
}

/*function changes the car card*/
function changeCard(carNum,imageUrl,carName,brandName)
{
    if(carNum == 1)
    {
        /*get the car image*/
        var carImage = document.getElementById("car-img-1");
        /*change the url*/
        carImage.style.backgroundImage = `url('${imageUrl}')`;

        /*get the car name*/
        var name = document.getElementById("car-1-name");
        /*chnage the name*/
        name.textContent = brandName + " " + carName;
    }
    else if(carNum == 2)
    {
        /*get the car image*/
        var carImage = document.getElementById("car-img-2");
        /*change the url*/
        carImage.style.backgroundImage = `url('${imageUrl}')`;

        /*get the car name*/
        var name = document.getElementById("car-2-name");
        /*chnage the name*/
        name.textContent = brandName + " " + carName;
    }
    else{
        /*get the car image*/
        var carImage = document.getElementById("car-img-3");
        /*change the url*/
        carImage.style.backgroundImage = `url('${imageUrl}')`;

        /*get the car name*/
        var name = document.getElementById("car-3-name");
        /*chnage the name*/
        name.textContent = brandName + " " + carName;
    }
}

/*/!*function looks at the attribute values and highlights winner and loser*!/
function winLose()
{
    /!*comapre all speeds*!/
    var speed1 = document.getElementById('top-speed-1');
    var speed2 = document.getElementById('top-speed-2');
    var speed3 = document.getElementById('top-speed-3');
    var topSpeed = speed1;
    var minSpeed = speed1;
    var speeds = [speed1,speed2,speed3];
    speeds.forEach(function(speed){
        if(speed.textContent > topSpeed.textContent)
        {
            topSpeed = speed;
        }
        if(speed.textContent < minSpeed.textContent)
        {
            minSpeed = speed;
        }
    });
    topSpeed.style.color = "#69CD15";
    minSpeed.style.color = "red";

    /!*compare year*!/
    var year1 = document.getElementById('year-1');
    var year2 = document.getElementById('year-2');
    var year3 = document.getElementById('year-3');
    var young = year1;
    var old = year1;
    var years = [year1,year2,year3];
    years.forEach(function(year){
        if(year.textContent > young.textContent)
        {
            young = year;
        }
        if(year.textContent < old.textContent)
        {
            old = year;
        }
    });
    young.style.color = "#69CD15";
    old.style.color = "red";


}
winLose();*/

// Loop through the brand names and call the API for each one
brands.forEach(callApiAndStoreData);

// Function to process data after all API calls are done
function processData(models) {
    /*populateCards();*/
    /*console.log(models)*/
    /*car 1 auto load on this car by default*/
    loadAttributes(1,models["A1"].max_speed_km_per_h,models["A1"].year_from,models["A1"].engine_type,models["A1"].transmission,models["A1"].drive_wheels,models["A1"].number_of_seats)
    ApiCallImage(models["A1"].model,models["A1"].make,function(imageUrl){
        changeCard(1,imageUrl,models["A1"].model,models["A1"].make);
    });
    loadAttributes(1,models["A1"].max_speed_km_per_h,models["A1"].year_from,models["A1"].engine_type,models["A1"].transmission,models["A1"].drive_wheels,models["A1"].number_of_seats)
    ApiCallImage(models["A1"].model,models["A1"].make,function(imageUrl){
        changeCard(1,imageUrl,models["A1"].model,models["A1"].make);
    });
    /*car 2 auto load on this car by default*/
    loadAttributes(2,models["Cooper S"].max_speed_km_per_h,models["Cooper S"].year_from,models["Cooper S"].engine_type,models["Cooper S"].transmission,models["Cooper S"].drive_wheels,models["Cooper S"].number_of_seats)
    ApiCallImage(models["Cooper S"].model,models["Cooper S"].make,function(imageUrl){
        changeCard(2,imageUrl,models["Cooper S"].model,models["Cooper S"].make);
    });
    /*car 3 auto load on this car by default*/
    loadAttributes(3,models["Aventador"].max_speed_km_per_h,models["Aventador"].year_from,models["Aventador"].engine_type,models["Aventador"].transmission,models["Aventador"].drive_wheels,models["Aventador"].number_of_seats)
    ApiCallImage(models["Aventador"].model,models["Aventador"].make,function(imageUrl){
        changeCard(3,imageUrl,models["Aventador"].model,models["Aventador"].make);
    });

    hideLoadingSpinner();

}

//code for functional popup screen
// Function to open the popup
var carNumber = 0;
function openPopup(carnum) {
    var popup = document.getElementById("carPopup");
    popup.style.display = "flex";
    carNumber = carnum;
}

// Function to close the popup
function closePopup() {
    var popup = document.getElementById("carPopup");
    popup.style.display = "none";
}

// Function to search for cars
function searchCars() {
    var input = document.getElementById("searchInput").value.toLowerCase();
    var carList = document.getElementById("carList");
    var cars = carArr;

    // Clear the current list
    carList.innerHTML = "";

    // Filter and display matching cars
    cars.forEach(function(car)
    {
        var carName = car.make + " " + car.model;
        if (carName.toLowerCase().includes(input)) {
            var listItem = document.createElement("li");
            listItem.onclick = function(){
                ApiCallImage(car.model,car.make,function(imageUrl){
                    changeCard(carNumber,imageUrl,car.model,car.make);
                });

                loadAttributes(carNumber,car.max_speed_km_per_h,car.year_from,car.engine_type,car.transmission,car.drive_wheels,car.number_of_seats);
                closePopup();
            };
            listItem.textContent = carName;
            carList.appendChild(listItem);
        }
    });
}

// Add an event listener for the search input
document.getElementById("searchInput").addEventListener("input", searchCars);









