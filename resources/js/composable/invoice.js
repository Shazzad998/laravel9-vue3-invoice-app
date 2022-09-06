import axios from "axios";
import { ref } from "vue";

export default function useInvoice() {
    let invoices = ref([]);
    const searchInput = ref("");

    const getInvoices = async (page = 1) => {
        let response = await axios.get("/api/invoices?page=" + page);
        invoices.value = response.data;
        console.log("get", page);
    };

    const search = async () => {
        let response = await axios.get(
            "/api/search-invoices?s=" + searchInput.value
        );
        invoices.value = response.data;
    };

    return {
        invoices,
        searchInput,
        getInvoices,
        search,
    };
}
