<?php

namespace Jalen\MpAdmin\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'mpa_menus';
    protected $fillable = ['mp_info_id', 'content', 'remark'];

    protected $casts = [
//        'content' => 'json'
    ];

    public function mpInfo()
    {
        return $this->belongsTo(MpInfo::class, 'mp_info_id', 'id');
    }
}
