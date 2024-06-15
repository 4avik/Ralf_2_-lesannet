<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import WeatherSearch from '@/Components/WeatherSearch.vue';

const props = defineProps({
    blogs: Object,
    users: Object,
    weatherData: Object
})
console.log(props.weatherData)
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Weather</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <WeatherSearch />
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 flex gap-4 items-center justify-between">
                        <div class="flex items-center gap-4">
                            <h1 class="font-bold">{{ props.weatherData.name }} </h1>
                            <p>{{ props.weatherData.weather[0].description }}</p>
                            <img :src="'https://openweathermap.org/img/wn/' + props.weatherData.weather[0].icon + '.png'" alt="">
                            <p>{{ props.weatherData.main.temp }}<sup>c</sup> (feels like: {{ props.weatherData.main.feels_like }}<sup>c</sup>)</p>
                            <p>Clouds: {{ props.weatherData.clouds.all }}%</p>
                            <p>Humidity: {{ props.weatherData.main.humidity }}%</p>
                        </div>
                        <div>
                            <p>Lon: {{ props.weatherData.coord.lon }}<sup>o</sup></p>
                            <p>Lat: {{ props.weatherData.coord.lat }}<sup>o</sup></p>
                        </div>
                    </div>
                </div>
                <Link :href="route('blog.create')" class="p-2 bg-white rounded-lg shadow-sm" v-if="$page.props.auth.user.level === 'admin'">Uus postitus</Link>
                <div v-for="blog in props.blogs" :key="blog.id">
                    <Blog :blog="blog" :users="props.users"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
