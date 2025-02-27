(function (doc, win) {

    const cryptodata = {
        mode: "CBC", 
        padding: "Pkcs7", 
        media_key: "102_53_100_57_54_53_100_102_55_53_51_51_54_50_55_48",
        media_iv: "57_55_98_54_48_51_57_52_97_98_99_50_102_98_101_49",
    };

    const cc = (e, o = true) => o ? (CryptoJS.enc.Utf8.parse(e.split("_").map((a) => String.fromCharCode(parseInt(a))).join(""))) : (e.split("_").map((a) => String.fromCharCode(parseInt(a))).join(""));
    
    const DecryptImage = function (word) {
        const decrypt = CryptoJS.AES.decrypt(word, cc(cryptodata.media_key), { iv: cc(cryptodata.media_iv), mode: CryptoJS.mode[cryptodata.mode], padding: CryptoJS.pad.NoPadding });
        const decryptedStr = decrypt.toString(CryptoJS.enc.Base64);
        return decryptedStr;
    };

    // 获取元素
    const imgels = document.querySelectorAll('img[z-image-loader-url]');
    console.log("@imgels", imgels);
    imgels.forEach(el => {
        // 交叉巡查
        new IntersectionObserver((e, o) => {
            if (e.pop().isIntersecting) {
                console.log("@进入了");
            } else {
                console.log("@离开了");
            }
        }).observe(el);
    }, {
        root: null, // 默认为 null，表示浏览器视口
        rootMargin: '0px', // 根元素的边距，视口的边缘
        threshold: 0.1 // 当目标元素的 10% 进入视口时触发
    });

    // 绑观察者
    imgels.forEach(el => {
        // 1. 初始参数
        const imglink = el.getAttribute("z-image-loader-url").replaceAll('`', '');
        const preview = el.getAttribute('data-image-preview') ? true : false;
        const noloads = el.getAttribute('data-no-loading') ? true : false;
        const imgtype = imglink.split('.').pop();

        // 2. 初始加载
        if (!noloads) {
            el.setAttribute('class', el.getAttribute('class') + ' loading');
        }

        // 交叉巡查
        new IntersectionObserver((e, o) => {
            if (e.pop().isIntersecting) {
                // 1. 获取图片(二进制)
                fetch(imglink).then(response => response.blob())
    
                // 2. 图片解密
                .then((blob) => {
                    return new Promise((resolve, reject) => {
                        const fileReader = new FileReader();
                        try {
                            fileReader.readAsDataURL(blob);
                            fileReader.onload = ({ target: { result: ebase64Image } }) => {
                                resolve(`${DecryptImage(ebase64Image.split(',').pop())}`);
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
                    preview && el.addEventListener("click", function () {
                        showImagePreview({
                            images: [localImage], closeable: true, showIndex: false
                        });
                    });
    
                    // 图片加载
                    el.setAttribute("load", "success");
                    el.setAttribute('src', `${localImage}`);
                    el.onload = () => el.setAttribute('class', (el.getAttribute('class')).split(" loading").join(""));
                })
    
                // 4. 异常处理
                .catch((err) => {
                    !noloads && el.setAttribute('src', err) && el.setAttribute('class', (el.getAttribute('class')).split(" loading").join(""));
                    console.error('图片获取失败:', err);
                })
                .finally(() => {
                    // 停止触发
                    el && o.unobserve(el);
                })
            } else {
                console.log("@离开了");
            }
        }).observe(el);
    }, {
        root: null, // 默认为 null，表示浏览器视口
    });

})(document, window);