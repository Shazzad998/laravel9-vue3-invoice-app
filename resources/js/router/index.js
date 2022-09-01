import { createRouter, createWebHistory } from "vue-router";

import InvoiceIndex from "@/pages/invoices/Index.vue";
import InvoiceCreate from "@/pages/invoices/Create.vue";
import InvoiceShow from "@/pages/invoices/Show.vue";
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
                name: "invoices.index",
                component: InvoiceIndex,
            },

            {
                path: "/invoices/create",
                name: "invoices.create",
                component: InvoiceCreate,
            },

            {
                path: "/invoices/:id",
                name: "invoices.show",
                component: InvoiceShow,
                props: true,
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
