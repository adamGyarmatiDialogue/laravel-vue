<template>
    <div class="alert alert-danger p-2">
        {{ messages[errorType][0] }}
    </div>
</template>
<script setup>
defineProps({
    messages: {
        type: Object,
        required: true,
    },
    errorType: {
        type: String,
        required: true,
    }
})
</script>