<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\QorPartners
 *
 * @OA\Schema (
 *      schema="QorPartners",
 *      required={"trans_status", "name", "logo", "sort", "title_en", "title_cn", "title_tw", "title_ja", "title_ko", "title_ms", "title_th", "title_de", "title_vi", "title_id", "title_pt", "title_tlph", "hint_en", "hint_cn", "hint_tw", "hint_ja", "hint_ko", "hint_ms", "hint_th", "hint_de", "hint_vi", "hint_id", "hint_pt", "hint_tlph", "create_at", "update_at"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="trans_status",
 *          description="翻译状态:0待翻译,1翻译中,2翻译完成",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="名称",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="logo",
 *          description="LOGO",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="sort",
 *          description="排序:ASC",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="title_en",
 *          description="标题-英文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_cn",
 *          description="标题-简体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_tw",
 *          description="标题-繁体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_ja",
 *          description="标题-日文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_ko",
 *          description="标题-韩文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_ms",
 *          description="标题-马来文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_th",
 *          description="标题-泰文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_de",
 *          description="标题-德文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_vi",
 *          description="标题-越南文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_id",
 *          description="标题-印尼文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_pt",
 *          description="标题-葡萄牙文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title_tlph",
 *          description="标题-菲律宾文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_en",
 *          description="提示-英文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_cn",
 *          description="提示-简体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_tw",
 *          description="提示-繁体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_ja",
 *          description="提示-日文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_ko",
 *          description="提示-韩文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_ms",
 *          description="提示-马来文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_th",
 *          description="提示-泰文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_de",
 *          description="提示-德文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_vi",
 *          description="提示-越南文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_id",
 *          description="提示-印尼文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_pt",
 *          description="提示-葡萄牙文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="hint_tlph",
 *          description="提示-菲律宾文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_en",
 *          description="描述-英文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_cn",
 *          description="描述-简体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_tw",
 *          description="描述-繁体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_ja",
 *          description="描述-日文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_ko",
 *          description="描述-韩文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_ms",
 *          description="描述-马来文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_th",
 *          description="描述-泰文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_de",
 *          description="描述-德文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_vi",
 *          description="描述-越南文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_id",
 *          description="描述-印尼文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_pt",
 *          description="描述-葡萄牙文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="description_tlph",
 *          description="描述-菲律宾文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="create_at",
 *          description="创建时间",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="update_at",
 *          description="更新时间",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      )
 * )
 * @property int $id
 * @property int $trans_status 翻译状态:0待翻译,1翻译中,2翻译完成
 * @property string $name 名称
 * @property string $logo LOGO
 * @property int $sort 排序:ASC
 * @property string $title_en 标题-英文
 * @property string $title_cn 标题-简体中文
 * @property string $title_tw 标题-繁体中文
 * @property string $title_ja 标题-日文
 * @property string $title_ko 标题-韩文
 * @property string $title_ms 标题-马来文
 * @property string $title_th 标题-泰文
 * @property string $title_de 标题-德文
 * @property string $title_vi 标题-越南文
 * @property string $title_id 标题-印尼文
 * @property string $title_pt 标题-葡萄牙文
 * @property string $title_tlph 标题-菲律宾文
 * @property string $hint_en 提示-英文
 * @property string $hint_cn 提示-简体中文
 * @property string $hint_tw 提示-繁体中文
 * @property string $hint_ja 提示-日文
 * @property string $hint_ko 提示-韩文
 * @property string $hint_ms 提示-马来文
 * @property string $hint_th 提示-泰文
 * @property string $hint_de 提示-德文
 * @property string $hint_vi 提示-越南文
 * @property string $hint_id 提示-印尼文
 * @property string $hint_pt 提示-葡萄牙文
 * @property string $hint_tlph 提示-菲律宾文
 * @property string|null $description_en 描述-英文
 * @property string|null $description_cn 描述-简体中文
 * @property string|null $description_tw 描述-繁体中文
 * @property string|null $description_ja 描述-日文
 * @property string|null $description_ko 描述-韩文
 * @property string|null $description_ms 描述-马来文
 * @property string|null $description_th 描述-泰文
 * @property string|null $description_de 描述-德文
 * @property string|null $description_vi 描述-越南文
 * @property string|null $description_id 描述-印尼文
 * @property string|null $description_pt 描述-葡萄牙文
 * @property string|null $description_tlph 描述-菲律宾文
 * @property int $create_at 创建时间
 * @property int $update_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners query()
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereCreateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionKo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionPt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionTlph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionTw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereDescriptionVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintKo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintPt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintTlph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintTw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereHintVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleKo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitlePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleTlph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleTw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereTransStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorPartners whereUpdateAt($value)
 * @mixin \Eloquent
 */
