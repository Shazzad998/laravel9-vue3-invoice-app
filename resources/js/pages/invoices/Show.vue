<script setup></script>

<template>
    <div class="mt-20 text-gray-200 mx-56 bg-gray-800 p-16 rounded-lg">
        <div class="flex justify-between items-start">
            <h1 class="text-4xl font-black">Invoice #INV-34123</h1>
            <div class="flex flex-col gap-y-2">
                <h1 class="font-semibold text-lg">Themesberg Inc.</h1>
                <p>291 N 4th St, San Jose, CA 95112, USA</p>
                <p class="text-gray-500">August 1, 2021</p>
            </div>
        </div>

        <div class="mt-20">
            <h1 class="text-2xl font-black">Bill To</h1>
            <div class="mt-4">
                <p class="leading-8 text-gray-600 dark:text-gray-400">
                    Themesberg Inc., LOUISVILLE, Selby <br />
                    3864 Johnson Street,United States of America <br />
                    VAT Code: AA- 1234567890
                </p>
            </div>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs mt-8">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        >
                            <th class="px-4 py-3">Item Description</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Quantity</th>
                            <th class="px-4 py-3">Discount</th>
                            <th class="px-4 py-3">Total</th>
                        </tr>
                    </thead>
                    <tbody
                        class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">
                                            Pixel Design System
                                        </p>
                                        <p
                                            class="text-xs text-gray-600 dark:text-gray-400"
                                        >
                                            Html components
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">$ 863.45</td>
                            <td class="px-4 py-3 text-xs">3</td>
                            <td class="px-4 py-3 text-sm">$42</td>
                            <td class="px-4 py-3 text-sm">$1234</td>
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
                    <span class="text-gray-500">Subtotal</span>
                    <span class="text-xl text-gray-800 dark:text-gray-200"
                        >$6575</span
                    >
                </div>

                <div class="flex justify-between items-center gap-x-8">
                    <span class="text-gray-500">Discount</span>
                    <span class="text-xl text-gray-800 dark:text-gray-200"
                        >$23</span
                    >
                </div>

                <div class="flex justify-between gap-x-8">
                    <span class="text-xl text-gray-800 dark:text-gray-200"
                        >Total</span
                    ><span class="text-xl text-gray-800 dark:text-gray-200"
                        >$2343</span
                    >
                </div>
            </div>
        </div>
    </div>
</template>
