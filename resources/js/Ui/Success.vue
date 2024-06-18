<template>
    <div class="alert alert-success p-2">
        {{ message }}
    </div>
</template>
<script setup>
defineProps({
    message: {
        type: String,
        required: true,
    },
})
</script>