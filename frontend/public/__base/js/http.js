(function (doc, win) {
    class Http {
        constructor(app) {
            const _this = this;
            const { baseURL, withCredentials, timeout, contentType } = __APP_CONFIG__.api;

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
                    contentType: contentType
                },
            });

            // 请求拦截器
            _this.instance.interceptors.request.use((config)=> {
                // 1. Token鉴权
                const token = $LocalStorage.get('__token__');
                if (token) {
                    if (config.data) {
                        config.data = {...config.data, ...{ 'token': `${token}` }};
                    } else {
                        config.data = { token }
                    }
                }

                // 2. 參數加密
                if (config.data) {
                    const data = {
                        ...$Oauth.data(), 
                        ...config.data,
                    };

                    console.log('\x1b[1;30m\x1b[5m%s\x1b[0m', `@请求明文加密(明文)${config.url}`, data);
                    config.data = $CryptoData.Encrypt(data);
                }
                return config;
            }, (error) => {
                console.log(error)
            });

            // 响应拦截器
            _this.instance.interceptors.response.use((res)=> {
                const { data, status, config } = res;

                if (status === 200) {
                    const decryptData = $CryptoData.Decrypt(data.data, data.msg)
                    console.log('\x1b[1;32m\x1b[5m%s\x1b[0m', `@接口响应结果(明文) ${ +(new Date()) } ${config.url}`, decryptData);
            
                    // 正常处理
                    if (1 === decryptData.status) {
                        return decryptData;
                    }
                    
                    // 失败处理
                    else {
                        return decryptData;
                    }
                } else {
                    return data;
                }
            }, (error) => {
                console.log(error)
            });
        }

        // 获取实例
        getInstance() {
            const _this = this;
            return _this.instance;
        }
    }

    // 初始化
    win['$Http'] = new Http(win).instance;

})(document, window);
