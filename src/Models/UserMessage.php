<?php

namespace Jalen\MpAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    // 定义消息类型
    const TYPE_TEXT = 0;
    const TYPE_IMAGE  = 1;
    const TYPE_VIDEO  = 2;
    const TYPE_VOICE  = 3;
    const TYPE_NEWS_ITEM  = 4;
    const TYPE_ARTICLE  = 5;
    const TYPE_MEDIA  = 6;
    const TYPE_RAW  = 7;

    public static $typeMap = [
        self::TYPE_TEXT  => '文本',
        self::TYPE_IMAGE   => '图片',
        self::TYPE_VIDEO   => '视频',
        self::TYPE_VOICE   => '音频',
        self::TYPE_NEWS_ITEM  => '图文',
        self::TYPE_ARTICLE  => '文章',
        self::TYPE_MEDIA  => '素材',
        self::TYPE_RAW  => '原始',
    ];

    protected $table = 'mpa_user_messages';

    protected $fillable = ['mp_info_id', 'openid', 'content', 'type', 'remark'];

    protected $appends = ['type_name'];

    public function mpInfo()
    {
        return $this->belongsTo(MpInfo::class, 'mp_info_id', 'id');
    }

    public function getTypeNameAttribute()
    {
        return self::$typeMap[$this->type];
    }
}
