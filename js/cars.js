/*function to create new card*/
function contentCard(imageUrl,CarName,price, fuelType,acceleration,gearbox)
{
    /*main card*/
    var newCard = document.createElement('div');
    newCard.classList.add("content-card");

    /*picture div*/
    var carPicLink = document.createElement('a');
    var carPicArea = document.createElement('div');
    carPicArea.classList.add('car-pic');
    carPicLink.appendChild(carPicArea);
    var carPic = document.createElement('div');
    carPic.classList.add("car-img");
    carPicArea.appendChild(carPic);
    carPic.style.backgroundImage = `url('${imageUrl}')`;

    /*car name element*/
    var carNameLink = document.createElement('a');
    var carNameArea = document.createElement('div');
    carNameArea.classList.add('car-name');
    var carName = document.createElement('h2');
    carName.textContent = CarName;
    carNameLink.appendChild(carNameArea);
    carNameArea.appendChild(carName);
    var rule = document.createElement('hr');

    /*car price info*/
    var carPriceLink = document.createElement('a');
    var carPriceArea = document.createElement('div');
    carPriceArea.classList.add('car-info');
    var carPrice = document.createElement('p');
    carPrice.textContent = price;
    carPriceLink.appendChild(carPriceArea);
    carPriceArea.appendChild(carPrice);

    /*Car fuel type info*/
    var carFuelLink = document.createElement('a');
    var carFuelArea = document.createElement('div');
    carFuelArea.classList.add('car-info');
    var carFuel = document.createElement('p');
    carFuel.textContent = fuelType;
    carFuelLink.appendChild(carFuelArea);
    carFuelArea.appendChild(carFuel);

    /*Car acceleration info*/
    var carAccLink = document.createElement('a');
    var carAccArea = document.createElement('div');
    carAccArea.classList.add('car-info');
    var carAcc = document.createElement('p');
    carAcc.textContent = acceleration;
    carAccLink.appendChild(carAccArea);
    carAccArea.appendChild(carAcc);

    /*Car gearbox info*/
    var carGearLink = document.createElement('a');
    var carGearArea = document.createElement('div');
    carGearArea.classList.add('car-info');
    var carGear = document.createElement('p');
    carGear.textContent = gearbox;
    carGearLink.appendChild(carGearArea);
    carGearArea.appendChild(carGear);

    /*add all elements as children to the card*/
    newCard.appendChild(carPicLink);
    newCard.appendChild(carNameLink);
    newCard.appendChild(rule);
    newCard.appendChild(carPriceLink);
    newCard.appendChild(carFuelLink);
    newCard.appendChild(carAccLink);
    newCard.appendChild(carGearLink);

    /*card has been created return the card*/
    return newCard;
}
