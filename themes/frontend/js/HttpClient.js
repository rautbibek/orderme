import Axios from "axios";

const HttpClient = Axios.create({
    baseURL: process.env.MIX_APP_URL === 'prod' ? 'https://tradekunj.com/' : `/`
})

HttpClient.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        return Promise.reject(error.response);
    }
);


export default HttpClient
