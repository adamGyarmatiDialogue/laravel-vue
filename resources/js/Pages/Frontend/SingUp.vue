<template>
    <div class="card mt-3 p-2">
        <form @submit.prevent="signUp()">
            <div class="mb-3">
                <input type="text" class="form-control" v-model="signUpForm.firstName" placeholder="Vezetéknév: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[0]"
                v-if="state.errorMessages.length !== 0" />

            <div class=" mb-3">
                <input type="text" class="form-control" v-model="signUpForm.lastName" placeholder="Keresztnév: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[1]"
                v-if="state.errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="text" class="form-control" v-model="signUpForm.email" placeholder="Email cím: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[2]"
                v-if="state.errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="text" class="form-control" v-model="signUpForm.username" placeholder="Felhasználónév: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[3]"
                v-if="state.errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="password" class="form-control" v-model="signUpForm.password" placeholder="Jelszó: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[4]"
                v-if="state.errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="password" :disabled="state.working" class="form-control"
                    v-model="signUpForm.reTypedPassword" placeholder="Jelszó megerősítése: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[5]"
                v-if="state.errorMessages.length !== 0" />

            <Success :message="state.successMessage" v-if="state.successMessage !== ''" />

            <div>
                <button type=" submit" class="btn btn-primary">Regisztráció</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { reactive } from 'vue';
import Alert from "../../Ui/Alert.vue"
import Success from "../../Ui/Success.vue"

const signUpForm = reactive({
    firstName: "",
    lastName: "",
    email: "",
    username: "",
    password: "",
    reTypedPassword: "",
});

const state = reactive({
    working: false,
    errorMessages: [],
    successMessage: "",
});

function signUp() {
    state.working = true;
    state.successMessage = "";
    state.errorMessages = "";
    axios.post(" /api/v1/users", signUpForm)
        .then((response) => {
            state.successMessage = response.data.message;
            clearData();
        })
        .catch((error) => {
            console.log(error.response.data.errors);
            state.errorMessages = error.response.data.errors;
        })
        .finally(() => {
            state.working = false;
        });
}

function clearData() {
    signUpForm.firstName = '';
    signUpForm.lastName = '';
    signUpForm.email = '';
    signUpForm.username = '';
    signUpForm.password = '';
    signUpForm.reTypedPassword = '';
}
</script>
