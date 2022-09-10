import axios from "axios";
import { ref } from "vue";

export default function useCustomer() {
    let customers = ref([]);

    const getCustomers = async () => {
        let response = await axios.get("/api/customers");

        customers.value = response.data.customers;
    };

    return {
        customers,
        getCustomers,
    };
}
