<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\QorVideos
 *
 * @OA\Schema (
 *      schema="QorVideos",
 *      required={"cid", "pid", "sid", "duration_num", "view_num", "vote_num", "origin_name", "cover_ori", "cover_new", "source", "duration_desc", "view_desc", "vote_desc", "title_en", "title_cn", "title_tw", "title_ja", "title_ko", "title_ms", "title_th", "title_de", "title_vi", "title_id", "title_pt", "title_tlph", "play_url", "create_at", "update_at"},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="cid",
 *          description="分类ID",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="pid",
 *          description="明星ID",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="sid",
 *          description="来源ID",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="duration_num",
 *          description="时长量,秒",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="view_num",
 *          description="浏览量",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="vote_num",
 *          description="投票数",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="origin_name",
 *          description="原名",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="cover_ori",
 *          description="封面-原地址",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="cover_new",
 *          description="封面-经下载后上传的地址",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="source",
 *          description="来源名",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="duration_desc",
 *          description="时长描述",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="view_desc",
 *          description="浏览量描述",
 *          readOnly=$FIELD_READ_ONLY$,
 *          nullable=$FIELD_NULLABLE$,
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="vote_desc",
 *          description="投票描述",
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
 *          property="play_url",
 *          description="播放地址",
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
 * @property int $cid 分类ID
 * @property int $pid 明星ID
 * @property int $sid 来源ID
 * @property int $duration_num 时长量,秒
 * @property int $view_num 浏览量
 * @property int $vote_num 投票数
 * @property string $origin_name 原名
 * @property string $cover_ori 封面-原地址
 * @property string $cover_new 封面-经下载后上传的地址
 * @property string $source 来源名
 * @property string $duration_desc 时长描述
 * @property string $view_desc 浏览量描述
 * @property string $vote_desc 投票描述
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
 * @property string $play_url 播放地址
 * @property int $create_at 创建时间
 * @property int $update_at 更新时间
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos query()
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereCid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereCoverNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereCoverOri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereCreateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereDurationDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereDurationNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereOriginName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos wherePlayUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereSid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleCn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleDe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleJa($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleKo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleMs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitlePt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleTh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleTlph($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleTw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereTitleVi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereUpdateAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereViewDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereViewNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereVoteDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QorVideos whereVoteNum($value)
 * @mixin \Eloquent
 */
class QorVideos extends Model
{

    use HasFactory;

    public $table = 'qor_videos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'cid',
        'pid',
        'sid',
        'duration_num',
        'view_num',
        'vote_num',
        'origin_name',
        'cover_ori',
        'cover_new',
        'source',
        'duration_desc',
        'view_desc',
        'vote_desc',
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
        'play_url',
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
        'cid' => 'integer',
        'pid' => 'integer',
        'sid' => 'integer',
        'duration_num' => 'integer',
        'view_num' => 'integer',
        'vote_num' => 'integer',
        'origin_name' => 'string',
        'cover_ori' => 'string',
        'cover_new' => 'string',
        'source' => 'string',
        'duration_desc' => 'string',
        'view_desc' => 'string',
        'vote_desc' => 'string',
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
        'play_url' => 'string',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cid' => 'integer',
        'pid' => 'integer',
        'sid' => 'integer',
        'duration_num' => 'integer',
        'view_num' => 'integer',
        'vote_num' => 'integer',
        'origin_name' => 'required|string|max:255',
        'cover_ori' => 'required|string|max:255',
        'cover_new' => 'required|string|max:255',
        'source' => 'string|max:64',
        'duration_desc' => 'string|max:32',
        'view_desc' => 'string|max:32',
        'vote_desc' => 'string|max:32',
        'title_en' => 'required|string|max:128',
        'title_cn' => 'required|string|max:128',
        'title_tw' => 'required|string|max:128',
        'title_ja' => 'required|string|max:128',
        'title_ko' => 'required|string|max:128',
        'title_ms' => 'required|string|max:128',
        'title_th' => 'required|string|max:128',
        'title_de' => 'required|string|max:128',
        'title_vi' => 'required|string|max:128',
        'title_id' => 'required|string|max:128',
        'title_pt' => 'required|string|max:128',
        'title_tlph' => 'required|string|max:128',
        'play_url' => 'required|string|max:255',
        'create_at' => 'integer',
        'update_at' => 'integer'
    ];


}
