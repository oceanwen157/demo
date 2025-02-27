<!-- 公共部分/左侧导航 -->
<div id="popup-menu" class="hide">
    <div class="is-mobile">
        <div class="van-overlay" @click="onMenuClose"></div>
        <div role="dialog" id="van-popup-menu" tabindex="0" class="van-popup van-popup--left">
            <div class="header"></div>
            <div class="content">

                {volist name="__NAVBARS__" id="e" key="i"}
                    <div class="item">
                        <div class="head">
                            <div class="left">
                                <div class="title">{$e.title}</div>
                                <div class="subtitle">{$e.subtitle}</div>
                            </div>
                            <div class="right">
                                {if condition="!empty($e.tags)"}
                                    <img src="__ROOT_PATH__/__base/images/down@3x.png" onclick="onMenuOpen(this)" direction="down" class="downbtn" data-bs-toggle="collapse" data-bs-target="#collapseTag{$i}" aria-expanded="true">
                                {/if}
                            </div>
                        </div>
                        <div class="collapse show content-collapse" id="collapseTag{$i}">
                            <div class="tags">
                                {volist name="e.tags" id="o" key="j"}
                                    <div><a href="#" class="" onclick="onTagSelected(this, {$i}, {$j})" >{$o.text}</a></div>
                                {/volist}
                            </div>
                        </div>
                    </div>
                {/volist}

            </div>
            <div class="footer">
                <div class="user-mian" v-if="hasLogin">
                    <div class="relogin-group-btns">
                        <div class="left">
                            <div class="img"><img src="__ROOT_PATH__/__base/images/avatar@3x.png"></div>
                        </div>
                        <div class="right" @click="onUserCenter">
                            <div class="top">qb-147</div>
                            <div class="center">进入个人中心</div>
                        </div>
                    </div>
                </div>
                <div class="user-mian" v-else>
                    <div class="nologin-group-btns">
                        <div class="left" @click="onLogin">
                            <div class="img"><img src="__ROOT_PATH__/__base/images/r1@3x.png"></div>
                            <div>登录</div>
                        </div>
                        <div class="right" @click="onRegister">
                            <div class="img"><img src="__ROOT_PATH__/__base/images/r2@3x.png"></div>
                            <div>注册</div>
                        </div>
                    </div>
                </div>
                <div class="free-vip-btn" @click="onSign">免费领会员获得更多尊享权益</div>
            </div>
        </div>
    </div>
</div>