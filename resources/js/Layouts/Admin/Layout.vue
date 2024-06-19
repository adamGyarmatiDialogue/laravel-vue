<template>
    <div>
        <Header />
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import Header from "./Components/Header.vue";
import axios from "axios";

onMounted(() => {
    axios.get("/api/v1/admin/initialize")
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error);
        })
});
</script>