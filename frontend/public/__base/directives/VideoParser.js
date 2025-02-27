// 视频解析器

(function (doc, win) {
    
    win['$Directives'] =  {...win['$Directives'], ...{
        VideoParser: (video, binding, vnode) => {
            if (!binding.value) {
                console.error(`视频加载失败原因：无效资源地址`);
                video.setAttribute('poster', __networkerror);
                video.style.objectFit = 'scale-down';
                return false
            }
    
            // 初始配置
            const hls = new Hls();
            const videourl = binding.value;
            const noloads = video.getAttribute('data-no-loading') ? true : false;
            const poster = video.getAttribute('data-poster') ?? null;
    
            // 初始加载
            !noloads && video.setAttribute('poster', __loading);
    
            // 加载封面
            $Directives.ImageParser({ imgurl: poster }).then((url) => {
                url && video && video.setAttribute('poster', url);
            });
    
            // 异常处理
            video.addEventListener("error", function (e) {
                if (4 === video?.error?.code) {
                    video.setAttribute('poster', __networkerror);
                    video.style.objectFit = 'scale-down';
                    console.log("视频正常关闭");
                } else {
                    // console.error(`视频加载失败原因：`, video?.error?.code);
                    // console.error(`视频加载失败原因：`, video?.error);
                    // video.setAttribute('poster', __networkerror);
                    // video.style.objectFit = 'scale-down';
                }
            });
    
            // 加载失败
            hls.on(Hls.Events.ERROR, function (event, data) {
                video.setAttribute('poster', __networkerror);
                video.style.objectFit = 'scale-down';
                console.error(`视频加载失败原因：${data.type} - ${data.details}`);
            });
    
            // 交叉巡查
            new IntersectionObserver((e, o) => {
                if (e.pop().isIntersecting) {
                    // 创建资源
                    const source = document.createElement('source');
                    source.src = videourl;
                    source.type = 'video/mp4';
    
                    // 初始属性
                    video.playsinline = true;
                    video.webkitPlaysinline = true;
                    video.controls = true;
                    video.autoplay = true;
                    video.muted = true;
                    video.controlslist = 'nodownload noremoteplayback';
                    video.appendChild(source);
    
                    // 区分处理
                    setTimeout(() => {
                        if (/\.(m3u8)(\?|$)/.test(videourl)) {
                            hls.loadSource(videourl);
                            hls.attachMedia(video);
                            hls.on(Hls.Events.MANIFEST_PARSED, function () {
                                // 自动播放
                                const playPromise = video.play();
                                if (playPromise !== undefined) {
                                    playPromise.then(() => {
                                        video.muted = false;
                                        video.style.objectFit = 'cover';
                                    })
                                    .catch(error => {
                                        console.error('HLS播放失败原因-SRC', error)
                                    });
                                }
                            });
                        } else {
                            const playPromise = video.play();
                            if (playPromise !== undefined) {
                                playPromise.then(() => {
                                    video.muted = false;
                                    video.style.objectFit = 'cover';
                                })
                                .catch(error => {
                                    console.error('err', error)
                                });
                            }
                        }
                    }, 0);
    
                    // 停止触发
                    video && o.unobserve(video);
                    // });
                } else {
                    console.log("@离开了");
                }
            }).observe(video);
        }
    }}
})(document, window);
