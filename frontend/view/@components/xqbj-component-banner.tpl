<!-- 通用组件/banner -->
<div class="banner">
    <div class="swiper banner-swiper" data-swiper-autoplay="2000">
        <div class="swiper-wrapper">
            {foreach name="__LISTS__" item="e" key="i" }
                <div class="swiper-slide">
                    <img x-image-loader-url="`https://pic.uxyimg.cn/upload_01/xiao/20250201/2025020116425429274.gif`" />
                </div>
            {/foreach}
        </div>
        <div class="swiper-pagination"></div>
    </div>  
</div>