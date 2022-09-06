<script setup>
import useInvoice from "../composable/invoice";

const props = defineProps({
    meta: Object,
});
</script>

<template>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
    >
        <span class="flex items-center col-span-3">
            Showing {{ meta.from }}- {{ meta.to }} of {{ meta.total }}
        </span>
        <span class="col-span-2"></span>
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <ul class="inline-flex items-center">
                    <li v-for="link in meta.links">
                        <button
                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                            :class="[
                                link.active ? 'text-gray-50 bg-indigo-600' : '',
                            ]"
                            :disabled="!link.url"
                            aria-label="Previous"
                            @click="$emit('getData', link.url.slice(-1))"
                            v-html="link.label"
                        ></button>
                    </li>
                </ul>
            </nav>
        </span>
    </div>
</template>
