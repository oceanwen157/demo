/**
 * 全局图片点击放大功能
 */
(function (doc, win) {
  class ImageZoomLoader {
    // 初始化构造函数
    constructor({ images, startIndex }) {
      this.images = images; // 图片数组
      this.currentIndex = startIndex; // 当前图片索引
    }

    zoom() {
      const _this = this;

      return new Promise((resolve, reject) => {
        try {
          const zoomName = `ZOOM-IMAGE-CONTAINER`;

          // 如果放大图片容器已存在，则不重复创建
          if (doc.querySelector(`#${zoomName}`)) return;

          // 创建根元素并添加到 body
          const zoomContainer = doc.createElement('div');
          zoomContainer.id = zoomName;
          zoomContainer.style.display = 'none';
          zoomContainer.classList.add('zoom-overlay');
          zoomContainer.onclick = () => this.onCloseZoom(zoomContainer);

          // 创建关闭按钮
          const closeButton = doc.createElement('div');
          closeButton.className = 'zoom-close-button';
          closeButton.innerHTML = '&times;';
          closeButton.onclick = () => this.onCloseZoom(zoomContainer);

          const swiperContainer = doc.createElement('div');
          swiperContainer.className = 'swiper-container';

          const swiperWrapper = doc.createElement('div');
          swiperWrapper.className = 'swiper-wrapper';

          // 创建每张图片的 swiper-slide
          this.images.forEach((image, index) => {
            const slide = doc.createElement('div');
            slide.className = 'swiper-slide';

            const imgElement = doc.createElement('img');
            imgElement.className = 'zoomed-img';
            imgElement.src = image;

            slide.appendChild(imgElement);
            swiperWrapper.appendChild(slide);

            // 阻止点击遮罩层时关闭
            imgElement.onclick = (e) => {
              e.stopPropagation();  // 阻止事件冒泡，防止触发关闭
            };
          });

          // 创建图片切换的控制器
          const swiperPagination = doc.createElement('div');
          swiperPagination.className = 'swiper-pagination';

          // 将 swiperWrapper 和 pagination 添加到 swiperContainer
          swiperContainer.appendChild(swiperWrapper);
          swiperContainer.appendChild(swiperPagination);

          // 将所有元素添加到 zoomContainer
          zoomContainer.appendChild(swiperContainer);
          zoomContainer.appendChild(closeButton);
          doc.body.appendChild(zoomContainer);

          // 初始化 Swiper
          new Swiper(swiperContainer, {
            initialSlide: this.currentIndex, // 从当前图片索引开始
            loop: true, // 循环切换
            // watchOverflow: true,
            pagination: {
              el: swiperPagination,
              type: "fraction",
            },
            navigation: {
              nextEl: '.zoom-next-button',
              prevEl: '.zoom-prev-button',
            }
          });

          zoomContainer.style.display = 'flex'; // 显示放大图片容器
          resolve();

        } catch (error) {
          reject(error);
        }
      });
    }

    onCloseZoom(zoomContainer) {
      zoomContainer.remove();
    }
  }

  win['$ZoomOpen'] = (e, startIndex = 0) => {
    const loader = new ImageZoomLoader({ images: e, startIndex });
    loader.zoom();
  };

})(document, window);
