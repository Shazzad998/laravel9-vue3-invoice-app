import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";

export default function useInvoice() {
    const router = useRouter();
    let invoices = ref([]);
    const invoice = ref({});
    const searchInput = ref("");

    const getInvoices = async (page = 1) => {
        let response = await axios.get("/api/invoices?page=" + page);
        invoices.value = response.data;
    };

    const search = async () => {
        let response = await axios.get(
            "/api/search-invoices?s=" + searchInput.value
        );
        invoices.value = response.data;
    };

    const createInvoice = async () => {
        router.push({ name: "invoices.create" });
    };

    const showInvoice = (id) => {
        router.push({
            name: "invoices.show",
            params: { id: id },
        });
    };

    const getInvoice = async (id) => {
        let response = await axios.get("/api/invoices/" + id);
        invoice.value = response.data.data;
        console.log(invoice.value);
    };

    return {
        invoices,
        searchInput,
        invoice,
        getInvoices,
        search,
        createInvoice,
        showInvoice,
        getInvoice,
    };
}
