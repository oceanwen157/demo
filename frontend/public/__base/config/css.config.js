/**
 * desc: 全局样式
 * date: 2023.03.20
 */

(function (doc, win) {
	new Promise((resolve, reject) => {
		const { theme, navbar, navtar, desktop, dialog } = __APP_CONFIG__;
		const root = document.documentElement;
	
		// 主题配置
		// root.style.setProperty('--root-path', 						    win.base_url + '/@image/个人中心/a-4.png');

		// 主题配置
		// root.style.setProperty('--van-base-font', 						theme.baseFont);
		// root.style.setProperty('--default-font-size', 					theme.fontSize);
		// root.style.setProperty('--van-cell-font-size', 					'--default-font-size');
		// root.style.setProperty('--container-background-color', 			theme.backgroundColor);
		// root.style.setProperty('--container-background-main-color', 	theme.backgroundMainColor);
		// root.style.setProperty('--van-search-background', 				theme.backgroundColor);
		// root.style.setProperty('--default-box-shadow', 					theme.boxShadow);
	
		// 头部导航
		// root.style.setProperty('--van-nav-bar-height', 					navbar.vanNavBarHeight);
		// root.style.setProperty('--van-nav-bar-title-font-size', 			navbar.vanNavBarTitleFontSize);
		// root.style.setProperty('--van-nav-bar-title-text-color', 		navbar.vanNavBarTitleTextColor);
		// root.style.setProperty('--van-nav-bar-arrow-size', 				navbar.vanNavBarArrowSize);
		// root.style.setProperty('--van-nav-bar-icon-color', 				navbar.vanNavBarIconColor);
		// root.style.setProperty('--van-nav-bar-text-color', 				navbar.vanNavBarTextColor);
		// root.style.setProperty('--van-nav-bar-background', 				navbar.vanNavBarBackground);
		// root.style.setProperty('--van-nav-bar-arrow-size', 				navbar.vanFieldPlaceholderTextColor);
	
		// 底部菜单
		// root.style.setProperty('--van-border-color', 					navtar.vanBorderColor);
		// root.style.setProperty('--van-tabbar-item-font-size', 			navtar.vanTabbarItemFontSize);
		// root.style.setProperty('--van-tabbar-item-icon-size', 			navtar.vanTabbarItemIconSize);
		// root.style.setProperty('--van-tabbar-background', 				navtar.vanTabbarBackground);
		// root.style.setProperty('--van-tabbar-item-text-color', 			navtar.vanTabbarItemTextColor);
		// root.style.setProperty('--van-tabbar-item-active-color', 		navtar.vanTabbarItemActiveColor);
		// root.style.setProperty('--van-tabbar-item-active-background', 	navtar.vanTabbarItemActiveBackground);
	
		// Web配置
		// root.style.setProperty('--desktop-max-width', 							desktop.maxWidth);
		// root.style.setProperty('--desktop-header-height', 						desktop.headerHeight);
		// root.style.setProperty('--desktop-scrollbar-width', 					desktop.scrollbarWidth);
		// root.style.setProperty('--desktop-scrollbar-border-radius', 			desktop.scrollbarBorderRadius);
		// root.style.setProperty('--desktop-scrollbar-background-color', 			desktop.scrollbarBackgroundColor);
		// root.style.setProperty('--desktop-scrollbar-thumb-background-color', 	desktop.scrollbarThumbBackgroundColor);
	
		// 弹窗配置
		root.style.setProperty('--van-dialog-width', 							'34.3rem');
		root.style.setProperty('--van-dialog-radius', 							dialog.radius);
		root.style.setProperty('--van-text-color', 								dialog.textColor);
		root.style.setProperty('--van-font-size-md', 							dialog.fontSize);
		root.style.setProperty('--van-dialog-background', 						dialog.backgroundColor);
		root.style.setProperty('--van-action-bar-background', 					dialog.backgroundColor);
		root.style.setProperty('--van-action-bar-button-warning-color', 		dialog.leftButtonBackgroundColor);
		root.style.setProperty('--van-action-bar-button-danger-color', 			dialog.rightButtonBackgroundColor);
		root.style.setProperty('--van-dialog-has-title-message-text-color', 	'#ffffff');
		root.style.setProperty('--van-dialog-font-size', 					    '2.0rem');
		root.style.setProperty('--van-dialog-message-font-size', 				'1.6rem');
		root.style.setProperty('--van-font-size-md', 							'1.8rem');
		root.style.setProperty('--van-dialog-has-title-message-padding-top', 	'1.25rem');
		root.style.setProperty('--van-dialog-round-button-height', 				'4.0rem');
		root.style.setProperty('--van-dialog-header-font-weight', 				'400');
	
		// 表单配置
		root.style.setProperty('--van-field-error-message-color', 				'#885acd');

		resolve()
	})
	.catch(error => {
		console.error('Failed to load file', error)
	});
})(document, window);
