/**
 * desc: 屏幕适配
 * date: 2023.03.20
 */

(function (doc, win) {
    // 设备类型
    const isMobile = () => navigator.userAgent.match(
        /(phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone)/i
    );

    // 
    const isSafari = () => {
        return /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    }

    // 设置尺寸
    const setRem = () => {
        const { baseSize, designMobileWidth, adaptationWidth } = {
            baseSize: 16,

            mobileMaxWidth: 320,
            designMobileWidth: 640,

            adaptationWidth: 700,
            designDesktopWidth: 700
        };

        let scale;
        let space;
        let clientWidth = document.documentElement.clientWidth;

        // 设备类型(浏览器)
        if (isMobile()) {
            space = "mobile";
            scale = clientWidth / designMobileWidth;
        } else {
            space = "desktop";
            scale = 1;
        }

        // 设备类型(备宽度)
        if (adaptationWidth >= clientWidth) {
            space = "mobile";
            scale = clientWidth / designMobileWidth;
            // app.$Store.global.setDeviceType(false)
        } else {
            space = "desktop";
            // scale = 1;
            scale = clientWidth / designMobileWidth;
            // app.$Store.global.setDeviceType(true)
        }
    
        // document.documentElement.style.fontSize = (baseSize * Math.min(scale, 2)) + 'px'
      document.documentElement.setAttribute("id", space);

        // SAFARI全局处理
        if(isSafari()) {
            // 添加独有标识
            document.documentElement.classList.add('safari');
        } else {
            // 删除独有标识
            document.documentElement.classList.remove('safari');
        }

        // 处理底部安全区适配
        if ('visualViewport' in window) {
            if(isMobile()) {
                document.documentElement.style.setProperty('--default-safari-bottom-height', `calc(100vh - 100dvh)`);
            }
        }
    }

    setRem();
	win.addEventListener('resize', () => {
		setRem()
	})

  // 主题切换
  const __THEME__ = 'theme';
  const html = doc.documentElement;
  const body = doc.body;
  const theme = localStorage.getItem(__THEME__);

  // 主题设置
  const setTheme = function (theme) {
    if(theme) {
      // 设置主题
      html.setAttribute(__THEME__, theme);
      // 关闭过滤
      body.style.filter = 'none';
      // 存储主题
      localStorage.setItem(__THEME__, theme);
    }
  }

  // 主题切换
  doc.addEventListener('click', function(event) {
    // 检查事件目标是否匹配选择器
    if (event.target.matches('.themebtn')) {
      switch (html.getAttribute(__THEME__)) {
        case 'dark':  setTheme('light'); break;
        case 'light': setTheme('dark');  break;
        default:      setTheme('light'); break;
      }
    }
  });

  // 初始加载
  setTheme(theme);
})(document, window);