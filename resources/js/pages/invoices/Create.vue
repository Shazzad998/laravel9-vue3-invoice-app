<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import ButtonLink from "../../components/ButtonLink.vue";

const router = useRouter();

let form = ref([]);
let customers = ref([]);
let customer_id = ref();
let listCart = ref([]);
let products = ref([]);
const isModalOpen = ref(false);
const subtotal = () => {
    let total = 0;
    listCart.value.map((item) => {
        if (item.quantity) {
            total = total + item.unit_price * item.quantity;
        }
    });
    return total;
};
const total = () => {
    return subtotal() - form.value.discount;
};

// functions
onMounted(async () => {
    getDefaultData();
    getCustomers();
    getProducts();
});

const onSave = () => {
    let subTotal = 0;
    subTotal = subtotal();

    let Total = 0;
    Total = total();

    if (listCart.value.length >= 1) {
        const formData = new FormData();
        formData.append("invoice_items", JSON.stringify(listCart.value));
        formData.append("customer_id", customer_id.value);
        formData.append("date", form.value.date);
        formData.append("due_date", form.value.due_date);
        formData.append("number", form.value.number);
        formData.append("reference", form.value.reference);
        formData.append("discount", form.value.discount);
        formData.append("sub_total", subTotal);
        formData.append("total", Total);
        formData.append(
            "terms_and_conditions",
            form.value.terms_and_conditions
        );

        axios.post("/api/invoices", formData);
        listCart.value = [];
        router.push("/");
    }
};

const openModal = () => {
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const addToCart = (item) => {
    const itemcart = {
        id: item.id,
        item_code: item.item_code,
        item_description: item.description,
        unit_price: item.unit_price,
        quantity: 1,
    };

    listCart.value.push(itemcart);

    closeModal();
};

const removeFromCart = (index) => {
    listCart.value.splice(index, 1);
};

const getProducts = async () => {
    let response = await axios.get("/api/products");
    console.log(response.data);
    products.value = response.data.products;
};

const getCustomers = async () => {
    let response = await axios.get("/api/customers");

    customers.value = response.data.customers;
};

const getDefaultData = async () => {
    let response = await axios.get("/api/invoices/create");

    form.value = response.data;
};

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
                v-model="customer_id"
            >
                <option
                    v-for="customer in customers"
                    :key="customer.id"
                    :value="customer.id"
                    class="text-gray-100"
                >
                    {{ customer.first_name }}
                </option>
            </select>
        </label>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Number</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
                v-model="form.number"
            />
        </label>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Reference</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
                v-model="form.reference"
            />
        </label>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Date</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
                type="date"
                v-model="form.date"
            />
        </label>
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Due Date</span>
            <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                placeholder="Jane Doe"
                type="date"
                v-model="form.due_date"
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

    <div class="flex justify-end mb-4">
        <ButtonLink @click="openModal()">
            Add Product
            <i class="bx bx-plus"></i>
        </ButtonLink>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-20">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap" v-if="listCart.length > 0">
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
                    <tr
                        class="text-gray-700 dark:text-gray-400"
                        v-for="(itemcart, i) in listCart"
                        :key="itemcart.id"
                    >
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                #{{ itemcart.item_code }}
                                {{ itemcart.item_description }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm w-44 text-left">
                            <input
                                type="text"
                                class="block w-4/6 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                                v-model="itemcart.unit_price"
                            />
                        </td>
                        <td class="px-4 py-3 text-sm w-44 mr-4">
                            <input
                                type="text"
                                class="block w-4/6 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                                v-model="itemcart.quantity"
                            />
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span v-if="itemcart.quantity">
                                    ${{
                                        itemcart.unit_price * itemcart.quantity
                                    }}</span
                                ><span v-else> $0000</span>

                                <button
                                    class="flex items-center justify-between px-2 py-2 text-lg font-medium leading-5 text-red-500 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete"
                                    @click="removeFromCart(i)"
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

    <div
        class="grid grid-cols-1 md:grid-cols-2 text-gray-800 dark:text-gray-300"
    >
        <div>
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400"
                    >Terms And Conditions</span
                >
                <textarea
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray rounded-md"
                    rows="5"
                    placeholder="Enter some long form content."
                    v-model="form.terms_and_conditions"
                ></textarea>
            </label>
        </div>

        <div class="md:px-16 flex flex-col gap-y-4 mt-4">
            <div class="grid grid-cols-2">
                <span class="text-2xl flex items-center">Subtotal</span>
                <span class="text-2xl flex items-center"
                    >${{ subtotal() }}</span
                >
            </div>

            <div class="grid grid-cols-2">
                <span class="flex items-center text-2xl">Discount</span>
                <input
                    type="text"
                    class="block w-4/6 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input rounded-md"
                    v-model="form.discount"
                />
            </div>

            <div class="grid grid-cols-2">
                <span class="text-2xl flex items-center">Total</span>
                <span class="text-2xl flex items-center">${{ total() }}</span>
            </div>
        </div>
    </div>

    <div class="flex justify-end mt-10 mb-4">
        <ButtonLink @click="onSave()">
            Save Invoice
            <i class="bx bx-plus"></i>
        </ButtonLink>
    </div>

    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
    <div
        v-if="isModalOpen"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    >
        <!-- Modal -->
        <div
            v-if="isModalOpen"
            v-click-away="closeModal"
            @keydown.escape="closeModal"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog"
            id="modal"
        >
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close"
                    @click="closeModal"
                >
                    <svg
                        class="w-4 h-4"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        role="img"
                        aria-hidden="true"
                    >
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                            fill-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </header>
            <!-- Modal body -->
            <div class="mt-4 mb-6">
                <!-- Modal title -->
                <p
                    class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"
                >
                    Add Product
                </p>
                <!-- Modal description -->
                <div class="text-sm text-gray-700 dark:text-gray-400">
                    <ul>
                        <li
                            class="grid grid-cols-[50px_minmax(100px,_1fr)_100px_50px] my-2"
                        >
                            <span>SL</span>
                            <span>Product description</span>
                            <span>Unit Price</span>
                            <span></span>
                        </li>
                        <li
                            class="grid grid-cols-[50px_minmax(100px,_1fr)_100px_50px] my-2"
                            v-for="(product, i) in products"
                            :key="product.id"
                        >
                            <span>{{ i + 1 }}</span>
                            <span>{{ product.item_code }}</span>
                            <span>{{ product.unit_price }} </span>
                            <button
                                class="dark:bg-gray-300 dark:text-gray-800 rounded-md"
                                @click="addToCart(product)"
                            >
                                <i class="bx bx-plus"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
            >
                <button
                    @click="closeModal"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                >
                    Cancel
                </button>
                <button
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Accept
                </button>
            </footer>
        </div>
    </div>
    <!-- End of modal backdrop -->
</template>
