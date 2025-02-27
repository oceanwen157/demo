/**
 * desc: 响应拦截器
 * date: 2023.03.20
 */
// import CryptoData from '../utils/crypto-data'

// 响应结果处理
export function resConfig(res, { $CryptoData, $router, $Store, $Alert, $i18n, $NavigateTo, $Moment }) {
    const { data, status, config } = res;

    if (status === 200) {
        const decryptData = $CryptoData.Decrypt(data.data, data.msg)
        process.client && console.log('\x1b[1;32m\x1b[5m%s\x1b[0m', `@接口响应结果(明文) ${ +(new Date()) } ${config.url}`, decryptData);

        // 正常处理
        if (1 === decryptData.status) {
            return Promise.resolve(decryptData);
        }

        // 失效登录
        else if (420 === decryptData.status) {
            if(!$Store.user.token) {
                $NavigateTo('/login')
                return Promise.reject("请重新登录");
            } else {
                $Store.user.logout(true).then(()=>$NavigateTo('/login'))
                return Promise.reject("请先登录");
            }
        } 
        
        // 失败处理
        else {
            return Promise.reject(decryptData);
        }
    } else {
        return Promise.reject(data);
    }
}

// // 响应错误处理
export function resError(error) {
    if (error?.response?.status) {
        switch (error.response.status) {
            // 401: 未登录              
            case 420:

                break;

            // 其他错误
            default:
        }

    }
    return Promise.reject(error);
}