import request from '../utils/request';
import Qs from 'qs';
export const Login = (data) => {
    return request({
        url: 'admin/login',
        method: 'post',
        data: Qs.stringify(data)
    })
}