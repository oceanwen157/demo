###
DROP TABLE IF EXISTS `qor_languages`;
CREATE TABLE `qor_languages`
(
    `id`        smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    `sort`      tinyint(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序:ASC',
    `tag`       varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标识',
    `code`      varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '国际编码',
    `title`     varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
    `path`      varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '路径',
    `create_at` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_at` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
    PRIMARY KEY (`id`),
    INDEX       `uk_tag`(`tag` ASC)
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '语言表';

###
insert  into `qor_languages`(`id`,`sort`,`tag`,`code`,`title`,`path`,`create_at`,`update_at`) values
(1,1,'en','en','English','en',1740398335,1740398335),
(2,2,'cn','zh-CN','简体中文','cn',1740398335,1740398335),
(3,3,'tw','zh-TW','繁体中文','tw',1740398335,1740398335),
(4,4,'ja','ja','日本語','ja',1740398335,1740398335),
(5,5,'ko','ko','한국어','ko',1740398335,1740398335),
(6,6,'ms','ms','Malay','ms',1740398335,1740398335),
(7,7,'th','Thai','ภาษาไทย','th',1740398335,1740398335),
(8,8,'de','de','Deutsch','de',1740398335,1740398335),
(9,9,'vi','vi','Tiếng Việt','vi',1740398335,1740398335),
(10,10,'id','id','Bahasa Indonesia','id',1740398335,1740398335),
(11,11,'pt','pt','Português','pt',1740398335,1740398335),
(12,12,'tlph','tl-PH','Tagalog','tlph',1740398335,1740398335);


DROP TABLE IF EXISTS `qor_categories`;
CREATE TABLE `qor_categories`
(
    `id`            int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `is_hot`        tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否热门:0否1是',
    `trans_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '翻译状态:0待翻译,1翻译中,2翻译完成',
    `gender`        tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别:0未知,1男性,2女性',
    `age_limit`     tinyint(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄限制',
    `sort`          smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序:ASC',
    `letter`        char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      NOT NULL DEFAULT '' COMMENT '首字母',
    `origin_name`   varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '原名',
    `title_en`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-英文',
    `title_cn`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-简体中文',
    `title_tw`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-繁体中文',
    `title_ja`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-日文',
    `title_ko`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-韩文',
    `title_ms`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-马来文',
    `title_th`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-泰文',
    `title_de`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-德文',
    `title_vi`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-越南文',
    `title_id`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-印尼文',
    `title_pt`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-葡萄牙文',
    `title_tlph`    varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-菲律宾文',
    `route_path`    varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '路由路径',
    `quantity_desc` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '数量描述',
    `create_at`     int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_at`     int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '分类表';


DROP TABLE IF EXISTS `qor_pstars`;
CREATE TABLE `qor_pstars`
(
    `id`            int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `is_hot`        tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否热门:0否1是',
    `trans_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '翻译状态:0待翻译,1翻译中,2翻译完成',
    `gender`        tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '性别:0未知,1男性,2女性',
    `age_limit`     tinyint(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄限制',
    `sort`          smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序:ASC',
    `letter`        char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      NOT NULL DEFAULT '' COMMENT '首字母',
    `origin_name`   varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '原名',
    `title_en`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-英文',
    `title_cn`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-简体中文',
    `title_tw`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-繁体中文',
    `title_ja`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-日文',
    `title_ko`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-韩文',
    `title_ms`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-马来文',
    `title_th`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-泰文',
    `title_de`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-德文',
    `title_vi`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-越南文',
    `title_id`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-印尼文',
    `title_pt`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-葡萄牙文',
    `title_tlph`    varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-菲律宾文',
    `route_path`    varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '路由路径',
    `quantity_desc` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '数量描述',
    `create_at`     int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_at`     int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '明星表';


DROP TABLE IF EXISTS `qor_sources`;
CREATE TABLE `qor_sources`
(
    `id`           int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `is_hot`       tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否热门:0否1是',
    `trans_status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '翻译状态:0待翻译,1翻译中,2翻译完成',
    `sort`         smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序:ASC',
    `letter`       char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci      NOT NULL DEFAULT '' COMMENT '首字母',
    `origin_name`  varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '原名',
    `title_en`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-英文',
    `title_cn`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-简体中文',
    `title_tw`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-繁体中文',
    `title_ja`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-日文',
    `title_ko`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-韩文',
    `title_ms`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-马来文',
    `title_th`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-泰文',
    `title_de`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-德文',
    `title_vi`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-越南文',
    `title_id`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-印尼文',
    `title_pt`     varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-葡萄牙文',
    `title_tlph`   varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-菲律宾文',
    `create_at`    int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_at`    int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '来源站点表';


DROP TABLE IF EXISTS `qor_videos`;
CREATE TABLE `qor_videos`
(
    `id`            int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `is_hot`        tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否热门:0否1是',
    `trans_status`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '翻译状态:0待翻译,1翻译中,2翻译完成',
    `cid`           int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类ID',
    `pid`           int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '明星ID',
    `sid`           int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '来源ID',
    `duration_num`  int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '时长量,秒',
    `view_num`      int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '浏览量',
    `vote_num`      int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '投票数',
    `origin_name`   varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci       NOT NULL DEFAULT '' COMMENT '原名',
    `cover_ori`     varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci       NOT NULL DEFAULT '' COMMENT '封面-原地址',
    `cover_new`     varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci       NOT NULL DEFAULT '' COMMENT '封面-经下载后上传的地址',
    `source`        varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '来源名',
    `duration_desc` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '时长描述',
    `view_desc`     varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '浏览量描述',
    `vote_desc`     varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci        NOT NULL DEFAULT '' COMMENT '投票描述',
    `title_en`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-英文',
    `title_cn`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-简体中文',
    `title_tw`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-繁体中文',
    `title_ja`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-日文',
    `title_ko`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-韩文',
    `title_ms`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-马来文',
    `title_th`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-泰文',
    `title_de`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-德文',
    `title_vi`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-越南文',
    `title_id`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-印尼文',
    `title_pt`      varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-葡萄牙文',
    `title_tlph`    varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题-菲律宾文',
    `play_url`      varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci       NOT NULL DEFAULT '' COMMENT '播放地址',
    `create_at`     int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
    `update_at`     int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
    PRIMARY KEY (`id`),
    INDEX           `idx_cid`(`cid` ASC) USING BTREE,
    INDEX           `idx_pid`(`pid` ASC) USING BTREE,
    INDEX           `idx_sid`(`sid` ASC) USING BTREE,
    INDEX           `idx_name`(`origin_name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '视频表';
