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
    };

    const getEditInvoice = async (id) => {
        let response = await axios.get("/api/invoices/" + id + "/edit");
        invoice.value = response.data.data;
    };

    const deleteInvoiceItem = async (id, i) => {
        invoice.value.invoice_items.splice(i, 1);
        if (id != null) {
            axios.get("/api/delete_invoice_item/" + id);
        }
    };

    const deleteInvoice = async (id) => {
        await axios.delete("/api/invoices/" + id);
        await router.push({ name: "invoices.index" });
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
        getEditInvoice,
        deleteInvoiceItem,
        deleteInvoice,
    };
}
