/**
 * 头部导航
 */
(function (doc, win, $) {

	class NavbarBulidr {
		constructor(container) {
			const _this = this;
			_this.container = container;
			_this.completecontainer = $(".autocomplete-group-container");

			// 搜索弹窗
			_this.onSearch = (ele) => {

				// 搜索模板
				const templates = (tempname, list) => {
					if(list.length > 0) {
						list.forEach((e, index) => tempname.append(
							$("<li>").addClass("autocomplete-result btn").attr("data-suggestion", "indian").append(
								$("<span>").addClass("suggestion-value text-md").append(
									$("<a>").attr({
										"style": "vertical-align: inherit;",
										"href": `/#${index}`
									}).text(e.text)
								)
							)
						));
						tempname.removeClass("hidden");
					} else {
						tempname.addClass("hidden");
					}
				}

				// 联想搜索
				const search = (key) => $Debounce((key) => {
					let l = $(doc).find(".no-results");

					// 搜索内容(模拟)
					axios.get(`/home/listdata`).then(({ data }) => {
						let list = data;
		
						// 清空列表
						$(_this.completecontainer).find("li").remove();
		
						// 列表过滤
						if ((key == 1 || key == '' ) && key && list.length) {
							
						} else {
							list = [];
						}

						// 列表渲染
						templates($(".hot-search-ul-list"),  list);
						templates($(".type-search-ul-list"), list);
						templates($(".star-search-ul-list"), list);

					}).catch(error => {
						console.error('处理错误:', error);
					});
				}, 300)(key);

				// 弹窗(显示)
				$(doc).on('focus', ele, (e) => {
					// let n = $(e.currentTarget);
					// let t = $(n).find(".autocomplete")?.[0];
					// $(t).addClass("show");
					// $(".search_query_mobile_container").addClass("search_query_mobile_flex");
				});

				// 弹窗(隐藏)
				$(doc).on('blur', ele, (e) => {
					let n = $(e.currentTarget);
					let t = $(n).find(".autocomplete")?.[0];
					
					setTimeout(() => {
						$(t).removeClass("show")
						$("input[type=search]").val("");
						$(".search_query_mobile_container").removeClass("search_query_mobile_flex");
						$("body").removeClass("fullscreen-wrapper");
					}, 300);
				});

				// 弹窗(搜索、显示)
				$(doc).on('keyup', 'input.search_query[type=search]', (e) => {
					let n = $(e.currentTarget);
					let t = $(n).find(".autocomplete")?.[0];
					let key = $(n).val().trim();

					// 开启搜索
					$("body").addClass("fullscreen-wrapper");
					$(".autocomplete").addClass("show");
					$(".search_query_mobile_container").addClass("search_query_mobile_flex");
					
					// 手动搜索
					$(".search-key").attr("href", `/#${key}`).html(key);

					// 搜索处理
					search(key);
				});
			}

			// 重置跳转
			$(doc).on('click', 'a[replace]', function (e) {
				e.preventDefault();
				e.stopPropagation();
				const url = $(this).attr("href");
				location.replace(url);
			});

			// 设置菜单
			$(doc).on("click",".settings-hook .button-text", function(){
				$(this).addClass("show")
				$(this).siblings().removeClass("show");
				let wrapWidth = $('.settings-hook .dropdown-menu').outerWidth()
				let btnWidthw = $(this).outerWidth()
				let w = wrapWidth - btnWidthw
				let h = $(this).outerHeight()
				let index = $(this).index()
				let offset = index == 0 ? 0 : btnWidthw
				setTimeout(() => {
					$(this).next().addClass("show").css({top: h + "px", left:-w + offset + "px"})
				})
			})

			// 搜索提交
			$(doc).on("click",".search-btn", function(){
				let key = $("#search_query_query").val()
				console.log('key: ', key);

				// TODO................................................................
				location.replace(`/home/主题#${key}`);

				return false;
			})
			
			// 构建导航(Mobile)
			this.mobileBulidr();

			// 构建导航(Desktop)
			this.desktopBulidr();
		}

		// 构建导航(Mobile)
		mobileBulidr() {
			let _this = this;

			// 用户搜索
			_this.onSearch('form[name="search_query_mobile_trigger"]')
		}

		// 构建导航(Desktop)
		desktopBulidr() {
			let _this = this;

			// 用户搜索
			_this.onSearch('form[name="search_query"]')
		}

	}

	new NavbarBulidr("#xqbj-container .xqbj-header");

})(document, window, jQuery);
