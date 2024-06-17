import Layout from "../../Layouts/Frontend/Layout.vue";
import Homepage from "../../Pages/Frontend/HomePage.vue";

export default [
    {
        path: "/",
        component: Layout,
        children: [
            {
                path: "",
                component: Homepage,
            },
        ],
    },
];
