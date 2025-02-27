// 图片解析器

(function (doc, win) {
    win['$Directives'] =  {...win['$Directives'], ...{
        ImageParser: async ({ imgurl }) => {
            if(imgurl) {
                const imgtype = imgurl.split('.').pop();
    
                // 1. 获取图片(二进制)
                return await axios.get(imgurl, { responseType: 'arraybuffer' })
            
                // 2. 接受图片
                .then(({ data }) => {
                    return new Promise((resolve, reject) => {
                        try {
                            resolve(new Blob([data]));
                        } catch (error) {
                            reject(error);
                        }
                    });
                })
        
                // 3. 图片解密
                .then((blob) => {
                    return new Promise((resolve, reject) => {
                        // if(process.client) {
                            const fileReader = new FileReader();
                            try {
                                fileReader.readAsDataURL(blob);
                                fileReader.onload = ({ target: { result: ebase64Image } }) => {
                                    resolve(`${$CryptoData.DecryptImage(ebase64Image.split(',').pop())}`);
                                };
                            } catch (error) {
                                reject(error);
                            }
                        // } else {
                        //     reject("SSR端禁止解析图片")
                        // }
                    });
                })
        
                // 4. 本地地址
                .then((base64Image) => {
                    let byteImage = new Uint8Array(atob(base64Image).split('').map((c) => c.charCodeAt(0)));
                    let blobImage = new Blob([byteImage], { type: `image/${imgtype}` });
                    let localImage = URL.createObjectURL(blobImage);
        
                    // 添加缓存
                    // if(!$GlobalObject['_CACHE_IMAGES_MAPS']) {
                    //     $GlobalObject['_CACHE_IMAGES_MAPS'] = {};
                    // } else {
                    //     $GlobalObject['_CACHE_IMAGES_MAPS'][$Encrypt(imgurl)] = `${localImage}`;
                    // }
    
                    // 图片加载
                    return `${localImage}#.${imgtype}`;
                })
        
                // 5. 异常处理
                .catch((err) => {
                    console.error('图片获取失败:', err);
                })
            }; 
        },

        ImageLoader: (el, binding, vnode) => {
            // return false;
            if (!binding.value) return false;
    
            // 初始参数
            const imglink = binding.value;
            const preview = el.getAttribute('data-image-preview') ? true : false;
            const noloads = el.getAttribute('data-no-loading') ? true : false;
            const imgtype = imglink.split('.').pop();
            
            // 初始加载
            if (!noloads) {
                el.setAttribute('src', __loading);
                el.setAttribute('class', el.getAttribute('class') + ' loading');
            }
    
            // 缓存取图
            // if ($GlobalObject['_CACHE_IMAGES_MAPS']?.[$Encrypt(imglink)]) {
            //     el.setAttribute('src', $GlobalObject['_CACHE_IMAGES_MAPS']?.[$Encrypt(imglink)]);
            //     el.onload = () => el.setAttribute('class', (el.getAttribute('class')).split(" loading").join(""));
            //     return false;
            // }
    
            // 交叉巡查
            new IntersectionObserver((e, o) => {
                if (e.pop().isIntersecting) {
                    // 1. 获取图片(二进制)
                    axios.get(imglink, { responseType: 'arraybuffer' })
    
                    // 2. 接受图片
                    .then(({ data }) => {
                        return new Promise((resolve, reject) => {
                            try {
                                resolve(new Blob([data]));
                            } catch (error) {
                                reject(error);
                            }
                        });
                    })
    
                    // 3. 图片解密
                    .then((blob) => {
                        return new Promise((resolve, reject) => {
                            const fileReader = new FileReader();
                            try {
                                fileReader.readAsDataURL(blob);
                                fileReader.onload = ({ target: { result: ebase64Image } }) => {
                                    resolve(`${$CryptoData.DecryptImage(ebase64Image.split(',').pop())}`);
                                };
                            } catch (error) {
                                reject(error);
                            }
                        });
                    })
    
                    // 4. 监听事件
                    .then((base64Image) => {
                        let byteImage = new Uint8Array(atob(base64Image).split('').map((c) => c.charCodeAt(0)));
                        let blobImage = new Blob([byteImage], { type: `image/${imgtype}` });
                        let localImage = URL.createObjectURL(blobImage);
                        // 图片浏览
                        preview && el.addEventListener("click", function () {
                            showImagePreview({
                                images: [localImage], closeable: true, showIndex: false
                            });
                        });
    
                        // 异常处理
                        el.addEventListener("error", function () {
                            !noloads && el.setAttribute('src', error) && el.setAttribute('class', (el.getAttribute('class')).split(" loading").join(""));
                        });
    
                        // 添加缓存
                        // if (!$GlobalObject['_CACHE_IMAGES_MAPS']) {
                        //     $GlobalObject['_CACHE_IMAGES_MAPS'] = {};
                        // } else {
                        //     $GlobalObject['_CACHE_IMAGES_MAPS'][$Encrypt(imglink)] = `${localImage}`;
                        // }
    
                        // 图片加载
                        el.setAttribute("load", "success");
                        el.setAttribute('src', `${localImage}`);
                        el.onload = () => el.setAttribute('class', (el.getAttribute('class')).split(" loading").join(""));
                    })
    
                    // 5. 异常处理
                    .catch((err) => {
                        !noloads && el.setAttribute('src', error) && el.setAttribute('class', (el.getAttribute('class')).split(" loading").join(""));
                        console.error('图片获取失败:', err);
                    })
                    .finally(() => {
                        // 停止触发
                        el && o.unobserve(el);
                    })
                }
            }).observe(el);
        }
    }}
})(document, window);
