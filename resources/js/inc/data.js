import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

async function fetchApi(endpoint, queryParams = {}, method = "GET", body = null) {
    let token, apiUrl;
    if (import.meta.env.MODE === 'development') {
        apiUrl = import.meta.env.VITE_API_URL_LOCAL;
        token = import.meta.env.VITE_BEARER_TOKEN_LOCAL;
    } else {
        apiUrl = import.meta.env.VITE_API_URL;
        token = import.meta.env.VITE_BEARER_TOKEN;
    }

    let url = `${apiUrl}/${endpoint}`;
  
    const options = {
        method: method,
        url: url,
        params: queryParams,
        headers: {
            Authorization: `Bearer ${token}`,
            "Content-Type": "application/json",
        },
        data: body,
    };

    try {
        const response = await axios(options);
        return response.data;
    } catch (error) {
        if (error.response) {
            throw new Error(`HTTP error! status: ${error.response.status}`);
        } else {
            throw error;
        }
    }
}

export const getListings = (id) => fetchApi("listings", id ? { category: id } : {});
export const deleteListing = (id) => fetchApi(`listings/${id}`, {}, "DELETE");
export const getModels = (id) => fetchApi("models", id ? { category_id: id } : {});
export const getModel = (id) => fetchApi("listings", { model_id: id });
export const getStats = () => fetchApi("stats");
