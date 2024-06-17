import Layout from "../../Layouts/Frontend/Layout.vue";
import Homepage from "../../Pages/Frontend/HomePage.vue";
import SignIn from "../../Pages/Frontend/SingIn.vue";
import SignUp from "../../Pages/Frontend/SingUp.vue";

export default [
    {
        path: "/",
        component: Layout,
        children: [
            {
                path: "",
                component: Homepage,
            },
            {
                path: "/sign-in",
                component: SignIn,
            },
            {
                path: "/sign-up",
                component: SignUp,
            },
        ],
    },
];
