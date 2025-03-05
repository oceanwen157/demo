(function (doc, win) {
    // 获取cookie
    const getCookie = (name) =>{
        let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        return match ? match[2] : null;
    }

    // 设置cookie
    const setCookie = (name, value, days) => {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // 提示警告
    const onPromptWarn = () => {
        if(win.$SplashRefresh()) {
            $(".modal-splash-page").removeClass("hidden");
        } else {
            $(".modal-splash-page").addClass("hidden");
        }
    };

    // 视频评分
    const onVideoRating = (ele) => {

        // 关闭弹窗
        const closeRatePupop = (e) => {
            $(e).css({ 
                "border-radius": "50%",
                "width": "4.0rem",
                "height": "4.0rem",
                "font-size": "1.5rem",
            }).siblings().hide();

            // 禁用评分
            setTimeout(() => {
                $(e).parents('.rating-card').removeClass("rating-card");
                $(e).parents('.item-rating-container').addClass("item-rating-disabled");
            }, 1000);
        };

        // 评分(打开)
        $(doc).on('click', '.rating-card', (e) => {
            $(e.currentTarget).find(".item-rating-container").removeClass("item-rating-disabled");
        });

        // 评分(关闭)
        $(doc).on('click', 'button.item-rating-none', (e) => {
            e.preventDefault();
			e.stopPropagation();
            $(e.currentTarget).parents('.item-rating-container').addClass("item-rating-disabled");
        });

        // 评分(赞)
        $(doc).on('click', 'button.item-rating-positive', (e) => {
            e.preventDefault();
            e.stopPropagation();

            // TODO................................................................

            // 关闭弹窗
            closeRatePupop(e.currentTarget);
            
        });

        // 评分(孬)
        $(doc).on('click', 'button.item-rating-negative', (e) => {
            e.preventDefault();
            e.stopPropagation();

            // TODO................................................................

            // 关闭弹窗
            closeRatePupop(e.currentTarget);
        });
    }

    // 导航搜索
    const onNavFilter = (ele) => {
        $("form[name='filter']").on('change', 'input, select, textarea', (e) => {
            //var formSerializeArray = $("form[name='filter']").serializeArray();
            //var formSerialize = $("form[name='filter']").serialize();
            
            //console.log('表单数据发生变化: ', formSerializeArray);
            //location.href = `#${formSerialize}`;
            $("form[name='filter']")[0].submit();
        });
    }

    // 页面状态(跳转、刷新)
    win['$WinRefresh'] = () => {
        // 获取当前页面的域名
        let referrerDomain = "";
        let currentDomain = window.location.hostname;
        try {
            if (document.referrer) {
                referrerDomain = new URL(document.referrer).hostname;
            }
        } catch (e) {
            console.error("无效的 referrer URL:", e);
        }
        
        // 跳转(站内)
        if (referrerDomain === currentDomain) {
            return false;
        } 

        // 刷新
        else if (referrerDomain === "") {
            return true;
        } 
        
        // 跳转(站外)
        else {
            return true;
        }
    }

    // 服务状态(首次访问)
    win['$SplashRefresh'] = () => {
        let splashPageShown = getCookie("splashPageShown");

        // 没有Cookie
        if (splashPageShown) {
            return false;
        } 
        
        // 存在Cookie
        else {
            return true
        }
    }

    // 初始化
    document.addEventListener('DOMContentLoaded', function() {
        // 提示警告
        onPromptWarn();

        // 视频评分
        onVideoRating();

        // 导航搜索
        onNavFilter();

        // 绑定事件
        doc.body.addEventListener("click", function (e) {
            // 提示警告
            if (e?.target.matches(".eighteen-plus-button")) {
                setCookie("splashPageShown", "true", 1);
                $(".modal-splash-page").addClass("hidden");
            }

            // 视频评分
            if (e?.target.matches(".item-rating-option.item-rating-positive")) {
                console.log("positive");
            }
        });

    });
})(document, window);
