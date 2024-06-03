/*
    Script for managing the country/cities API
    @Author: JJ
*/

var country;
var cities;

/**
 * Set the cities of the country
 * @param {string} country 
 */
function setcities(event){
    //Enable the cities select
    cities.disabled = false;
    const country = event.target.options[event.target.selectedIndex].text;
    console.log(country);
    if (country === '' || country === null || country === undefined) {
        return;
    }

    const endpoint = 'https://countriesnow.space/api/v0.1/countries/cities';
    console.log(country);

    const body_json = {
        country: country
    };

    const headers = {
        'Content-Type': 'application/json'
    };

    fetch(endpoint, {
        method: 'POST',
        headers: headers,
        body: JSON.stringify(body_json)
    })
    .then(response => response.json())
    .then(data => {
        cities.innerHTML = '';
        data.data.forEach(city => {
            const option = document.createElement('option');
            option.value = city;
            option.text = city;
            cities.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function init(){
    country = document.getElementById('country');
    cities = document.getElementById('cities');
    country.addEventListener('change', setcities);
}

document.addEventListener('DOMContentLoaded', init);