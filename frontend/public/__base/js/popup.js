/**
 * 全局菜单
 */
(function (doc, win) {
    class PopupLoader {

        // 初始构建
        constructor({ url, key, single }) {
            this.url    = url??'#';
            this.key    = key;
            this.single = single;
        }

        // 构建菜单
        popup(e) {
            const _this = this;

            return new Promise((resolve, reject) => {
                try {
                    const { createApp, ref, h, resolveComponent } = Vue;
                    const popupName = `POPUP-WINDOW-${_this.key}`;
                    const isOverlay = ($(top.document.body).find(`div.van-overlay`).length !== 0);

                    e?.datas?.loading &&win.$MessageLoading('加载中...');

                    // 如不存在
                    if ($(top.document.body).find(`#${popupName}`).length !== 0) {
                        return false;
                    }

                    // 建根元素
                    $(top.document.body).append($(`<div id="${popupName}" style="display: none;"></div>`));
                    // 构建弹窗
                    const app = createApp({
                        // 变量定义
                        data() {
                            return {
                                
                            };
                        },

                        methods: {
                            onPopupClose() {
                                $(`#${popupName}`).remove();
                            },

                            onLoadIframe(event) {
                                win.$MessageClose();
                                $(`#${popupName}`).show();
                            },
                        },

                        render() {
                            const overlay = h('div', { class: (isOverlay ? 'van-overlay' : 'van-overlay'), onclick: this.onPopupClose });
                            const popuper = h('div', { role: 'dialog', id: 'van-popup-window', tabindex: 0, class: 'van-popup van-popup--round van-popup--center' }, [
                                h('div', { class: 'content' }, [
                                    h('iframe', {  
                                        src: `${win.base_url}${_this.url}`, 
                                        onload: this.onLoadIframe,
                                        onclick: this.onPopupClose 
                                    })
                                ]),
                            ]);
                            return h('div', { class: '' }, [overlay, popuper]);
                        }
                    }).mount(`#${popupName}`);

                    resolve(app);
                } catch (error) {
                    reject(error);
                }
            });
        }
    }

    // 打开弹窗
    win['$WinOpen'] = (e) => {
        win.parent.postMessage(e, '*');
    };

    // 打开弹窗(同步阻塞)
    win['$WinOpenSynchronization'] = (e) => {
        (async () => {
            const pdatas = e.filter(o => o != null);
            for (const pdata of pdatas) {
                await new Promise(async (resolve) => {
                    win.addEventListener('message', ({ type, data }) => {
                        const { event, datas } = data;
                        if (`close` === event && datas?.key === pdata.key) {
                            resolve();
                        }
                    });

                    await win.$WinOpen({
                        event: 'open',
                        datas: pdata
                    });
                })
            }
        })();
    };

    // 关闭弹窗
    win['$WinClose'] =  (e) => {
        if(win?.parent) {
            win.parent.postMessage(e, '*');
        }
    };

    // 默认关闭
    doc.addEventListener('click', function(event) {
        const winelement = event.target.closest('.xqbj-win-popup');
        const sunelement = event.target.querySelector('.xqbj-win-popup');
        if(sunelement && !winelement) {
            win.$WinClose({
                event: 'allclose'
            });
        } else if (event.target.matches('.closebtn')) {
            win.$WinClose({
                event: 'allclose'
            });
        }
    });

    // 监听事件
    if (win === win.top && typeof win.addEventListener === 'function') {
        win.addEventListener('message', ({ type, data }) => {
            const { event, datas} = data;
            const loader = new PopupLoader({
                ...{
                    url: null,
                    key: null,
                    single: null
                }, 
                ...datas}
            );

            // 打开框口
            if(`open` === event) {
                loader.popup(data);
                $('html').addClass('overflow-hidden');
            }

            // 打开框口
            else if(`openonly` === event) {
                loader.popup(data);
                $('div[id^="POPUP-WINDOW-"]').not(`#POPUP-WINDOW-${datas.key}`).remove();
                $('html').addClass('overflow-hidden');
            }

            // 关闭框口
            else if(`close` === event && datas?.key) {
                $(`#POPUP-WINDOW-${datas.key}`).remove();
                $('html').removeClass('overflow-hidden');
            }

            // 关闭框口(全部)
            else if(`allclose` === event) {
                $('div[id^="POPUP-WINDOW-"]').remove();
                $('html').removeClass('overflow-hidden');
            }

        });
        
    } else {
        console.log('当前浏览器不支持addEventListener监听事件');
    }

})(document, window);
