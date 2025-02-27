<!-- 通用组件/列表(订阅) -->

<!-- 订阅(为空) start -->
<div v-if="!isLogin">
    {include file="@components/xqbj-component-subs-guest" /}
</div>
<!-- 订阅(为空) end -->

<!-- 订阅(游客) start -->
<div v-else-if="listcollectdata?.length === 0">
    {include file="@components/xqbj-component-subs-empty" /}
</div>
<!-- 订阅(游客) end -->

<!-- 滚动区域 start -->
<div class="xqbj-list" v-else>
    <van-list v-model:loading="collectloading" :finished="collectfinished" :immediate-check="false" finished-text="加载完成" loading-text="加载中..." error-text="加载失败" @load="onLoadCollectList">
        <div class="meritvideo-list" v-drag-scroll="`container`">
            <div v-for="(item, index) in listcollectdata" :key="'item'+ index" :index="`${index}`">
                <div class="xqbj-list-rows" v-if="item.type === 'placard'">
                    <div class="xqbj-list-rows-placard">
                        <a href="/welfare/福利详情" :title="item.text">
                            <div href="/welfare/福利详情" :title="item.text"
                                class="xqbj-list-rows-placard-title text-line-ellipsis-1">placard#<span v-html="item.subtitle"></span>
                            </div>
                            <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-placard-group">
                                <div class="xqbj-list-rows-placard-group-item" v-for="(child , j) in item.images" :key="'img'+j">
                                    <img data-image-preview="true" :z-image-loader-url="child.url" />
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="xqbj-list-rows" v-if="item.type === 'image'">
                    <div class="xqbj-list-rows-image">
                        <div class="list-text-play is-desktop1" v-if="item?.images?.length > 3">{{ item.play }}+</div>
                        <a href="/welfare/福利详情" :title="item.text">
                            <div href="/welfare/福利详情" :title="item.text"
                                class="xqbj-list-rows-image-title text-line-ellipsis-1">image#<span v-html="item.subtitle"></span></div>
                            <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-image-group">
                                <div class="xqbj-list-rows-image-group-item" v-for="(child , j) in item.images.slice(0, 3)"
                                    :key="'img1'+j">
                                    <img data-image-preview="true" :z-image-loader-url="child.url" />
                                </div>
                            </div>
                        </a>
                        <div class="xqbj-list-rows-bottom">
                            <div class="xqbj-list-rows-bottom-tags">
                                <a href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-left">
                                    <div class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-user icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.username}}</div>
                                    </div>
                                    <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-view icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.view}}浏览</div>
                                    </div>
                                    <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-comm icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.play}}评论</div>
                                    </div>
                                    <div class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-time icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text is-desktop">{{item.date}}</div>
                                        <div class="xqbj-list-rows-bottom-tags-text is-mobile">{{item.subdate}}</div>
                                    </div>
                                </a>
                                <a href="/home/主题"
                                    class="xqbj-list-rows-bottom-tags-tag xqbj-list-rows-bottom-tags-btn">
                                    {{item.tag1}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="xqbj-list-rows" v-if="item.type === 'text'">
                    <div class="xqbj-list-rows-texts">
                        <a href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-texts-context">
                            <div href="/welfare/福利详情" class="xqbj-list-rows-texts-title text-line-ellipsis-1">
                                text#{{item.text}}
                            </div>
                            <div href="/welfare/福利详情" class="xqbj-list-rows-texts-detail text-line-ellipsis-2" >
                                {{item.subtitle}}
                            </div>
                        </a>
                        <div class="xqbj-list-rows-bottom">
                            <div class="xqbj-list-rows-bottom-tags">
                                <a href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-left">
                                    <div class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-user icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.username}}</div>
                                    </div>
                                    <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-view icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.view}}浏览</div>
                                    </div>
                                    <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-comm icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.play}}评论</div>
                                    </div>
                                    <div class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-time icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text is-desktop">{{item.date}}</div>
                                        <div class="xqbj-list-rows-bottom-tags-text is-mobile">{{item.subdate}}</div>
                                    </div>
                                </a>
                                <a href="/" class="xqbj-list-rows-bottom-tags-tag xqbj-list-rows-bottom-tags-btn">
                                    {{item.tag1}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="xqbj-list-rows" v-if="item.type === 'video'">
                    <div class="xqbj-list-rows-image">
                        <div class="list-text-play is-desktop1" v-if="item?.images?.length > 3">{{ item.play }}+</div>
                        <a href="/welfare/福利详情" :title="item.text">
                            <div href="/welfare/福利详情" :title="item.text"
                                class="xqbj-list-rows-image-title text-line-ellipsis-1">video#<span v-html="item.subtitle"></span> </div>
                            <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-image-group">
                                <div class="xqbj-list-rows-image-group-item" 
                                    v-for="(child , j) in item.images.slice(0, 3)" :key="'img2'+j" :class="j === 0 ?'is-video':''">
                                    <img data-image-preview="true" :z-image-loader-url="child.url" />
                                </div>
                            </div>
                        </a>
                        <div class="xqbj-list-rows-bottom">
                            <div class="xqbj-list-rows-bottom-tags">
                                <a href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-left">
                                    <div class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-user icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.username}}</div>
                                    </div>
                                    <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-view icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.view}}浏览</div>
                                    </div>
                                    <div href="/welfare/福利详情" :title="item.text" class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-comm icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text">{{item.play}}评论</div>
                                    </div>
                                    <div class="xqbj-list-rows-bottom-tags-tag">
                                        <div class="xqbj-icon-time icon-small"></div>
                                        <div class="xqbj-list-rows-bottom-tags-text is-desktop">{{item.date}}</div>
                                        <div class="xqbj-list-rows-bottom-tags-text is-mobile">{{item.subdate}}</div>
                                    </div>
                                </a>
                                <a href="/home/主题"
                                    class="xqbj-list-rows-bottom-tags-tag xqbj-list-rows-bottom-tags-btn">
                                    {{item.tag1}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <van-list>
</div>
<!-- 滚动区域 end -->