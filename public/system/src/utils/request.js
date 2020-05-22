import axios from 'axios';

const service = axios.create({
    timeout: 5000,
});

// 环境的切换
axios.defaults.baseURL = process.env.NODE_ENV == 'development' ? 'http://yang.fifa.test/api/' : "http://fifa.yangliangblog.top";
axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

service.interceptors.request.use(
    config => {
        return config;
    },
    error => {
        console.log(error);
        return Promise.reject();
    }
);

service.interceptors.response.use(
    response => {
        if (response.status === 200) {
            return response.data;
        } else {
            Promise.reject();
        }
    },
    error => {
        console.log(error);
        return Promise.reject();
    }
);

export default service;
