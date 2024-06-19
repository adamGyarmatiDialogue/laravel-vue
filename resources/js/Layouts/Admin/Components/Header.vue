<template>
    <div>
        {{ adminData.firstName + ' ' + adminData.lastName }}
    </div>
</template>
<script setup>
import { storeToRefs } from "pinia";
import { AdminStore } from "../../../Store/Admin/AdminStore";

const adminStore = AdminStore();
const { adminData } = storeToRefs(adminStore);
</script>