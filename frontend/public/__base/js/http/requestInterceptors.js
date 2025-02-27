/**
 * desc: 请求拦截器
 * date: 2023.03.20
 */

// import Store from '@/store'
// import CryptoData from '../utils/crypto-data'
// import Oauth from '../utils/oauth'

// 请求准备处理
export function reqConfig (config, { $CryptoData, $Oauth, $Store }) {
    // 根据实际接口情况做以下处理

    // 参数序列化
    // config.data = JSON.stringify(config.data);

    // Token鉴权
    const token = $Store?.user?.token;
    if (token) {
        if (config.data) {
            config.data = {...config.data, ...{ 'token': `${token}` }};
        } else {
            config.data = { token }
        }
    }
    // 參數加密
    if (config.data) {
        const data = {
            ...$Oauth.data(), 
            ...config.data,
        };

        process.client && console.log('\x1b[1;30m\x1b[5m%s\x1b[0m', `@请求明文加密(明文)${config.url}`, data);
        config.data = $CryptoData.Encrypt(data);
    }

    return config;
}

// 请求错误处理
export function reqError(error) {
    return Promise.reject(error);
}