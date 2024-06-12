<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ShoppingBagIcon, TrashIcon } from '@heroicons/vue/24/solid'
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    cart: Object
})

console.log(props.cart)
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Checkout</h2>
                <div class="flex items-center gap-4">
                    <!-- <h1 class="font-bold">{{ props.weatherData.name }} </h1>
                    <p>{{ props.weatherData.weather[0].description }}</p>
                    <img :src="`https://openweathermap.org/img/wn/{{weatherData.weather[0].icon}}.png`" alt="">
                    <p>{{ props.weatherData.main.temp }}<sup>c</sup> (feels like: {{ props.weatherData.main.feels_like }}<sup>c</sup>)</p>
                    <p>Clouds: {{ props.weatherData.clouds.all }}%</p>
                    <p>Humidity: {{ props.weatherData.main.humidity }}%</p> -->
                </div>
            </div>
        </template>
        <div class="p-24 flex flex-col gap-2">
            <div v-for="(i, index) in cart" class="w-full bg-white p-2 rounded-lg flex justify-between gap-4">
                <div class="flex gap-4">
                    <p>{{ i.name }}</p>
                    <p>Quantity: {{ i.quantity }}</p>
                    <p>${{ i.price }}</p>
                </div>
                <Link class="w-5" :href="route('shoppingCart.destroy', {id: index})" method="delete" as="button"><TrashIcon class="w-5 text-red-500" /></Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>