
/**
 * desc: 设备标识类
 * date: 2023.03.20
 * 
 * 主要方法:
 * data():    获取标识
 * reset():   重置标识
 * isExist(): 存在标识
 */

(function (doc, win) {
    class Oauth {
        static _LOCAL_OAUTHID = '___USER__OAUTHID';
        
        // 初始化
        constructor({ $LocalStorage }) {
            const _this = this;
    
            if (_this.instance) {
                return _this;
            }
    
            _this.instance = true;
            _this.oauth_type = 'web'
    
            // 封装
            const getdata = () => {
                return {
                    bundleId: "com.pwa.Chaguaner",
                    version: "3.3.1",
                    
                    oauth_id: _this.oauth_id,
                    oauth_new_id: `${_this.oauth_id}123`,
                    oauth_type: _this.oauth_type,
                    language: 'zh',
                    via: 'pch',
                    token: ''
                };
            }
    
            // 生成
            const generate = () => {
                var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                var id = '';
                var date = +new Date();
                for (var i = 0; i < 19; i++) {
                    id += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return `${id}${date}`;
            }
    
            // 获取
            _this.data = () => {
                const _this = this;
    
                // 存在？
                if(_this?.oauth_id) {
                    return getdata();
                }
    
                // 存在？
                if(_this?.isExist()) {
                    return getdata();
                }
    
                // 生成
                _this.oauth_id = generate();
                // 同步本地
                $LocalStorage.set(Oauth._LOCAL_OAUTHID, _this.oauth_id);
                // 同步内存
                // todo...
    
                return getdata();
            }
    
            // 重置
            _this.reset = () => {
                const _this = this;
                
                // 生成
                _this.oauth_id = generate();
                // 同步本地
                process.client && $LocalStorage.set(Oauth._LOCAL_OAUTHID, _this.oauth_id);
                // 同步内存
                // todo...
    
                return getdata();
            }
    
            // 存在？
            _this.isExist = () => {
                const _this = this;
                let oauth = $LocalStorage?.get(Oauth._LOCAL_OAUTHID)??false;
                if(oauth) {
                    _this.oauth_id = oauth;
                    return true;
                } else {
                    return false;
                }
                return false;
            }
    
            return false
        }
    }

    // 初始化
    win['$Oauth'] = new Oauth(win);
    // console.log(`@设备生成器加载完成~`);
})(document, window);



// export default defineNuxtPlugin(nuxtApp => {
//     const oauth = new Oauth(nuxtApp);
//     nuxtApp.provide('Oauth', oauth)

//     console.log(`【${process.client ? 'CSR' : 'SSR'}】@设备生成器加载完成~`);
// })