<?php
// 应用公共文件
use think\model\Collection;

/**
 * 根据语言后缀获取多语言的标题
 * @param Collection|array $mod 数据模型
 * @param string $langSuffix 语言后缀,值有
 * - en,英文
 * - cn,简体中文
 * - tw,繁体中文
 * - ja,日文
 * - ko,韩文
 * - ms,马来文
 * - th,泰文
 * - de,德文
 * - vi,越南文
 * - id,印尼文
 * - pt,葡萄牙文
 * - tlph,菲律宾文
 * @return string
 */
function getTitleByLang($mod, string $langSuffix = ''): string
{

    $chk1 = $mod instanceof Collection;
    $chk2 = is_array($mod);
    if ($chk1 && $chk2) {
        return '';
    }

    $default = $chk1 ? ($mod->title_en ?? '') : ($mod['title_en'] ?? '');
    $default = trim($default);

    if (empty($langSuffix)) {
        return $default;
    }

    $field = "title_{$langSuffix}";
    $res = $chk1 ? ($mod->$field ?? '') : ($mod[$field] ?? '');
    $res = trim($res);
    if (empty($res)) {
        $res = $default;
    }

    return $res;
}
