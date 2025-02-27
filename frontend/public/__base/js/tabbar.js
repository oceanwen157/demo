/**
 * 全局菜单
 */
(function (doc, win, $) {
    class TabbarBulidr {

        // 初始构建
        constructor(container) {
            this.mobileBulidr();
            this.desktopBulidr();
        }

        // 构建菜单
        desktopBulidr() {
            const rootElementName= `#xqbj-container .xqbj-footer div[module="tabber@desktop"]`;
            const navbarTplContent = ``;
        }

        // 构建菜单
        async mobileBulidr() {
            const { createApp, ref, h, resolveComponent } = Vue;
            const rootElementName = `#xqbj-container .xqbj-footer div[module="tabber@mobile"]`;
            await new Promise((resolve, reject) => {
                try {
                    // 如不存在
                    if ($(`${rootElementName}`).length === 0) {
                        return false;
                    }

                    // 默认标签(底部栏)
                    let active = $(`${rootElementName}`)?.attr('active') ?? 0;

                    // 默认标签(地址栏)
                    const hashActive = window.location.hash.match(/\d+/g);
                    if (hashActive?.[0]) {
                        active = hashActive?.[0];
                    }

                    console.log("@active", active);

                    // 构建弹窗
                    const app = createApp({
                        data() {
                            return {
                                tabActive: +active,
                            };
                        },
                        methods: {
                            onTabber(i) {
                                const _this = this;
                                _this.active = i;
                            }
                        },
                        mounted() {
                        },
                    }).mount(`${rootElementName}`);

                    resolve(app);
                } catch (error) {
                    reject(error);
                }
            });
        }
    }

    // 底部菜单
    new TabbarBulidr();

    // 浮标处理
    doc.addEventListener('DOMContentLoaded', () => {
        let scrollTimeout;
        const winheight = win.innerHeight;
        const floatbtns = doc.getElementById('bubble-group-menu');
        win.addEventListener('scroll', () => {
            if (!floatbtns) return;

            // 初始关闭
            floatbtns.classList.add('hidden');
            clearTimeout(scrollTimeout);

            // 检测高度
            const scrollTop = window.scrollY || doc.documentElement.scrollTop;
            if (scrollTop < winheight) return;

            // 操作开启
            scrollTimeout = setTimeout(() => {
                floatbtns.classList.remove('hidden');
            }, 600);
        });
    });

})(document, window, jQuery);
