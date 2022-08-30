<script setup>
import { useRouter } from "vue-router";
import ButtonLink from "../../components/ButtonLink.vue";

const router = useRouter();

const viewInvoices = () => {
    router.push({ name: "invoices.index" });
};
</script>

<template>
    <div class="flex justify-between mt-20 mb-4">
        <div class="flex gap-x-6">
            <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Create Invoice
            </h2>
        </div>

        <ButtonLink @click="viewInvoices()">
            View Invoices
            <i class="bx bx-plus"></i>
        </ButtonLink>
    </div>

    <div
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4"
    >
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400"> Customer </span>
            <select
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray rounded-md"
            >
                <option>Customer 1</option>
                <option>Customer 2</option>
                <option>Customer 3</option>
                <option>Customer 4</option>
                <option>Customer 5</option>
            </select>
        </label>
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Name</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
            />
        </label>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Reference</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
            />
        </label>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Date</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
                type="date"
            />
        </label>
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Due Date</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
                type="date"
            />
        </label>

        <!-- <div class="flex mt-6 text-sm">
            <label class="flex items-center dark:text-gray-400">
                <input
                    type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray rounded-md"
                />
                <span class="ml-2">
                    I agree to the
                    <span class="underline">privacy policy</span>
                </span>
            </label>
        </div> -->
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                        <th class="px-4 py-3">Item Description</th>
                        <th class="px-4 py-3">Unit Price</th>
                        <th class="px-4 py-3">QTY</th>
                        <th class="px-4 py-3">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y dark:divide-gray-700">
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div
                                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                                >
                                    <img
                                        class="object-cover w-full h-full rounded-full"
                                        src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                        alt=""
                                        loading="lazy"
                                    />
                                    <div
                                        class="absolute inset-0 rounded-full shadow-inner"
                                        aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold">Maria Ramovic</p>
                                    <p
                                        class="text-xs text-gray-600 dark:text-gray-400"
                                    >
                                        Runner
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm w-44 text-left">
                            <input
                                type="text"
                                class="block w-4/6 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                            />
                        </td>
                        <td class="px-4 py-3 text-sm w-44 mr-4">
                            <input
                                type="text"
                                class="block w-4/6 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                            />
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span>$ 45233.43</span>

                                <button
                                    class="flex items-center justify-between px-2 py-2 text-lg font-medium leading-5 text-red-500 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete"
                                >
                                    <i class="bx bxs-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="flex justify-between mt-20 mb-4">
        <ButtonLink>
            Add Product
            <i class="bx bx-plus"></i>
        </ButtonLink>
    </div>

    <div
        class="grid grid-cols-1 md:grid-cols-2 text-gray-800 dark:text-gray-300"
    >
        <div>terms and conditions</div>

        <div class="px-12">
            <div class="grid grid-cols-2">
                <span>Subtotal</span>
                <span>$342.54</span>
            </div>

            <div class="grid grid-cols-2">
                <span>Discount</span>
                <span>$42.54</span>
            </div>

            <div class="grid grid-cols-2">
                <span>Tax</span>
                <span>$2.54</span>
            </div>

            <div class="grid grid-cols-2">
                <span>Total</span>
                <span>$342.54</span>
            </div>
        </div>
    </div>
</template>
