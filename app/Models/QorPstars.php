<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *      schema="QorPstars",
 *      required={"letter", "origin_name", "title_en", "title_cn", "title_tw", "title_ja", "title_ko", "title_ms", "title_th", "title_de", "title_vi", "title_id", "title_pt", "title_tlph", "route_path", "quantity_desc", "create_at", "update_at"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="letter",
 *          description="首字母",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="origin_name",
 *          description="原名",
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
 *          property="route_path",
 *          description="路由路径",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="quantity_desc",
 *          description="数量描述",
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
 */
class QorPstars extends Model
{

    use HasFactory;

    public $table = 'qor_pstars';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'letter',
        'origin_name',
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
        'route_path',
        'quantity_desc',
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
        'letter' => 'string',
        'origin_name' => 'string',
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
        'route_path' => 'string',
        'quantity_desc' => 'string',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'letter' => 'required|string|max:1',
        'origin_name' => 'required|string|max:128',
        'title_en' => 'string|max:128',
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
        'route_path' => 'required|string|max:64',
        'quantity_desc' => 'string|max:64',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];


}
