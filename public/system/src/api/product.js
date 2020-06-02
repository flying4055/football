import request from '../utils/request';

export const fetchData = query => {
    return request({
        url: 'product/get_list',
        method: 'get',
        params: query
    });
};
