import { createRouter, createWebHistory } from "vue-router";

import InvoiceIndex from "@/pages/invoices/Index.vue";
import NotFound from "@/NotFound.vue";
const routes = [
    {
        path: "/",
        name: "invoice.index",
        component: InvoiceIndex,
    },

    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
