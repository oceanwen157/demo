/**
 * 全局菜单
 */
(function (doc, win) {
    class MenuLoader {

        // 初始构建
        constructor() {
            this.popupName = `popup-menu`;
            this.builder();
        }

        // 构建菜单
        builder() {
            const _this = this;
            return new Promise((resolve, reject) => {
                try {
                    const { createApp, ref, h, resolveComponent } = Vue;


                    // 如不存在
                    if ($("body").find(`#${_this.popupName}`).length === 0) {
                        return false;
                    }

                    // 建根元素
                    $(`#${_this.popupName}`).show();

                    // 构建弹窗
                    const app = createApp({
                        // 变量定义
                        data() {
                            return {
                                // 是否登录
                                hasLogin: false,
                            };
                        },
                        methods: {
                            onMenuClose() {
                                $(`#${_this.popupName}`).removeClass('show').addClass('hide');
                                $("body").removeClass("navbar fixbody");
                            },

                            // onTagSelected(el, k, j) {
                            //     $(`#navbar .tag-text a.selected`).removeClass('selected').end().find(el).addClass('selected');
                            // },

                            onLogin() {
                                this.onMenuClose();
                                win.$WinOpen({
                                    event: 'open',
                                    datas: { key: 'LOGIN',    url: `/登陆` }
                                });
                            },

                            onRegister() {
                                this.onMenuClose();
                                win.$WinOpen({
                                    event: 'open',
                                    datas: { key: 'REGISTER',    url: `/注册` }
                                });
                            },

                            onSign() {
                                top.location.href = `${win.base_url}/@pages/签到.html`;
                            },

                            onUserCenter() {
                                top.location.href = `${win.base_url}/@pages/个人中心/会员中心.html`;
                            }
                        },

                        mounted() {

                        }

                    }).mount(`#${_this.popupName}`)

                    resolve(app);
                } catch (error) {
                    reject(error);
                }
            });
        }

        // 打开菜单
        open() {
            $(`#${this.popupName}`).removeClass('hide').addClass('show');
        }
    }

    // 初始化
    const menuLoader = new MenuLoader();
    win.onPupopMenu = () => menuLoader.open();

})(document, window);
