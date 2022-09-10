import axios from "axios";
import { ref } from "vue";

export default function useProduct() {
    let products = ref([]);

    const getProducts = async () => {
        let response = await axios.get("/api/products");

        products.value = response.data.products;
    };

    return {
        products,
        getProducts,
    };
}
