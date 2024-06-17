import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import { createRouter, createWebHistory } from "vue-router";
import FrontendRoutes from "./Routes/Frontend/Routes";

// Routes
const routes = [...FrontendRoutes];
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

// Run
const app = createApp({});
app.use(router);
app.mount("#app");
