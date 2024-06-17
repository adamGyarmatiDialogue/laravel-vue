<template>
    <div class="fe-layout">
        <Header  />

        <main class="fe-layout_main">
            <div class="container">
            <router-view></router-view>
            </div>
        </main>
    </div>
</template>
<script setup>
import Header from "./Components/Header.vue"
</script>