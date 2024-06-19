import { defineStore } from "pinia";

export const AdminStore = defineStore("AdminStore", {
    state: () => ({
        adminData: {},
    }),
    getters: {
        getAdminData: (state) => state.adminData,
    },
    actions: {
        setAdminData(adminData) {
            this.adminData = adminData;
        },
    },
});
