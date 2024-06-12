<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button'
import { ShoppingBagIcon, TrashIcon } from '@heroicons/vue/24/solid'
import Product from '@/Components/Product.vue';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import axios from 'axios';

const props = defineProps({
    products: Object,
    cart: Object
})

function getCartPrice() {
    let total = 0
    for (const i in props.cart) {
        total = +props.cart[i].price * props.cart[i].quantity  + +total
    }
    return total
}

function updateValue(item, id) {
    axios
        .post(route('shoppingCart.update', {item: item, id: id}))
}
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Store</h2>
                <DropdownMenu>
                    <DropdownMenuTrigger class="flex"><ShoppingBagIcon class="w-6"/><sup>{{ Object.keys(props.cart).length }}</sup></DropdownMenuTrigger>
                    <DropdownMenuContent>
                        <DropdownMenuLabel>Shopping Bag</DropdownMenuLabel>
                        <DropdownMenuSeparator />
                        <div class="max-h-48 overflow-auto flex flex-col gap-2 p-2">
                            <div v-for="(i, index) in cart" class="flex justify-between gap-6">
                                <p>{{ i.name }}</p>
                                <div class="flex gap-2">
                                    <p>{{ i.quantity }}</p>
                                    <p>${{ i.price }}</p>
                                    <Link class="w-5" :href="route('shoppingCart.destroy', {id: index})" method="delete" as="button"><TrashIcon class="w-5 text-red-500" /></Link>
                                </div>
                            </div>
                        </div>
                        <DropdownMenuSeparator />
                        <Link :href="route('shop.checkout')"><Button class="w-full">Checkout: ${{ getCartPrice() }}</Button></Link>
                    </DropdownMenuContent>
                </DropdownMenu>
            </div>
        </template>
        <div class="grid grid-cols-5 p-12 gap-4">
            <div v-for="product in products">
                <Product :product="product" />
            </div>
            <!-- <div v-for="product in products" class="border p-2 rounded-lg bg-white">
                <p class="text-lg font-bold">{{ product.name }}</p>
                <p class="mt-12">${{ product.price }}</p>
                <div class="grid grid-cols-2 gap-2">
                    <form method="POST" @submit.prevent="submit(product)">
                        <input type="number" v-model="q" name="q" id="q" placeholder="Quantity" required>
                        <Button type="submit">Add to Cart</Button>
                    </form>
                </div>
            </div> -->
        </div>
    </AuthenticatedLayout>
</template>