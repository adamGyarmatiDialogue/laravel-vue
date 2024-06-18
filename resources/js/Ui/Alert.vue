<template>
    <div class="alert alert-danger p-2">
        {{ message ? message : messages[errorType][0] }}
    </div>
</template>
<script setup>
defineProps({
    messages: {
        type: Object,
        required: false,
    },
    message: {
        type: String,
        required: false,
    },
    errorType: {
        type: String,
        required: false,
    }
})
</script>