import { createRouter, createWebHistory } from "vue-router";

import InvoiceIndex from "@/pages/invoices/Index.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import NotFound from "@/NotFound.vue";
const routes = [
    {
        path: "/",
        redirect: "/invoices",
        component: DefaultLayout,
        children: [
            {
                path: "/invoices",
                name: "invoice.index",
                component: InvoiceIndex,
                name: "invoices.index",
            },

            {
                path: "/:pathMatch(.*)*",
                component: NotFound,
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