class QorPartners extends Model
{
    use HasFactory;

    public $table = 'qor_partners';

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $dateFormat = 'U';



    public $fillable = [
        'trans_status',
        'name',
        'logo',
        'sort',
        'title_en',
        'title_cn',
        'title_tw',
        'title_ja',
        'title_ko',
        'title_ms',
        'title_th',
        'title_de',
        'title_vi',
        'title_id',
        'title_pt',
        'title_tlph',
        'hint_en',
        'hint_cn',
        'hint_tw',
        'hint_ja',
        'hint_ko',
        'hint_ms',
        'hint_th',
        'hint_de',
        'hint_vi',
        'hint_id',
        'hint_pt',
        'hint_tlph',
        'description_en',
        'description_cn',
        'description_tw',
        'description_ja',
        'description_ko',
        'description_ms',
        'description_th',
        'description_de',
        'description_vi',
        'description_id',
        'description_pt',
        'description_tlph',
        'create_at',
        'update_at'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'trans_status' => 'integer',
        'name' => 'string',
        'logo' => 'string',
        'sort' => 'integer',
        'title_en' => 'string',
        'title_cn' => 'string',
        'title_tw' => 'string',
        'title_ja' => 'string',
        'title_ko' => 'string',
        'title_ms' => 'string',
        'title_th' => 'string',
        'title_de' => 'string',
        'title_vi' => 'string',
        'title_id' => 'string',
        'title_pt' => 'string',
        'title_tlph' => 'string',
        'hint_en' => 'string',
        'hint_cn' => 'string',
        'hint_tw' => 'string',
        'hint_ja' => 'string',
        'hint_ko' => 'string',
        'hint_ms' => 'string',
        'hint_th' => 'string',
        'hint_de' => 'string',
        'hint_vi' => 'string',
        'hint_id' => 'string',
        'hint_pt' => 'string',
        'hint_tlph' => 'string',
        'description_en' => 'string',
        'description_cn' => 'string',
        'description_tw' => 'string',
        'description_ja' => 'string',
        'description_ko' => 'string',
        'description_ms' => 'string',
        'description_th' => 'string',
        'description_de' => 'string',
        'description_vi' => 'string',
        'description_id' => 'string',
        'description_pt' => 'string',
        'description_tlph' => 'string',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'trans_status' => 'integer',
        'name' => 'required|string|max:128',
        'logo' => 'string|max:1024',
        'sort' => 'integer',
        'title_en' => 'required|string|max:512',
        'title_cn' => 'string|max:512',
        'title_tw' => 'string|max:512',
        'title_ja' => 'string|max:512',
        'title_ko' => 'string|max:512',
        'title_ms' => 'string|max:512',
        'title_th' => 'string|max:512',
        'title_de' => 'string|max:512',
        'title_vi' => 'string|max:512',
        'title_id' => 'string|max:512',
        'title_pt' => 'string|max:512',
        'title_tlph' => 'string|max:512',
        'hint_en' => 'required|string|max:512',
        'hint_cn' => 'string|max:512',
        'hint_tw' => 'string|max:512',
        'hint_ja' => 'string|max:512',
        'hint_ko' => 'string|max:512',
        'hint_ms' => 'string|max:512',
        'hint_th' => 'string|max:512',
        'hint_de' => 'string|max:512',
        'hint_vi' => 'string|max:512',
        'hint_id' => 'string|max:512',
        'hint_pt' => 'string|max:512',
        'hint_tlph' => 'string|max:512',
        'description_en' => 'required|nullable|string',
        'description_cn' => 'nullable|string',
        'description_tw' => 'nullable|string',
        'description_ja' => 'nullable|string',
        'description_ko' => 'nullable|string',
        'description_ms' => 'nullable|string',
        'description_th' => 'nullable|string',
        'description_de' => 'nullable|string',
        'description_vi' => 'nullable|string',
        'description_id' => 'nullable|string',
        'description_pt' => 'nullable|string',
        'description_tlph' => 'nullable|string',
    ];


}
