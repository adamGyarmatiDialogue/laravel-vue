<template>
    <div class="card mt-3 p-2">
        <form @submit.prevent="signIn()">
            <div class="mb-3">
                <input type="text" class="form-control" v-model="signInForm.email" placeholder="Email cím: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[0]"
                v-if="state.errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="password" class="form-control" v-model="signInForm.password" placeholder="Jelszó: *">
            </div>
            <Alert :messages="state.errorMessages" :errorType="Object.keys(state.errorMessages)[1]"
                v-if="state.errorMessages.length !== 0" />

            <Alert :message="state.errorMessage" v-if="state.errorMessage" />

            <div>
                <button type=" submit" :disabled="state.working" class="btn btn-primary">Bejelentkezés</button>
            </div>
        </form>
    </div>
</template>
<script setup>
import { reactive } from 'vue';
import Alert from "../../Ui/Alert.vue";
import { useRouter } from 'vue-router';

const signInForm = reactive({
    email: "",
    password: "",
});

const state = reactive({
    working: false,
    errorMessages: [],
    errorMessage: "",
});

const router = useRouter();

function signIn() {
    state.working = true;
    state.errorMessages = [];
    state.errorMessage = "";
    axios.post(" /api/v1/users/login", signInForm)
        .then((response) => {
            console.log(response.data["userToken"]);
            localStorage.setItem("userToken", response.data.userToken);
            router.push("/admin");
        })
        .catch((error) => {
            if (error.response.data.message) {
                state.errorMessage = error.response.data.message;
                console.log(state.errorMessage);
            } else {
                state.errorMessages = error.response.data.errors;
            }
        })
        .finally(() => {
            state.working = false;
        });
}
</script>