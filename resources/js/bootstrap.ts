import axios from 'axios';
window.axios = axios;

window.axios.defaults.baseURL = 'api';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
