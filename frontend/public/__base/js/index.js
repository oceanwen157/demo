(function (doc, win) {
    win.__loading = `${win.base_url}/__base/images/holder@3x.png`;
    win.__networkerror = `${win.base_url}/__base/images/holder@3x.png`;
    win.__TOKEN__ = "__token__";
    
    class ResourceLoader {
        // 初始构建
        constructor() {
            // 资源对象
            this.resources = {
                async: {
                    js: [

                    ]
                },
                css: [

                ],
                tpl: [
                    // 页面模板
                ],
                js: [

                ]
            }
        }

        // 脚本加载(异步)
        loadScriptsAsynchronous(urls) {
            try {
                urls.forEach(url => {
                    const script = document.createElement('script');
                    script.src = url;
                    script.onload = () => resolve();
                    script.onerror = (error) => reject(error);
                    document.head.appendChild(script);
                });
            } catch (error) {
                console.error(`Script(异步) 加载失败 ${urls}:`, error);
            }
        }

        // 脚本加载(同步)
        async loadScriptsSequentially(urls, index = 0) {
            if (index >= urls.length) {
                // console.log("@内置脚本加载完成~");
                return;
            }
        
            try {
                await new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.src = urls[index];
                    script.onload = () => resolve();
                    script.onerror = (error) => reject(error);
                    document.head.appendChild(script);
                });
                await this.loadScriptsSequentially(urls, index + 1);
            } catch (error) {
                console.error(`Script(同步) 加载失败 ${urls[index]}:`, error);
            }
        }

        // 模板加载
        async loadTemplateSequentially(urls, index = 0) {
            if (index >= urls.length) {
                // console.log("@内置模板加载完成~");
                return;
            }
            
            try {
                await new Promise((resolve, reject) => {
                    const script = document.createElement('script');
                    script.src = urls[index];
                    script.onload = () => resolve();
                    script.onerror = (error) => reject(error);
                    document.head.appendChild(script);
                });
                await this.loadTemplateSequentially(urls, index + 1);
            } catch (error) {
                console.error(`内置模板 加载失败 ${urls[index]}:`, error);
            }
        }

        // 样式加载
        async loadStylesSequentially(urls, index = 0) {
            if (index >= urls.length) {
                // console.log("@内置样式加载完成~");
                return;
            }
        
            try {
                await new Promise((resolve, reject) => {
                    const link = document.createElement('link');
                    link.rel = 'stylesheet';
                    link.href = urls[index];
                    link.onload = () => resolve();
                    link.onerror = (error) => reject(error);
                    document.head.appendChild(link);
                });

                await this.loadStylesSequentially(urls, index + 1);
            } catch (error) {
                console.error(`Style 加载失败 ${urls[index]}:`, error);
            }
        }

        // 响应加载
        async loadVueappSequentially(vueconfig) {

            return await new Promise((resolve, reject) => {
                if(!vueconfig) {
                    resolve();
                }
                try {
                    const { createApp, ref, h, resolveComponent, watch } = Vue;

                    // 封装配置
                    const data = Object.assign(vueconfig.data.call(this), {
                        isLogin: $LocalStorage.get(__TOKEN__) ? true : false,
                    });

                    // 移除变量
                    delete vueconfig.data;

                    // 初始配置
                    const v = createApp(_.merge({
                        data() {
                            return data;
                        },
                        directives: {
                            'imageParserUrl':  { beforeMount:  $Directives.ImageParser },
                            'imageLoaderUrl':  { beforeMount:  $Directives.ImageLoader },
                            'videoParserUrl':  { beforeMount:  $Directives.VideoParser },
                            'dragScroll':      { beforeMount:  $Directives.DragScroll  }
                        },
                        // 全局事件
                        methods: {
                            // 
                            onLogOut() {
                                const _this = this;
                                _this.isLogin = false;
                                $LocalStorage.del(__TOKEN__);
                            },

                            // 
                            onGlobalMenu() {
                                onPupopMenu();
                            }
                        },
                    }, vueconfig))

                    // 内置组件
                    if(vueconfig?.components) {
                        vueconfig.components.forEach(componentName => {
                            v.use(vant[`${componentName}`]);
                        });
                    }

                    // 挂载VUE
                    win.vue = v.mount("#xqbj-container");

                    // 弹窗处理
                    win['$Alert']            = vant.showToast;
                    win['$MessageClose']     = vant.closeToast;
                    win['$showFailToast']    = vant.showFailToast;
                    win['$MessageSuccess']   = vant.showSuccessToast;
                    win['$MessageLoading']   = vant.showLoadingToast;
                    win['$showSuccessToast'] = vant.showSuccessToast;

                    resolve(v);
                } catch (error) {
                    reject(error);
                }
            });
        }

        // 加载资源
        async loadResources(e) {
            const _this = this;
            try {
                // 加载JS
                // _this.loadScriptsAsynchronous(_this.resources.async.js.map(url => `${win.base_url}${url}`)),
                // 加载CSS
                await _this.loadStylesSequentially(_this.resources.css.map(url => `${win.base_url}${url}`)),
                // 模板加载
                await _this.loadTemplateSequentially(_this.resources.tpl.map(url => `${win.base_url}${url}`)),
                // 加载JS
                await _this.loadScriptsSequentially(_this.resources.js.map(url => `${win.base_url}${url}`)),
                // 加载Vue
                await _this.loadVueappSequentially(e?.vue)

            } catch (err) {
                console.error('加载资源异常:', err);
            }
        }
    }

    // 是否登陆
    win['$isLogin'] = () => {
        return $LocalStorage.get(__TOKEN__) ? true : false
    };

    // 防抖处理
    win['$Debounce'] = (func, delay) => {
        let timeout;
        return function (...args) {
            // 清除上一次的定时器
            clearTimeout(timeout);
    
            // 设置新的定时器，在延迟后执行实际的操作
            timeout = setTimeout(() => {
                func(...args);  // 执行传入的函数
            }, delay);
        };
    };

    // 初始化
    win.Launcher = (e) => {
        const rLoader = new ResourceLoader();
        return rLoader.loadResources(e);
    };

})(document, window);
