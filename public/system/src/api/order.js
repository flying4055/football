import request from '../utils/request';

export const fetchData = query => {
    return request({
        url: 'order/get_list',
        method: 'get',
        params: query
    });
};
