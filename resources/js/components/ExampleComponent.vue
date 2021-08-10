<template>
    <div class="container">
        <app-component></app-component>
    </div>
</template>

<script>
import App from "./App.vue"
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            App
        }
    }
</script>
