<!-- 通用组件/列表 -->

<div class="cards-container">
    {foreach name="$pagination" item="e" key="i" }
        <div class="rating-card card sub group rating-active {if $i == 2} paid {/if}" data-id="{$e.id}">
            <a class="item-link rate-link relative" href="{$e.play_url}" target="_blank" title="{$e.title_en}" tabindex="-1" rel="nofollow">
                <img class="item-image" z-image-loader-url="{$e.cover_new}" loading="eager" alt="{$e.title_en}" />

                {if $i == 2}
                    <span class="item-premium-container">
                        <span class="item-premium-icon"><i class="far fa-dollar-sign"></i></span>
                        <span class="item-premium-label">charge</span>
                    </span>
                {/if}

                <span class="item-meta-container">
                    <span class="badge rating-badge float-left">
                        <span class="item-score score-positive flex gap-1 items-center id="vote-score-{$e.id}">
                            <i class="far fa-thumbs-up text-xsm"></i>
                            <span class="vote-score">{$e.vote_num + 50}%</span>
                        </span>
                    </span>
                    <span class="badge float-right">
                        {$e.duration_desc} 
                    </span>
                    <!--
                    <span class="badge float-right">
                        <span class="font-bold italic">高清</span>
                    </span>
                    -->
                </span>
            </a>

            <!-- 评分处理 start -->
            <div class="item-rating-container item-rating-disabled" role="group" aria-label="rating buttons">
                <button type="button" aria-label="Upvote" class="item-rating-option item-rating-positive">
                    <i class="far fa-thumbs-up"></i>
                </button>
                <button type="button" aria-label="Downvote" class="item-rating-option item-rating-negative">
                    <i class="far fa-thumbs-down"></i>
                </button>
                <button type="button" aria-label="No vote" class="item-rating-option item-rating-none">
                    <i class="far fa-xmark"></i>
                </button>
            </div>
            <!-- 评分处理 end -->

            <div class="item-footer">
                <div class="relative w-full mt-1">
                    <button type="button" class="button button-text context-button relative float-right clear-none right-0 top-0" title="Context menu" aria-label="Context menu button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" data-dropdown-placement="bottom-end">
                        <i class="icon-start far fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="menu-item anchor-link gap-3" href="https://report.adultwebmasternet.com/?public-id=WEr0ZRZ0Dww&amp;site-id=60&amp;item-collection-slug=chinese" title="Report this video" rel="nofollow" target="_blank">
                            <i class="icon-start far fa-flag"></i>举报该视频
                        </a>
                    </div>
                    <a class="item-title item-link rate-link font-medium" dir="ltr" data-error-title="No video available" href="/out/?l=3AASPM4WivQpq1dFcjBaUlowRHd3AtljaHR0cHM6Ly93d3cueHZpZGVvcy5yZWQvdmlkZW8udWRoZWFidjY4NzUvY2hpbmVzZV9sYWR5X2Z1Y2tfYmJjXy1fM2RfYW5pbWF0aW9uXzMxOT9zeGNhZj1ZRDlFMVJaNDlNzQMGonRjAc0HgKdwb3B1bGFyBdlgeyJhbGwiOiIiLCJvcmllbnRhdGlvbiI6InN0cmFpZ2h0IiwicHJpY2luZyI6Im1lbWJlcnNoaXAscGF5cGVydmlldyxwYXlwZXJjbGlwLGZhbnN1YnNjcmlwdGlvbiJ9zPzOZ7Ar8KhjYXRlZ29yec0lz8DZfFt7IjEiOiJIcWxLbHdsS3Y5aCJ9LHsiMiI6ImhrSmd4bGg5ZGpRIn0seyIzIjoiUVB2TW05aUNWOXkifSx7Ii0xIjoidFZoOGV4NjNjaW0ifSx7Ii0yIjoiS3JxajNnVEJkdmYifSx7Ii0zIjoiSVVwb0psTWhnS1UifV0%3D&amp;c=6ce60806&amp;v=3&amp;" target="_blank" title="Chinese lady fuck BBC - 3D Animation 319" rel="nofollow">
                        {$e.title_en}
                    </a>
                    <div class="item-source-rating-container mt-1 pr-0 h-auto flex justify-between">
                        <a class="item-source block text-xsm" href="/source/xvideosred?pricing=membership-and-payperview-and-payperclip-and-fansubscription">
                            <i class="far fa-badge-check text-xsm fa-fw"></i>{$e.source}
                        </a>
                        <span class="item-source block text-xsm">9 months ago</span>
                    </div>
                </div>
            </div>
        </div>
    {/foreach}
</div>