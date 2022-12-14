<script setup>
import { onMounted } from "vue";
import ButtonLink from "../../components/ButtonLink.vue";
import useInvoice from "../../composable/invoice";
import Pagination from "../../components/Pagination.vue";

const {
    invoices,
    searchInput,
    getInvoices,
    search,
    createInvoice,
    showInvoice,
    deleteInvoice,
} = useInvoice();

onMounted(async () => {
    getInvoices();
});

const destroyInvoice = (id) => {
    deleteInvoice(id).then(getInvoices);

    console.log("ok");
};
</script>

<template>
    <div class="flex justify-between mt-20 mb-4">
        <div class="flex gap-x-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Invoices List
            </h2>

            <div class="relative mr-6 text-purple-500">
                <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg
                        class="w-4 h-4"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <input
                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="text"
                    placeholder="Search for invoices"
                    aria-label="Search"
                    v-model="searchInput"
                    @keyup="search()"
                />
            </div>
        </div>

        <ButtonLink @click="createInvoice()">
            Create Invoice
            <i class="bx bx-plus"></i>
        </ButtonLink>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">Invoice ID</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Due Date</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                    <tr
                        class="text-gray-700 dark:text-gray-400"
                        v-for="invoice in invoices.data"
                        :key="invoice.id"
                        v-if="invoices.data?.length > 0"
                    >
                        <td class="px-4 py-3">
                            <a href="#" @click="showInvoice(invoice.id)"
                                >#{{ invoice.number }}</a
                            >
                        </td>
                        <td class="px-4 py-3">
                            {{ invoice.customer }}
                        </td>
                        <td class="px-4 py-3 text-sm">$ {{ invoice.total }}</td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                            >
                                Approved
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ invoice.due_date }}
                        </td>
                        <td class="px-4 py-3">
                            <div
                                class="flex items-center justify-center space-x-4 text-sm"
                            >
                                <button
                                    @click="showInvoice(invoice.id)"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="currentColor"
                                        class="w-5 h-5"
                                    >
                                        <path
                                            d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                                <router-link
                                    :to="{
                                        name: 'invoices.edit',
                                        params: { id: invoice.id },
                                    }"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Edit"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                        ></path>
                                    </svg>
                                </router-link>
                                <button
                                    @click="destroyInvoice(invoice.id)"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr v-else>
                        <p>Invoice Not Found</p>
                    </tr>
                </tbody>
            </table>
        </div>

        <Pagination
            v-if="invoices.meta"
            :meta="invoices.meta"
            :label="invoices.meta?.links"
            @getData="getInvoices"
        />
    </div>
</template>
