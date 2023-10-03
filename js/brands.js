/*brands array*/
const brands = ["Alfa Romeo", "Aston Martin", "Audi", "AC","BMW","Bugatti","Ferrari","Genesis","Jaguar","Lamborghini","Maybach","Mercedes-Benz","Mini","Porsche","Rolls-Royce"]

// Array to store image URLs
var imageUrls = [];

// Create an object to map brand names to their image URLs
const brandImageMap = {};

/*call API and get image for the brand*/
function ApiCall(brandName, callback) {
    const defaultUrl = "https://dealeraccelerate-all.s3.amazonaws.com/fastlane/marketing_assets/428/90020_a1909487_v2.jpg";
    var xhr = new XMLHttpRequest();
    var url = "https://wheatley.cs.up.ac.za/api/getimage";
    var params = `brand=${brandName}`;

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

// Function to call the API for a brand and store the URL
function callApiAndStoreUrl(brandName) {
    ApiCall(brandName, function (imageUrl) {
        // Store the URL in the brandImageMap using the brandName as the key
        brandImageMap[brandName] = imageUrl;

        /*// Push the URL into the array
        imageUrls.push(imageUrl);*/

        // Check if all requests are completed
        if (Object.keys(brandImageMap).length  === brands.length) {
            console.log("image urls have been loaded.")
            processData(brandImageMap);
        }
    });
}

// Loop through the brand names and call the API for each one
brands.forEach(callApiAndStoreUrl);

/*function creates new brand card*/
function brandCard(imageUrl,brandName)
{
    /*create the card*/
    var card = document.createElement('div');
    card.classList.add("content-card");

    /*create picture area*/
    var row1 = document.createElement("div");
    row1.classList.add("row-1");

    /*/!*create link -> set the link destination*!/
    var brandLink = document.createElement("a");
    brandLink.setAttribute("href","Cars.html");*/

    /*creat pictureArea div*/
    var pictureArea = document.createElement("div");
    pictureArea.classList.add("brand-pic");

    /*Create brand image -> set image url*/
    var image = document.createElement("div");
    image.classList.add("brand-logo");
    image.style.backgroundImage = `url('${imageUrl}')`;

    /*add into hierarchy*/
    card.appendChild(row1);
    row1.appendChild(pictureArea);
    /*brandLink.appendChild(pictureArea);*/
    pictureArea.appendChild(image);

    /*create second row of card*/
    var row2 = document.createElement("div");
    row1.classList.add("row-2");

    /*create link -> set the link destination*/
    var brandLink2 = document.createElement("a");
    brandLink2.setAttribute("href","Cars.html");

    /*create name area div*/
    var textArea = document.createElement("div");
    textArea.classList.add("brand-name");

    /*create text - > set text*/
    var name = document.createElement("h2");
    name.textContent = brandName;

    /*add into hierarchy*/
    card.appendChild(row2);
    row2.appendChild(brandLink2);
    brandLink2.appendChild(textArea);
    textArea.appendChild(name);

    /*add id to the card*/
    card.setAttribute("id", `${removeSpaces(brandName)}`);

    /*return the created card*/
    return card;
}



/*populate the page*/
function populateCards()
{
    /*add to content area*/
    const contentArea = document.getElementsByClassName("content")[0];

    /*index for the brands array*/
    var index = 0;
    //15 brands = 5 content areas
    for(var i = 0; i < 5; i++)
    {
        //create content-card-area
        var area = document.createElement('div');
        area.classList.add("content-card-area");

        var card1;
        var card2;
        var card3;
        //add 3 brand cards to the area
        if(index < 15)
        {
            card1 = brandCard(brandImageMap[brands[index]],brands[index]);
            index++;
            card2 = brandCard(brandImageMap[brands[index]],brands[index]);
            index++;
            card3 = brandCard(brandImageMap[brands[index]],brands[index]);
            index++;
        }

        /*add cards to content area*/
        area.appendChild(card1);
        area.appendChild(card2);
        area.appendChild(card3);

        /*add area to content area*/
        contentArea.appendChild(area);
    }
}



//removes the space between words for id of the card
function removeSpaces(inputString) {
    return inputString.replace(/ /g, '');
}

// Function to process data after all API calls are done
function processData() {
    populateCards();
}





