
document.addEventListener('DOMContentLoaded', function () {

    const lookupButton = document.getElementById('lookup');
    const lookupCitiesButton = document.getElementById('lookupCities');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    // Function to retrieve information from world.php
    function performLookup(type) {

        const country = countryInput.value;

        let url = 'world.php?country=' + encodeURIComponent(country);

        if (type === 'cities') {
            url += '&lookup=cities';
        }

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                resultDiv.textContent = 'An error occurred while retrieving the information.';
                console.error('Error:', error);
            });
    }

    // Look up countries
    lookupButton.addEventListener('click', function () {
        performLookup('countries');
    });

    // Look up cities
    lookupCitiesButton.addEventListener('click', function () {
        performLookup('cities');
    });

});