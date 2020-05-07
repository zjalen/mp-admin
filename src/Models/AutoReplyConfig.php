<?php

namespace Jalen\MpAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class AutoReplyConfig extends Model
{
    // 定义消息类型
    const TYPE_TEXT = 0;
    const TYPE_IMAGE  = 1;
    const TYPE_VIDEO  = 2;
    const TYPE_VOICE  = 3;
    const TYPE_EVENT  = 4;
    const TYPE_LOCATION  = 5;
    const TYPE_LINK  = 6;

    public static $typeMap = [
        self::TYPE_TEXT  => '文本',
        self::TYPE_IMAGE   => '图片',
        self::TYPE_VIDEO   => '视频',
        self::TYPE_VOICE   => '音频',
        self::TYPE_EVENT  => '事件',
        self::TYPE_LOCATION  => '位置',
        self::TYPE_LINK  => '链接',
    ];

    // 定义匹配类型
    const MATCH_TYPE_FULL= 0;
    const MATCH_TYPE_HALF  = 1;

    public static $matchTypeMap = [
        self::MATCH_TYPE_FULL  => '完整匹配',
        self::MATCH_TYPE_HALF   => '半匹配',
    ];

    protected $table = 'mpa_auto_reply_configs';
    protected $fillable = ['mp_info_id', 'text', 'type', 'match_type', 'message_id', 'remark'];

    protected $casts = [
//        'content' => 'json'
    ];

    protected $appends = ['type_name', 'match_type_name', 'message_content'];

    public function mpInfo()
    {
        return $this->belongsTo(MpInfo::class, 'mp_info_id', 'id');
    }

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }


    public function getMessageContentAttribute()
    {
        return $this->message ? $this->message->content : '';
    }

    public function getTypeNameAttribute()
    {
        return self::$typeMap[$this->type];
    }

    public function getMatchTypeNameAttribute()
    {
        return self::$matchTypeMap[$this->match_type];
    }
}
