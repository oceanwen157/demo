<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\QorLanguages
 *
 * @OA\Schema (
 *      schema="QorLanguages",
 *      required={"sort", "tag", "code", "title", "path", "create_at", "update_at"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="sort",
 *          description="排序:ASC",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="boolean"
 *      ),
 *      @OA\Property(
 *          property="tag",
 *          description="标识",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="code",
 *          description="国际编码",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          description="标题",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="path",
 *          description="路径",
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
 * @property int $sort 排序:ASC
 * @property string $tag 标识
 * @property string $code 国际编码
 * @property string $title 标题
 * @property string $path 路径
 * @property int $create_at 创建时间
 * @property int $update_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages query()
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereCreateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorLanguages whereUpdateAt($value)
 * @mixin \Eloquent
 */
class QorLanguages extends Model
{

    use HasFactory;

    public $table = 'qor_languages';

    const CREATED_AT = null;
    const UPDATED_AT = null;



    public $fillable = [
        'sort',
        'tag',
        'code',
        'title',
        'path',
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
        'sort' => 'integer',
        'tag' => 'string',
        'code' => 'string',
        'title' => 'string',
        'path' => 'string',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sort' => 'integer',
        'tag' => 'required|string|max:32',
        'code' => 'required|string|max:32',
        'title' => 'required|string|max:64',
        'path' => 'required|string|max:64',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];


}
