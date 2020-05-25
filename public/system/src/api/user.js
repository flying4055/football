import request from '../utils/request';

export const fetchData = query => {
    return request({
        url: 'user/get_list',
        method: 'get',
        params: query
    });
};
