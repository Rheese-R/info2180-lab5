
document.addEventListener('DOMContentLoaded', function () {

    const lookupButton = document.getElementById('lookup');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    lookupButton.addEventListener('click', function () {

        const country = countryInput.value;

        fetch('world.php?country=' + encodeURIComponent(country))
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                resultDiv.textContent = 'An error occurred while retrieving the country information.';
                console.error('Error:', error);
            });

    });

});
