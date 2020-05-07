<?php

namespace Jalen\MpAdmin\Models;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MpInfo extends Model
{
    //
    protected $table = 'mpa_mp_info';
    protected $fillable = ['app_id', 'sign', 'raw_id', 'secret', 'token', 'aes_key', 'name', 'qr_code'];

    public function getQrUrlAttribute()
    {
        $res = Storage::disk('public')->url($this->qr_code);
        return $res;
    }

    public function menus()
    {
        return $this->hasMany(Menu::class, 'mp_info_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function($modal) {
            Storage::disk('public')->delete($modal->qr_code);
        });
    }
}
