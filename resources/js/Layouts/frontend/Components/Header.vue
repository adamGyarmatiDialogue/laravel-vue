<template>
    <div class="fe-layout_header">
        <div class="container">
            <div class="app-name">
                My First Website
            </div>
            <nav>
                <ul>
                    <router-link :to="'/'">
                        <li>Kezdőlap</li>
                    </router-link>

                    <router-link :to="'/sign-in'">
                        <li>Belépés</li>
                    </router-link>

                    <router-link :to="'/sign-up'">
                        <li>Regisztráció</li>
                    </router-link>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script setup>
</script>