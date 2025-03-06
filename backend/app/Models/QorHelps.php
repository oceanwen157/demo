<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\QorHelps
 *
 * @OA\Schema (
 *      schema="QorHelps",
 *      required={"trans_status", "sort", "route_path", "title_en", "title_cn", "title_tw", "title_ja", "title_ko", "title_ms", "title_th", "title_de", "title_vi", "title_id", "title_pt", "title_tlph", "create_at", "update_at"},
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
 *          type="integer"
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
 *          property="route_path",
 *          description="路由路径",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
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
 *          property="content_en",
 *          description="内容-英文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_cn",
 *          description="内容-简体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_tw",
 *          description="内容-繁体中文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_ja",
 *          description="内容-日文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_ko",
 *          description="内容-韩文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_ms",
 *          description="内容-马来文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_th",
 *          description="内容-泰文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_de",
 *          description="内容-德文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_vi",
 *          description="内容-越南文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_id",
 *          description="内容-印尼文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_pt",
 *          description="内容-葡萄牙文",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content_tlph",
 *          description="内容-菲律宾文",
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
 * @property int $sort 排序:ASC
 * @property string $route_path 路由路径
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
 * @property string|null $content_en 内容-英文
 * @property string|null $content_cn 内容-简体中文
 * @property string|null $content_tw 内容-繁体中文
 * @property string|null $content_ja 内容-日文
 * @property string|null $content_ko 内容-韩文
 * @property string|null $content_ms 内容-马来文
 * @property string|null $content_th 内容-泰文
 * @property string|null $content_de 内容-德文
 * @property string|null $content_vi 内容-越南文
 * @property string|null $content_id 内容-印尼文
 * @property string|null $content_pt 内容-葡萄牙文
 * @property string|null $content_tlph 内容-菲律宾文
 * @property int $create_at 创建时间
 * @property int $update_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps query()
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentKo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentPt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentTlph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentTw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereContentVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereCreateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereRoutePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleKo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitlePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleTlph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleTw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereTransStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorHelps whereUpdateAt($value)
 * @mixin \Eloquent
 */
class QorHelps extends Model
{
    use HasFactory;

    public $table = 'qor_helps';

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    protected $dateFormat = 'U';


    public $fillable = [
        'trans_status',
        'sort',
        'route_path',
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
        'content_en',
        'content_cn',
        'content_tw',
        'content_ja',
        'content_ko',
        'content_ms',
        'content_th',
        'content_de',
        'content_vi',
        'content_id',
        'content_pt',
        'content_tlph',
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
        'sort' => 'integer',
        'route_path' => 'string',
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
        'content_en' => 'string',
        'content_cn' => 'string',
        'content_tw' => 'string',
        'content_ja' => 'string',
        'content_ko' => 'string',
        'content_ms' => 'string',
        'content_th' => 'string',
        'content_de' => 'string',
        'content_vi' => 'string',
        'content_id' => 'string',
        'content_pt' => 'string',
        'content_tlph' => 'string',
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
        'sort' => 'integer',
        'route_path' => 'required|string|max:128',
        'title_en' => 'required|string|max:128',
        'title_cn' => 'string|max:128',
        'title_tw' => 'string|max:128',
        'title_ja' => 'string|max:128',
        'title_ko' => 'string|max:128',
        'title_ms' => 'string|max:128',
        'title_th' => 'string|max:128',
        'title_de' => 'string|max:128',
        'title_vi' => 'string|max:128',
        'title_id' => 'string|max:128',
        'title_pt' => 'string|max:128',
        'title_tlph' => 'string|max:128',
        'content_en' => 'required|nullable|string',
        'content_cn' => 'nullable|string',
        'content_tw' => 'nullable|string',
        'content_ja' => 'nullable|string',
        'content_ko' => 'nullable|string',
        'content_ms' => 'nullable|string',
        'content_th' => 'nullable|string',
        'content_de' => 'nullable|string',
        'content_vi' => 'nullable|string',
        'content_id' => 'nullable|string',
        'content_pt' => 'nullable|string',
        'content_tlph' => 'nullable|string',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];


}
