<template>
    <div class="card mt-3 p-2">
        <form @submit.prevent="signUp()">
            <div class="mb-3">
                <input type="text" class="form-control" v-model="signUpForm.firstName" placeholder="Vezetéknév: *">
            </div>
            <!-- <div v-if="errorMessages['firstName']" class="mb-3 p-2 alert alert-danger">
                {{ errorMessages['firstName'][0] }}
            </div> -->
            <Alert :messages="errorMessages" :errorType="Object.keys(errorMessages)[0]"
                v-if="errorMessages.length !== 0" />


            <div class=" mb-3">
                <input type="text" class="form-control" v-model="signUpForm.lastName" placeholder="Keresztnév: *">
            </div>
            <!-- <div v-if="errorMessages['lastName']" class="mb-3 p-2 alert alert-danger">
                {{ errorMessages['lastName'][0] }}
            </div> -->
            <Alert :messages="errorMessages" :errorType="Object.keys(errorMessages)[1]"
                v-if="errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="text" class="form-control" v-model="signUpForm.email" placeholder="Email cím: *">
            </div>
            <!-- <div v-if="errorMessages['email']" class="mb-3 p-2 alert alert-danger">
                {{ errorMessages['email'][0] }}
            </div> -->
            <Alert :messages="errorMessages" :errorType="Object.keys(errorMessages)[2]"
                v-if="errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="text" class="form-control" v-model="signUpForm.username" placeholder="Felhasználónév: *">
            </div>
            <!-- <div v-if="errorMessages['username']" class="mb-3 p-2 alert alert-danger">
                {{ errorMessages['username'][0] }}
            </div> -->
            <Alert :messages="errorMessages" :errorType="Object.keys(errorMessages)[3]"
                v-if="errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="password" class="form-control" v-model="signUpForm.password" placeholder="Jelszó: *">
            </div>
            <!-- <div v-if="errorMessages['password']" class="mb-3 p-2 alert alert-danger">
                {{ errorMessages['password'][0] }}
            </div> -->
            <Alert :messages="errorMessages" :errorType="Object.keys(errorMessages)[4]"
                v-if="errorMessages.length !== 0" />

            <div class="mb-3">
                <input type="password" class="form-control" v-model="signUpForm.reTypedPassword"
                    placeholder="Jelszó megerősítése: *">
            </div>
            <!-- <div v-if="errorMessages['reTypedPassword']" class="mb-3 p-2 alert alert-danger">
                {{ errorMessages['reTypedPassword'][0] }}
            </div> -->
            <Alert :messages="errorMessages" :errorType="Object.keys(errorMessages)[5]"
                v-if="errorMessages.length !== 0" />

            <div>
                <button type="submit" class="btn btn-primary">Regisztráció</button>
            </div>
        </form>
        <!-- <div v-if="errorMessage !== ''">
            {{ errorMessage }}
        </div> -->
        <!-- <div v-for="error in errorMessages">
            {{ error }}
        </div> -->
    </div>
</template>
<script setup>
import { reactive, ref } from 'vue';
import Alert from "../../Ui/Alert.vue"

const signUpForm = reactive({
    firstName: "",
    lastName: "",
    email: "",
    username: "",
    password: "",
    reTypedPassword: "",
});

// let errorMessage = ref("");
let errorMessages = ref([]);

function signUp() {
    axios.post(" /api/v1/users", signUpForm).then((response) => {
        console.log(response);
    })
        .catch((error) => {
            // this.errorMessage = getErrorMessage(error);
            this.errorMessages = error.response.data.errors;
        });
}
</script>
