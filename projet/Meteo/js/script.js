async function getWeather(lat,long) {

    const cityInput = document.getElementById('city');
    let cityName =cityInput.value;
  
    if (cityName.trim() === '') {
        alert('Veuillez entrer le nom d\'une ville.');
        return;
    }
  
    const apiKey = 'b124d6c291169e2116e7b5b3eb90b720';
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${long}&appid=${apiKey}&lang=fr`;
  
    try {
        const response = await fetch(url);
        const data = await response.json();
  
  
        if (data.cod === '404') {
            alert('Ville non trouvée. Veuillez vérifier le nom de la ville.');
        } else {
            let humidity = data.main.humidity
            console.log(data);
            let wind = (data.wind.speed * 3.6).toFixed(2)
            let pressure = (data.main.pressure / 100).toFixed(2)
            let visibility = (data.visibility /1000).toFixed(2)
            let degres= (data.main.temp-273.15).toFixed(2)

            document.querySelector('.location').textContent = `${data.name}, ${data.sys.country}`

            document.querySelector('#hvalue').textContent = `${humidity} %`
            document.querySelector('#rvalue').textContent = `${(data.main.feels_like - 273.15).toFixed(2)} °C`
            document.querySelector('#vvalue').textContent = `${visibility} km`
            document.querySelector('#wvalue').textContent = `${wind} km/h`
            document.querySelector('#pvalue').textContent = `${pressure} %`
            document.querySelector('#latvalue').textContent = `${data.coord.lat}°`
            document.querySelector('#longvalue').textContent = `${data.coord.lon}°`

            document.querySelector('.weather-temp').textContent = `${degres} °C`
            document.querySelector('.weather-desc').textContent = `${data.weather[0].description}`
            document.querySelector('.weather-icon').src = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`
        

            let loc = document.querySelector('.location-icon')
            loc.src ="./img/location.png";

            
            date();
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des données météorologiques:', error);
    }
}

function date() {
    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const dateActuelle = new Date();
    const dateFormatee = dateActuelle.toLocaleDateString('fr-FR', options);

    let date = dateFormatee.split(' ');
    let jour = date.shift()
    jour = jour.charAt(0).toUpperCase() + jour.slice(1)
    date = date.join(' ')

    console.log();
    document.querySelector('#date-day').textContent = jour;
    document.querySelector('#date').textContent = date;
    

    return
}

document.querySelector('#btn-loc').addEventListener('click',getCoordinates)
async function getCoordinates() {
    const cityName = document.getElementById('city').value;

    const apiUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(cityName)}`;

    try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        if (data.length > 0) {
            const location = data[0];
            const latitude = location.lat;
            const longitude = location.lon;

            console.log(`Coordonnées de ${cityName}: Latitude ${latitude}, Longitude ${longitude}`);
            getWeather(latitude,longitude)
        } else {
            console.error('Aucun résultat trouvé pour la ville spécifiée.');
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des coordonnées géographiques :', error);
    }
}

