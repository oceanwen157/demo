(function (doc, win) {
    // 自定名称
    const pluginname = "z-image-loader-url"

    // 加解信息
    const { crypto } = __APP_CONFIG__;

    // 字序列化
    const cc = (e, o = true) => o ? (CryptoJS.enc.Utf8.parse(e.split("_").map((a) => String.fromCharCode(parseInt(a))).join(""))) : (e.split("_").map((a) => String.fromCharCode(parseInt(a))).join(""));
    
    // 字符解密
    const decrypt = function (word) {
        const decrypt = CryptoJS.AES.decrypt(word, cc(crypto.media_key), { iv: cc(crypto.media_iv), mode: CryptoJS.mode[crypto.mode], padding: CryptoJS.pad.NoPadding });
        const decryptedStr = decrypt.toString(CryptoJS.enc.Base64);
        return decryptedStr;
    };

    // 图片解密
    const loader = function (el) {
        // 1. 初始参数
        const __this = el;
        const imglink = (__this?.getAttribute(pluginname) || '').replaceAll('`', '').replaceAll("'", '');
        const preview = __this.getAttribute('data-image-preview') ? true : false;
        const noloads = __this.getAttribute('data-no-loading') ? true : false;
        const imgtype = imglink.split('.').pop();

        // 2. 初始加载
        if (!noloads) {
            __this.classList.add('loading');
        }

        // __this.style.border = '0.1rem solid green';

        // 1. 获取图片(二进制)
        fetch(imglink, { timeout: 1000 * 30 }).then(response => response.blob())
    
        // 2. 图片解密
        .then((blob) => {
            // __this.style.border = '0.1rem solid red';
            return new Promise((resolve, reject) => {
                const fileReader = new FileReader();
                try {
                    fileReader.readAsDataURL(blob);
                    fileReader.onload = ({ target: { result: ebase64Image } }) => {
                        resolve(`${decrypt(ebase64Image.split(',').pop())}`);
                    };
                } catch (error) {
                    reject(error);
                }
            });
        })

        // 3. 监听事件
        .then((base64Image) => {
            let byteImage = new Uint8Array(atob(base64Image).split('').map((c) => c.charCodeAt(0)));
            let blobImage = new Blob([byteImage], { type: `image/${imgtype}` });
            let localImage = URL.createObjectURL(blobImage);

            // 图片浏览
            // preview && __this.addEventListener("click", function () {
            //     showImagePreview({
            //         images: [localImage], closeable: true, showIndex: false
            //     });
            // });

            // 图片加载
            __this.setAttribute("load", "success");
            __this.setAttribute('src', `${localImage}`);
            // __this.classList.remove('loading')
            __this.onload = () => {
                // console.log('图片获取成功', __this);
                __this.classList.remove('loading')
            };

            __this.onerror = (err) => {
                console.error('图片获取失败:', err);
            };
        })

        // 4. 异常处理
        .catch((err) => {
            !noloads && __this.setAttribute('src', err) && __this.setAttribute('class', (__this.getAttribute('class')).split(" loading").join(""));
            console.error('图片获取失败2:', err);
        })
        .finally(() => {
            // 停止触发
            // el && o.unobserve(el);

            // 事件补充
            setTimeout(() => {
                Array.from(document.querySelectorAll(`img[${pluginname}]:not([src])`)).map(e => e.classList.add('lazyload'));
            }, 1000);
        })
    };

    // 
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. 元素初始化 
        Array.from(document.querySelectorAll(`img[${pluginname}]`)).map(e => e.classList.add('lazyload'));

        // 2. 自定义配置
        window.lazySizesConfig = window.lazySizesConfig || {};

        // 3. 加载前触发
        document.addEventListener('lazybeforeunveil', function (e) {
            // console.log('加载前触发', e.target);
            loader(e.target);
        });

        // 4. 加载完触发
        document.addEventListener('lazyloaded', function (e) {
            // console.log('加载完触发', e.target);
            loader(e.target);
        });

        console.log("@图片加载加载完成~");
    });

    window.addEventListener('scroll', function(event) {
        Array.from(document.querySelectorAll(`img.loading[${pluginname}][src]`)).map(e => e.classList.remove('loading'));
        Array.from(document.querySelectorAll(`img.loading.lazyloaded[${pluginname}]:not([src]`)).map(e => {
            e.classList.add('lazyload');
            e.classList.remove('lazyloaded')
        });
        Array.from(document.querySelectorAll(`img[${pluginname}]:not([src])`)).map(e => e.classList.add('lazyload'));
    });

})(document, window);