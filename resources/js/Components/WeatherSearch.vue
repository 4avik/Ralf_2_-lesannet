<template>
    <div>
        <input
            type="text"
            v-model="query"
            @keypress.enter="searchWeather"
            placeholder="Enter city name"
            class="search-box"
        />
        <div v-if="weatherData">
            <h1 class="font-bold">{{ weatherData.name }} </h1>
            <p>{{ weatherData.weather[0].description }}</p>
            <img :src="'https://openweathermap.org/img/wn/' + weatherData.weather[0].icon + '.png'" alt="">
            <p>{{ weatherData.main.temp }}<sup>c</sup> (feels like: {{ weatherData.main.feels_like }}<sup>c</sup>)</p>
            <p>Clouds: {{ weatherData.clouds.all }}%</p>
            <p>Humidity: {{ weatherData.main.humidity }}%</p>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const query = ref('');
const weatherData = ref(null);

const searchWeather = async () => {
    try {
        const response = await fetch(`/search-weather?city=${query.value}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        weatherData.value = await response.json();
    } catch (error) {
        console.error('Error fetching weather data:', error);
        alert('Error fetching weather data. Please try again.');
    }
};
</script>

<style scoped>
.search-box {
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
}
</style>
