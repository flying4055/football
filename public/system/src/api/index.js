import request from '../utils/request';
import Qs from 'qs';

export const fetchData = query => {
    return request({
        url: './table.json',
        method: 'get',
        params: query
    });
};

export const uploadImage = query => {
    return request({
        url: "/upload_image",
        method: 'post',
        data: Qs.stringify(data)
    })
}