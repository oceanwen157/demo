/**
 * 环境配置
 */
(function (doc, win) {
    const exportConfig = {
        // 
        title: '51情报局',
    
        // 页面路由
        pages: [
    
        ],
    
        // 接口配置
        api: {
            baseURL: "http://apiv3.hjsq2.com/api.php",
            withCredentials: false,
            timeout: 50000,
            contentType: 'application/x-www-form-urlencoded'
        },
    
        // 加密配置
        crypto: {
            mode: "CBC", 
            padding: "Pkcs7", 
            media_key: "102_53_100_57_54_53_100_102_55_53_51_51_54_50_55_48",
            media_iv: "57_55_98_54_48_51_57_52_97_98_99_50_102_98_101_49",
            // key: "98_56_50_98_57_55_51_57_53_51_54_54_101_57_99_101",
            // iv: "102_99_99_54_48_99_51_102_54_51_50_97_49_53_100_55",
            // sign_key: "100_97_56_54_53_54_56_98_101_57_99_54_50_48_56_97_54_52_52_56_55_48_101_49_50_100_54_97_53_101_102_52",
            key: "50_97_99_102_55_101_57_49_101_57_56_54_52_54_55_51",
            iv: "49_99_50_57_56_56_50_100_51_100_100_102_99_102_100_54",
            sign_key: "53_53_56_57_100_52_49_102_57_50_97_53_57_55_100_48_49_54_98_48_51_55_97_99_51_55_100_98_50_52_51_100",
        },
    
        // 适配配置
        adaptation: {
            baseSize: 16,
            mobileMaxWidth: 960,
            mobileClientWidth: 390 - 70,
            mobileDesktopWidth: 720,
        },
    
        // 主题配置
        theme: {
            baseFont: 'Microsoft Yahei", -apple-system, BlinkMacSystemFont, "Helvetica Neue", Helvetica, Segoe UI, Arial, Roboto, "PingFang SC", "Hiragino Sans GB", sans-serif',
            fontSize: '1.2rem',
            backgroundColor: '#ffffff',
            backgroundMainColor: 'linear-gradient(to top, #f9faff 60%, #d8e0fb)',
            boxShadow: '0 0.1rem 0.1rem 0 rgb(41 41 41 / 0.2)',
        },
    
        // 头部导航
        navbar: {
            vanNavBarHeight: '3.0rem',
            vanNavBarTitleFontSize: '1.8rem',
            vanNavBarTitleTextColor: '#aaaaaa',
            vanNavBarArrowSize: '2.4rem',
            vanNavBarIconColor: '#ececec',
            vanNavBarTextColor: '#ececec',
            vanNavBarBackground: 'transparent',
            vanFieldPlaceholderTextColor: '#F9FAFF',
        },
        
        // 底部菜单
        navtar: {
            vanBorderColor: "#000000",
            vanTabbarItemFontSize: "0.9rem",
            vanTabbarItemIconSize: "2.1rem",
            vanTabbarBackground: "#121212",
            vanTabbarItemTextColor: "#ffffff",
            vanTabbarItemActiveColor: "#6e5ef1",
            vanTabbarItemActiveBackground: "#121212",
            menu: [
                {
                    title: 'tabar.home',
                    value: 'home',
                    icon: '/images/tabbar/home.3x.png', 
                    iconselect: '/images/tabbar/home.v.3x.png', 
                    router: `/`
                },
                {
                    title: 'tabar.explorations',
                    value: 'search',
                    icon: '/images/tabbar/search.3x.png',
                    iconselect: '/images/tabbar/search.v.3x.png',
                    router: `/search`
                },
                {
                    title: 'tabar.creations',
                    value: 'make',
                    icon: '/images/tabbar/creation.3x.png',
                    iconselect: '/images/tabbar/creation.v.3x.png',
                    router: `/make/index`,
                },
                {
                    title:'tabar.video',
                    value: 'video',
                    icon: '/images/tabbar/video.3x.png',
                    iconselect: '/images/tabbar/video.v.3x.png',
                    router: `/video`
                },
                {
                    title:'tabar.mine',
                    value: 'my',
                    icon: '/images/tabbar/my.3x.png',
                    iconselect: '/images/tabbar/my.v.3x.png',
                    router: `/my`
                },
            ]
        },
    
        // Web端
        desktop: {
            maxWidth: '72.0rem',
            headerHeight: '6.0rem',
            scrollbarWidth: "0.9rem",
            scrollbarBorderRadius: "0.3rem",
            scrollbarBackgroundColor: "#f2f3f5",
            scrollbarThumbBackgroundColor: "#c8c9cc",
        },
    
        // 弹窗配置
        dialog: {
            radius: '1.6rem',
            theme: 'round-button',
            textColor: "#000000",
            fontSize: "1.6rem",
            backgroundColor: "#ffffff",
            leftButtonBackgroundColor: "#eeeeee",
            rightButtonBackgroundColor: "linear-gradient(to right, #f73579, #ff84b0)",
        },
    
    }

    // 初始化
    win.__APP_CONFIG__ = exportConfig;
})(document, window);