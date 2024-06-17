import "./bootstrap";
import { createApp } from "vue/dist/vue.esm-bundler";
import { createRouter, createWebHistory } from "vue-router";
import Layout from "./Layouts/frontend/Layout.vue";

// Routes
const routes = [
    {
        path: "/",
        component: Layout,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

// Run
const app = createApp({});
app.use(router);
app.mount("#app");
