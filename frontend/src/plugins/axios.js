import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

// HTTP Client Axios
Vue.use(VueAxios, axios)

export default axios.create({
    baseURL: "http://localhost:8000/api",
    headers: {
        "Content-type": "application/json",
        "Authorization": "Bearer " + localStorage.getItem('access_token')
    }
});