import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import { createRouter, createWebHistory } from "vue-router";
import FrontendRoutes from "./Routes/Frontend/Routes";
import AdminRoutes from "./Routes/Admin/Routes";

// Routes
const routes = [...FrontendRoutes, ...AdminRoutes];
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

// Run
const app = createApp({});
app.use(router);
app.mount("#app");

/**
 * Custom functions
 * ErrorHandling
 */
window.getErrorMessage = (error) => {
    let errorData = error.response.data;
    let errorMessages = [];
    if (errorData.errors) {
        for (let key in errorData.errors) {
            let errorMessage = errorData.errors[key][0];
            errorMessages.push(errorMessage);
        }
    }
    return errorMessages[0] ?? "Unknown error";
    // return errorMessages ?? ["Unknown error"];
};
