<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import useInvoice from "../../composable/invoice";

const router = useRouter();

const props = defineProps({
    id: String,
});

const { invoice, getInvoice } = useInvoice();

onMounted(async () => {
    getInvoice(props.id);
});

const print = () => {
    window.print();
};

const edit = (id) => {
    router.push({
        name: "invoices.edit",
        params: { id: id },
    });
};
</script>

<template>
    <div class="print:hidden flex justify-end mx-56 mt-10 gap-x-3">
        <button
            @click="edit(invoice.id)"
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
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
        </button>

        <button
            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
            aria-label="Edit"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="w-5 h-5"
            >
                <path
                    fill-rule="evenodd"
                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </div>
    <div
        class="mt-10 text-gray-800 dark:text-gray-200 mx-56 bg-white shadow-2xl dark:bg-gray-800 p-16 rounded-lg print:shadow-none print:m-0"
    >
        <div
            class="flex justify-between items-start print:text-black print:dark:text-black"
        >
            <h1 class="text-4xl font-black">Invoice #{{ invoice.number }}</h1>
            <div class="flex flex-col gap-y-2">
                <h1 class="font-semibold text-lg">Themesberg Inc.</h1>
                <p>291 N 4th St, San Jose, CA 95112, USA</p>
                <p class="text-gray-500">{{ invoice.created_at }}</p>
            </div>
        </div>

        <div class="mt-20">
            <h1
                class="text-2xl font-black print:text-black print:dark:text-black"
            >
                Bill To
            </h1>
            <div class="mt-4">
                <p
                    class="leading-8 text-gray-600 dark:text-gray-400 print:text-black print:dark:text-black"
                >
                    {{ invoice.customer?.first_name }} <br />
                    {{ invoice.customer?.address }}
                </p>
            </div>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-8">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-900 print:text-black print:dark:text-black"
                        >
                            <th class="px-4 py-3">Item Description</th>
                            <th class="px-4 py-3">Unit Price</th>
                            <th class="px-4 py-3">Quantity</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                        <tr
                            class="text-gray-700 dark:text-gray-400 print:text-black print:dark:text-black"
                            v-for="item in invoice.invoice_items"
                        >
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            {{ item.product.description }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                $ {{ item.product.unit_price }}
                            </td>
                            <td class="px-4 py-3 text-xs">
                                {{ item.quantity }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                ${{ item.product.unit_price * item.quantity }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 mt-10">
            <div
                class="flex flex-col gap-y-4 col-start-3 uppercase font-semibold"
            >
                <div class="flex justify-between items-center gap-x-8">
                    <span
                        class="text-gray-500 print:text-black print:dark:text-black"
                        >Subtotal</span
                    >
                    <span
                        class="text-xl text-gray-800 dark:text-gray-200 print:text-black print:dark:text-black"
                        >${{ invoice.sub_total }}</span
                    >
                </div>

                <div class="flex justify-between items-center gap-x-8">
                    <span
                        class="text-gray-500 print:text-black print:dark:text-black"
                        >Discount</span
                    >
                    <span
                        class="text-xl text-gray-800 dark:text-gray-200 print:text-black print:dark:text-black"
                        >${{ invoice.discount }}</span
                    >
                </div>

                <div
                    class="flex justify-between gap-x-8 text-xl text-gray-800 print:text-black print:dark:text-black dark:text-gray-200"
                >
                    <span>Total</span><span>${{ invoice.total }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="print:hidden flex justify-end mx-56 mt-10">
        <button
            @click="print"
            class="bg-indigo-500 px-10 py-2 rounded-md text-gray-100"
        >
            Print
        </button>
    </div>
</template>
