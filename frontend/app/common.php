<?php
// 应用公共文件
use think\model\Collection;
use think\Model;
use app\model\Helps;
use voku\helper\UTF8;

/**
 * 获取当前语言标识
 * @return string
 */
function getCurrentLangTag(): string
{
    //* - en,英文
    //* - cn,简体中文
    //* - tw,繁体中文
    //* - ja,日文
    //* - ko,韩文
    //* - ms,马来文
    //* - th,泰文
    //* - de,德文
    //* - vi,越南文
    //* - id,印尼文
    //* - pt,葡萄牙文
    //* - tlph,菲律宾文
    $res = cookie('think_lang', '');
    if (empty($res)) {
        $res = 'en'; //默认英文
    }

    return $res;
}


/**
 * 根据字段名获取当前语言对应的值
 * @param Model|array $mod 数据模型或数组
 * @param string $fieldPrefix 字段名前缀(不含语言标识),默认为title；还有合作伙伴的hint、description。
 * @return string
 */
function getLangValueByField($mod, string $fieldPrefix = 'title'): string
{

    $chk1 = $mod instanceof Model;
    $chk2 = is_array($mod);
    if (!$chk1 && !$chk2) {
        return 'error';
    }

    $tag = getCurrentLangTag();
    $fieldName = "{$fieldPrefix}_$tag";
    $defaultField = "{$fieldPrefix}_en";

    $defaultValue = $chk1 ? ($mod->$defaultField ?? '') : ($mod[$defaultField] ?? '');
    $defaultValue = trim($defaultValue);

    $fieldValue = $chk1 ? ($mod->$fieldName ?? '') : ($mod[$fieldName] ?? '');
    $fieldValue = trim($fieldValue);
    $chkTxt = trim(UTF8::strip_tags($fieldValue));

    if (empty($fieldValue) || empty($chkTxt)) {
        $res = $defaultValue;
    } else {
        $res = $fieldValue;
    }

    return $res;
}


/**
 * 根据路由获取帮助标题
 * @param string $route
 * @return string
 */
function getHelpTitleByRoute(string $route): string
{
    $res = '#';
    $route = trim($route);
    if (!empty($route)) {
        $row = Helps::where('route_path', $route)->find();
        if ($row) {
            $res = getLangValueByField($row, 'title');
        }
    }

    return $res;
}

