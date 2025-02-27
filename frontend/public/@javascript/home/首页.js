/* 首页 */
(function (doc, win) {
    // 初始化
    Launcher({
        vue: {
            // 变量定义
            data() {
                return {
                    searchkey: '',
                    listdata: [],
                    rankList: [],
                    finished: false,
                    loading: false,
                    pagination: {
                        limit: 20,
                        count: 50,
                        total: 0,
                        page: 0
                    }
                };
            },

            // 组件引用
            components: ['Swipe', 'SwipeItem', 'List', 'Search'],

            // 函数定义
            methods: {

                onVideoDetail(e) {

                },

                onLoadList(reload = false) {
                    const _this = this;

                    // 加载进行
                    _this.loading = true;

                    // 重新加载
                    if (reload) {
                        _this.finished = false;
                    } else {
                        _this.pagination.page++;
                    }

                    console.log(`加载更多数据->${_this.pagination.page}`);

                    axios.get(`/home/listdata`).then(({ data }) => {
                        let list = data;
                        if (list.length) {
                            _this.listdata = [..._this.listdata, ...list];
                            _this.loading = true;
                        } else {
                            _this.finished = true;
                        }
                    })
                    .catch(error => {
                        console.error('处理错误:', error);
                    })
                    .finally(() => {
                        // 加载停止
                        setTimeout(() => {
                            _this.loading = false;
                        }, 2000);
                    });
                },

                onLoadRankList() {
                    const _this = this;
                    axios.get(`/home/listdata`).then(({ data }) => {
                        _this.rankList = data;
                    })
                        .catch(error => {
                            console.error('处理错误:', error);
                        })
                        .finally(() => {
                        });
                },

                // 联系
                onConnect() {

                },

                // 分享
                onShare() {
                    let _url = window.location.href;
                    win.$Copy(_url);
                    $Alert("复制成功");
                },

                // 返回顶部
                onScrollToTop() {
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth",
                    });
                },
            },

            // 启动入口
            mounted() {
                const _this = this;
                _this.onLoadRankList();

                // 接口请求
                // $Http({
                //     method: 'POST',
                //     url: '/api/tuser/authors',
                //     data: {
                //     }
                // });
            },
        }
    }).then(() => {

        // 轮播
        new Swiper(".banner-swiper", {
            pagination: {
                el: ".swiper-pagination",
                type: 'bullets',
            },
        });

        // 
        $(".tabs_nav_scrolling").gScrollingCarousel({
            scrollAmount: 'viewport',
            mouseScrolling: true,
            draggable: true,
            snapOnDrag: true,
            mobileNative: true,
        });

        // 热榜
        $(doc).on('click', 'div.rank-content .van-tabs__wrap .van-tab', function (e) {
            // 对象
            const tag = $(e.target).closest(".van-tab")[0];
            const { index } = tag.dataset;
            const panel = $("div.rank-content .van-tabs__content .van-tab__panel").get(index);

            // 切换
            if (panel) {
                $(tag).addClass("van-tab--active").siblings().removeClass("van-tab--active");
                $(panel).removeClass("hidden").siblings().addClass("hidden");
            }
        });

        // UP主查看更多
        //   $(doc).on('click', '#rank_up_viewMore', function() {
        //     $(this).addClass('hidden');
        //     $("#rank_up").removeClass('hidden');
        //   });

        win.$WinOpenSynchronization([
            // win.$WinRefresh() ? { key: '18J', url: `/十八`,  loading: false } : null,
            // win.$WinRefresh() ? { key: 'GG',  url: `/公告`,  loading: false } : null,
            // win.$WinRefresh() ? { key: 'JP',  url: `/精品`,  loading: false } : null,
            // { key: 'JP', url: `/精品`,  loading: false },
            // { key: 'TZ', url: `/通知`,  loading: false },
        ]);

        // win.$WinOpen({
        //     event: 'open',
        //     datas: { key: 'LOGIN',    url: `/登陆`,  loading: true }
        // });




    });

})(document, window);





