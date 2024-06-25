document.getElementById('weatherForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const city = document.getElementById('city').value;
    fetch(`weather.php?city=${city}`)
        .then(response => response.json())
        .then(data => {
            const weatherData = document.getElementById('weatherData');
            if (data.error) {
                weatherData.innerHTML = `<p>${data.error}</p>`;
            } else if (data.name && data.sys && data.main && data.weather) {
                weatherData.innerHTML = `
                    <h2>${data.name}, ${data.sys.country}</h2>
                    <p>Temperature: ${data.main.temp}°C</p>
                    <p>Weather: ${data.weather[0].description}</p>
                    <p>Humidity: ${data.main.humidity}%</p>
                `;
            } else {
                weatherData.innerHTML = `<p>Invalid data received from the API.</p>`;
            }
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            document.getElementById('weatherData').innerHTML = `<p>Error fetching weather data.</p>`;
        });
});
