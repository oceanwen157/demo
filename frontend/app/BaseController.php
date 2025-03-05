<?php

declare(strict_types=1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;
use think\facade\View;
use app\Services\DataService;

/**
 * 控制器基础类
 */
abstract class BaseController
{
  /**
   * Request实例
   * @var \think\Request
   */
  protected $request;

  /**
   * 应用实例
   * @var \think\App
   */
  protected $app;

  /**
   * 是否批量验证
   * @var bool
   */
  protected $batchValidate = false;

  protected $lang = 'en';

  /**
   * 控制器中间件
   * @var array
   */
  protected $middleware = [];

  // 全部导航项
  protected $navbars = [
    [
      'title' => "全部分类",
      'subtitle' => "1001部作品",
      'url' => "/",
      'tags' => [
        [
          'text' => "海角首页",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角热门",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "今日更新",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "我的订阅",
          'subtitle' => "1002部作品",
          'url' => "/home/订阅",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "伦理",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "看片",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "看片",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "看片1",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "看片2",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ],
        [
          'text' => "今日今日今日今日今日今日今日今日今日",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ]
      ]
    ],
    [
      'title' => "黑料吃瓜",
      'subtitle' => "1002部作品",
      'url' => "/",
      'tags' => [
        [
          'text' => "海角社区黑料吃瓜黑料吃瓜黑料吃瓜黑料吃瓜",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角社区",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角社区",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "黑料吃瓜",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ]
      ],
      'activa' => true
    ],
    [
      'title' => "精选视频",
      'subtitle' => "1003部作品",
      'url' => "/featured/精选视频",
      'tags' => [
        [
          'text' => "海角社区黑料吃瓜黑料吃瓜黑料吃瓜黑料吃瓜",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角社区",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角社区",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "黑料吃瓜",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ]
      ]
    ],
    [
      'title' => "福利下载",
      'subtitle' => "1004部作品",
      'url' => "/welfare/福利中心",
      'tags' => [
        [
          'text' => "海角社区黑料吃瓜黑料吃瓜黑料吃瓜黑料吃瓜",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角社区",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "海角社区",
          'subtitle' => "1001部作品",
          'url' => "/",
          'tags' => []
        ],
        [
          'text' => "黑料吃瓜",
          'subtitle' => "1002部作品",
          'url' => "/",
          'tags' => [],
          'activa' => true
        ]
      ]
    ]
  ];

  // 账户菜单
  protected $menufuns = [
    [
      'title' => "个人信息",
      'subtitle' => "修改个人信息",
      'icon1' => "user3",
      'url' => "",
      'tags' => [],
      'icon' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'index' => 't3',
      'onclick' => 'javascript:void(0)'
    ],
    [
      'title' => "我的订阅",
      'subtitle' => "管理订阅",
      'icon1' => "user4",
      'url' => "",
      'tags' => [],
      'activa' => true,
      'icon' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'index' => 't2',
      'onclick' => 'onLoadSubscriptionList(true)'
    ],
    [
      'title' => "我的收藏",
      'subtitle' => "收藏夹",
      'icon1' => "user5",
      'url' => "在线客服",
      'tags' => [],
      'icon' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'index' => 't0',
      'onclick' => 'onLoadCollectList(true)'
    ],
    [
      'title' => "我的足迹",
      'subtitle' => "浏览记录",
      'icon1' => "user6",
      'url' => "#",
      'tags' => [],
      'icon' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'index' => 't1',
      'onclick' => 'onLoadHistoryList(true)'
    ],
    [
      'title' => "常见问题",
      'subtitle' => "FAQ",
      'icon1' => "user7",
      'url' => "#",
      'tags' => [],
      'icon' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'index' => 't4',
      'onclick' => 'javascript:void(0)'
    ],
    [
      'title' => "问题反馈",
      'subtitle' => "我想说...",
      'icon1' => "user8",
      'url' => "",
      'tags' => [],
      'icon' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'index' => 't5',
      'onclick' => 'javascript:void(0)'
    ]
  ];

  // 全部菜单项
  protected $tabbers = [
    [
      'text'        => '海角社区',
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab1@3x.png',
      'iconActive'  => '/__base/images/tabber/tab1@3xhover.png',
      'color'       => '#ebeaea',
      'colorActive' => '#4970f5',
    ],
    [
      'text'        => '黑料吃瓜',
      'url'         => '/blackgua/黑料吃瓜',
      'icon'        => '/__base/images/tabber/tab2@3x.png',
      'iconActive'  => '/__base/images/tabber/tab2@3xhover.png',
      'color'       => '#ebeaea',
      'colorActive' => '#4970f5',
    ],
    [
      'text'        => '精选视频',
      'url'         => '/featured/精选视频',
      'icon'        => '/__base/images/tabber/tab3@3x.png',
      'iconActive'  => '/__base/images/tabber/tab3@3xhover.png',
      'color'       => '#ebeaea',
      'colorActive' => '#4970f5',
    ],
    [
      'text'        => '福利中心',
      'url'         => '/welfare/福利中心',
      'icon'        => '/__base/images/tabber/tab4@3x.png',
      'iconActive'  => '/__base/images/tabber/tab4@3xhover.png',
      'color'       => '#ebeaea',
      'colorActive' => '#4970f5',
    ],
    [
      'text'        => '天涯神帖',
      'url'         => '/tianya/天涯神帖',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#ebeaea',
      'colorActive' => '#4970f5',
    ],
    [
      'text'        => '文学小说',
      'url'         => '/novel/文学小说',
      'icon'        => '/__base/images/tabber/tab6@3x.png',
      'iconActive'  => '/__base/images/tabber/tab6@3xhover.png',
      'color'       => '#ebeaea',
      'colorActive' => '#4970f5',
    ],
  ];

  // 通用列表
  protected $listdata = [
    [
      'text'        => '热点',
      'username'    => '唐心鹌鹑蛋',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角视频海角视频啊啊',
      'tag2'        => '草榴社区1',
      'tag3'        => '#',
      'subtitle'    => 'placard是面向全球华人的免费在线色情视频<span class="highword">播放平台</span>我们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣',
      'type'        => 'placard',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab1@3x.png',
      'iconActive'  => '/__base/images/tabber/tab1@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies1',
          'date'        => '05-31 09:26',
		  'view'        => '12',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies2',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies3',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies4',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies5',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies6',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies7',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '23',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '322',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '11',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.dtmukxn.cn/upload_01/ads/20240815/2024081518074497225.gif',]
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '热点',
      'username'    => '海D角视频海角视啊频啊',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角D视频海角视啊频啊',
      'tag2'        => '草榴社区1',
      'tag3'        => 'A',
      'subtitle'    => '1是面向全球华人的免费在线色情视频<span class="highword">播放平台</span>我们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣我们希望能为您的生活增添性趣',
      'type'        => 'video',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab1@3x.png',
      'iconActive'  => '/__base/images/tabber/tab1@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '33',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '44',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '黑料吃瓜nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn',
      'username'    => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴2',
      'tag3'        => 'B',
      'subtitle'    => 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz',
      'type'        => 'image',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab2@3x.png',
      'iconActive'  => '/__base/images/tabber/tab2@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
          'username'    => 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '精选视频xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区3',
      'tag3'        => 'C',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
      'type'        => 'text',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab3@3x.png',
      'iconActive'  => '/__base/images/tabber/tab3@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '福利中心',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '原创4',
      'tag3'        => 'D',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'image',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab4@3x.png',
      'iconActive'  => '/__base/images/tabber/tab4@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',]
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '天涯神帖',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区5',
      'tag3'        => 'E',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣2',
      'type'        => 'video',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '文学小说',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区6',
      'tag3'        => 'F',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'image',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab6@3x.png',
      'iconActive'  => '/__base/images/tabber/tab6@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '文学小说',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区7',
      'tag3'        => 'G',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'image',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab6@3x.png',
      'iconActive'  => '/__base/images/tabber/tab6@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '文学小说',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区8',
      'tag3'        => 'H',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'image',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab6@3x.png',
      'iconActive'  => '/__base/images/tabber/tab6@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '文学小说',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz',
      'tag3'        => 'M',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'image',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab6@3x.png',
      'iconActive'  => '/__base/images/tabber/tab6@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '文学小说',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '25126',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区10',
      'tag3'        => 'N',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'image',
      'active'      => true,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab6@3x.png',
      'iconActive'  => '/__base/images/tabber/tab6@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '天涯神帖56255625562556255625562556255625562556255625562556255625562556255625562556255625562556255625562556255625',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区11',
      'tag3'        => 'L',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'video-list',
      "time"        => '10:10',
      "uptime"      => '2小时',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '天涯神帖233',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区11',
      'tag3'        => 'O',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'video-list',
      "time"        => '10:10',
      "uptime"      => '2小时',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '天涯神帖',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区11',
      'tag3'        => 'P',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'video-list',
      "time"        => '10:10',
      "uptime"      => '2小时',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心',
          'username'    => '唐心鹌鹑蛋唐心鹌鹑蛋唐心鹌鹑蛋唐心鹌鹑蛋唐心鹌鹑蛋唐心鹌鹑蛋唐心鹌鹑蛋唐心鹌鹑蛋',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '天涯神帖天涯神帖天涯神帖天涯神帖',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区12',
      'tag3'        => 'Q',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'video-list',
      "time"        => '10:10',
      "uptime"      => '2小时',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '天涯神帖天涯神帖天涯神帖天涯神帖',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区13',
      'tag3'        => 'R',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'video-list',
      "time"        => '10:10',
      "uptime"      => '2小时',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab5@3x.png',
      'iconActive'  => '/__base/images/tabber/tab5@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => '福利中心',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区14',
      'tag3'        => 'S',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'novel',
      "etag"        => '剧情',
      "code"        => '38.3',
      "pubtime"     => '1天',
      "updetail"    => '第10章 护花使者(9分钟前)',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab4@3x.png',
      'iconActive'  => '/__base/images/tabber/tab4@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
    [
      'text'        => 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
      'username'    => 'Hayley Davies',
      'date'        => '05-31 09:26',
      'subdate'     => '25分钟前',
      'view'        => '256',
      'play'        => '2323',
      'tag1'        => '海角视频',
      'tag2'        => '草榴社区15',
      'tag3'        => 'T',
      'subtitle'    => '是面向全球华人的免费在线色情视频播放平台我是面向全球华人的免费在线色情视频播放平台我们希望能为您们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
      'type'        => 'novel',
      "etag"        => '剧情',
      "code"        => '38.3',
      "pubtime"     => '1天',
      "updetail"    => '第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)第10章 护花使者(9分钟前)',
      'active'      => false,
      'url'         => '#',
      'icon'        => '/__base/images/tabber/tab4@3x.png',
      'iconActive'  => '/__base/images/tabber/tab4@3xhover.png',
      'color'       => '#909090',
      'colorActive' => '#4970f5',
      'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
      'sublist'      => [
        [
          'text'        => '福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
        [
          'text'        => '唐心鹌鹑蛋唐心鹌鹑蛋福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心福利中心',
          'username'    => 'Hayley Davies',
          'date'        => '05-31 09:26',
		  'view'        => '221',
          'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
          'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
        ],
      ],
      'images'      => [
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
        ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ],
      'videos'    => [
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
        ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ]
    ],
  ];

  // 通用数据
  protected $commdata = [
    'text'        => '热点',
    'username'    => '唐心鹌鹑蛋',
    'date'        => '2088/11/11 11:11:11',
    'dateyymmdd' => '2088/11/11',
    'view'        => '25126',
    'play'        => '2323',
    'tag1'        => '海角视频',
    'tag2'        => '草榴社区',
    'subtitle'    => '1是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣是面向全球华人的免费在线色情视频播放平台我们希望能为您的生活增添性趣',
    'type'        => 'image',
    'active'      => false,
    'url'         => '#',
    'icon'        => '/__base/images/tabber/tab1@3x.png',
    'iconActive'  => '/__base/images/tabber/tab1@3xhover.png',
    'color'       => '#909090',
    'colorActive' => '#4970f5',
    'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
    'state'       => '完结',
    'collect'     => '123',
    'latest'      => '全章节（1小时前）',
    'code'        => '23k',
    'detail'      => ' 爱上“啊！……！……朋友的！”
                            年的初中生，不过他！”爱上“！……总有一天，我会……我会找到女朋友的！”
                            年的初中生，不过他早已经年满26周岁了，现在的他，正在工厂打工。ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff',
    'chapters'     => [
      ['name' => '第1章  我即是天我即是天我即是天我即是天我即是天我即是天我即是天我即是天我即是天我即是天我即是天我即是天我即是天', 'time' => '2023-08-10  23:42'],
      ['name' => '第1章  sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 'time' => '2023-08-10  23:42'],
      ['name' => '第1章  我即是天', 'time' => '2023-08-10  23:42'],
      ['name' => '第1章  我即是天', 'time' => '2023-08-10  23:42'],
    ],
    'imageUrl'    => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
    'videoUrl'    => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',
    'images'      => [
      ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
      ['url' => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',],
    ],
    'videos'    => [
      ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
      ['url' => 'https://bitdash-a.akamaihd.net/content/sintel/hls/playlist.m3u8',],
    ]
  ];

  //客服聊天数据
  protected $messages = [
    [
      'msg'        => ' 风景看看繁花似锦看的好方法点次s人sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd
                sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'service'
    ],
    [
      'msg'        => ' 风景看看繁花似锦看的好方法点次s人sdd
                是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'user'
    ],
    [
      'msg'        => 'sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd
                sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd
                sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd
                sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'service'
    ],
    [
      'msg'        => ' 风景看看繁花似锦看的好方法点次s人sdd
                是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'user'
    ],
    [
      'msg'        => ' 风景看看繁sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd花似锦看的好方法点次s人sdd
                是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'service'
    ],
    [
      'msg'        => ' 风景看看繁花似锦看的好方法点次s人sdd
                是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'user'
    ],
    [
      'msg'        => ' 风景看看繁花sddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsddsdd似锦看的好方法点次s人sdd
                是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'service'
    ],
    [
      'msg'        => ' 风景看看繁花似锦看的好方法点次s人sdd
                是的后果？沈德符项目的身，谢',
      'sendimg'    => '',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'user'
    ],
    [
      'msg'        => '',
      'sendimg'    => '/__base/images/51.png',
      'time'       => '2023-9-18  14:23',
      'avtar'      => 'https://pic.ohbwo.cn/upload_01/xiao/20240628/2024062817323527933.png',
      'sendfrom'       => 'user'
    ],
  ];

  /**
   * 构造方法
   * @access public
   * @param  App  $app  应用对象
   */
  public function __construct(App $app)
  {
    $this->app     = $app;
    $this->request = $this->app->request;

    $this->lang = getCurrentLangTag();

    // 控制器初始化
    $this->initialize();
  }

  // 初始化
  protected function initialize()
  {
    // $listdata = array_merge(...array_fill(0, 100, $listdata));

    // 头部导航
    View::assign('__NAVBARS__',          $this->navbars);
    View::assign('__MENUFUNS__',         $this->menufuns);
    View::assign('__TABBERS__',          array_slice($this->tabbers, 0, 4));
    View::assign('__LISTS__',            $this->listdata);
    View::assign('__DATAS__',            $this->commdata);
    View::assign('__MESSGAES__',         $this->messages);
    View::assign('__HORIZONTAL_MENU__',  array_slice($this->navbars, 0, 3));
    // View::assign('__VERTICAL_MENU__',    array_slice($this->navbars, 6, count($this->navbars)));
    // View::assign('__VERTICAL_MENU__',    []);
    View::assign('__DOMAIN_PATH__',      $this->request->domain());

    // View::assign('__REQEUST_PATH__',     strtolower($this->request->controller()));
    // View::assign('__ACTION_PATH__',      strtolower($this->request->action()));

    // echo '<script type="text/javascript">
    //     (function (doc, win) {
    //         win.base_url = "' . Request::domain() . '";
    //     })(document, window);
    // </script>';

    View::assign('currentLang', getCurrentLangTag());

    View::assign('__LANGUAGES__', DataService::getLanguages());
    View::assign('__SOURCES__', DataService::getSources($this->lang));

    View::assign('__CATEGORIES__', DataService::getTopCategories($this->lang));
    View::assign('__PORNSTARS__', DataService::getTopPstars($this->lang));

  }

  /**
   * 验证数据
   * @access protected
   * @param  array        $data     数据
   * @param  string|array $validate 验证器名或者验证规则数组
   * @param  array        $message  提示信息
   * @param  bool         $batch    是否批量验证
   * @return array|string|true
   * @throws ValidateException
   */
  protected function validate(array $data, $validate, array $message = [], bool $batch = false)
  {
    if (is_array($validate)) {
      $v = new Validate();
      $v->rule($validate);
    } else {
      if (strpos($validate, '.')) {
        // 支持场景
        [$validate, $scene] = explode('.', $validate);
      }
      $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
      $v     = new $class();
      if (!empty($scene)) {
        $v->scene($scene);
      }
    }

    $v->message($message);

    // 是否批量验证
    if ($batch || $this->batchValidate) {
      $v->batch(true);
    }

    return $v->failException(true)->check($data);
  }
}
