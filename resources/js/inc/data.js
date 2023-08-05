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
        let data = null;
        if(response.data.data) {
            data = response.data.data;
        } else {
            data = response.data
        }
        return data;
    } catch (error) {
        if (error.response) {
            throw new Error(`HTTP error! status: ${error.response.status}`);
        } else {
            throw error;
        }
    }
}

export const fetchListings = ({ id, site, categoryId } = {}) => {
    const queryParams = {};
    if (id) queryParams.model_id = id;
    if (site) queryParams.site = site;
    if (categoryId) queryParams.category = categoryId;

    return fetchApi("listings", queryParams);
};


export const deleteListing = (id) => fetchApi(`listings/${id}`, {}, "DELETE");
export const getModels = (id) => fetchApi("models", id ? {category_id : id} : {});
export const getStats = () => fetchApi("stats");
