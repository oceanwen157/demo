/**
 * desc: Axios初始化
 * date: 2023.03.20
 */
import axios from 'axios'
import { reqConfig, reqError } from './requestInterceptors'
import { resConfig, resError } from './responseInterceptors'

class Http {
    constructor(app) {
        const _this = this;
        const { baseURL, withCredentials, timeout, contentType } = useAppConfig().api;

        // 单例模式
        if (_this.instance) {
            return _this.instance;
        }

        // 创建axios实例
        _this.instance = axios.create({
            method: 'POST',
            baseURL: baseURL,
            withCredentials: withCredentials,
            timeout: timeout,
            headers: {
                'Content-Type': contentType
            }
        });

        // 请求拦截器
        _this.instance.interceptors.request.use((e)=>reqConfig(e, app), reqError);

        // 响应拦截器
        _this.instance.interceptors.response.use((e)=>resConfig(e, app), resError);
    }

    // 获取实例
    getInstance() {
        const _this = this;
        return _this.instance;
    }
}

// 
export default defineNuxtPlugin((nuxtApp) => {
    const http = new Http(nuxtApp).getInstance();
    nuxtApp.provide('Http', http)

    console.log(`【${process.client ? 'CSR' : 'SSR'}】@网络构建器加载完成~`);
})