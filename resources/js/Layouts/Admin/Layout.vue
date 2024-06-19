<template>
    <div>
        <Header />
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { AdminStore } from "../../Store/Admin/AdminStore";
import Header from "./Components/Header.vue";
import axios from "axios";

const adminStore = AdminStore();

onMounted(() => {
    axios.get("/api/v1/admin/initialize")
        .then((response) => {
            adminStore.setAdminData(response.data.adminData);
        })
        .catch((error) => {
            console.log(error);
        })
});
</script>