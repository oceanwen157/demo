/**
 * 全局菜单
 */
(function (doc, win) {
	class PaginationLoader {

		// 初始构建
		constructor() {
			this.builder();
			this.handleResize();
		}

		// 构建菜单
		builder() {
			return new Promise((resolve, reject) => {
				const ele = `van-pagination`;
				try {
					const { createApp, ref, h, resolveComponent } = Vue;
					const mobileCount = 4;
					const pcCount = 10;
					const count = (win.innerWidth <= 960) ? mobileCount : pcCount;
					const paginationItemPages = $(`#${ele}`).find('.van-pagination__item--page');
					const paginationItemActive = $(`#${ele}`).find('.van-pagination__item--page.van-pagination__item--active').first();
					const currentIndex = paginationItemPages.index(paginationItemActive)
					const _this = this;

					// 如不存在
					if ($("body").find(`#${ele}`).length === 0) {
						return false;
					}

					// 过滤处理
					if (count === pcCount) {
						(paginationItemPages.length >= count) && paginationItemPages.each(function (index, element) {
							switch (index) {
								case (currentIndex - 5): break;
								case (currentIndex - 4): break;
								case (currentIndex - 3): break;
								case (currentIndex - 2): break;
								case (currentIndex - 1): break;
								case (currentIndex - 0): break;
								case (currentIndex + 1): break;
								case (currentIndex + 2): break;
								case (currentIndex + 3): break;
								case (currentIndex + 4): break;
								case (currentIndex + 5): break;
								case (currentIndex + 6): break;
								case (currentIndex + 7): break;
								case (currentIndex + 8): break;
								case (currentIndex + 9): break;
								case (currentIndex + 10): break;
								case (currentIndex + 11): break;
								case (currentIndex + 12): break;
								case (currentIndex + 13): break;
								case (currentIndex + 14): break;
								case (currentIndex + 15): break;
								case (currentIndex + 16): break;
								case (currentIndex + 16): break;
								case (currentIndex + 16): break;
								case (currentIndex + 17): break;
								case (currentIndex + 18): break;
								case (currentIndex + 19): break;
								case (currentIndex + 20): break;
								case (currentIndex + 21): break;
								case (currentIndex + 22): break;
								case (currentIndex + 23): break;
								case (currentIndex + 24): break;
								case (currentIndex + 25): break;
								case (currentIndex + 26): break;
								case (currentIndex + 27): break;
								case (paginationItemPages.length - 3): $(element).html($("<a href='javascript:void(0);'>...</a>")); break;
								case (paginationItemPages.length - 2): break;
								case (paginationItemPages.length - 1): break;
								default:
									element.remove();
									break;
							}
						});
					} else {
						(paginationItemPages.length >= count) && paginationItemPages.each(function (index, element) {
							switch (index) {
								case (currentIndex - 4): break;
								case (currentIndex - 3): break;
								case (currentIndex - 2): break;
								case (currentIndex - 1): break;
								case (currentIndex - 0): break;
								case (currentIndex + 1): break;
								case (currentIndex + 2): break;
								case (currentIndex + 3): break;
								case (currentIndex + 4): break;
								case (currentIndex + 5): break;
								case (currentIndex + 6): break;
								case (currentIndex + 7): break;
								case (currentIndex + 8): break;
								case (currentIndex + 9): break;
								case (paginationItemPages.length - 3): $(element).html($("<a href='javascript:void(0);'>...</a>")); break;
								case (paginationItemPages.length - 2): break;
								case (paginationItemPages.length - 1): break;
								default:
									element.remove();
									break;
							}
						});
					}

					// console.log("@paginationItemPage", paginationItemPage);
					// console.log("@paginationItemActive", paginationItemActive);
				} catch (error) {
					reject(error);
				} finally {
					$(`#${ele}`).css("display", "flex");
				}
			});
		}

		// 监听窗口大小变化，重新调用 builder()
		handleResize() {
			win.addEventListener('resize', () => {
				// this.builder(); // 重新构建分页
			});
		}
	}

	// 初始化
	// new PaginationLoader();

})(document, window);
