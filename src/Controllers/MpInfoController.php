<?php

namespace Jalen\MpAdmin\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Jalen\MpAdmin\Models\MpInfo;
use Jalen\MpAdmin\Requests\MpInfoRequest;
use Symfony\Component\HttpFoundation\File\File;

class MpInfoController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $builder = MpInfo::query();
        $this->setBuilder($builder);
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $request = app(MpInfoRequest::class);
        $params = $request->input();
        if ($request->hasFile('qr_code')) {
            $file = $request->file('qr_code');
            $res = $this->saveImageFile($file);
            if (!$res) {
                return $this->failed('图片异常');
            }
            $params['qr_code'] = $res;
        }
        $mp_info = new MpInfo($params);
        $res = $mp_info->save();
        if ($res) {
            return $this->created();
        }else {
            Storage::disk('public')->delete($params['qr_code']);
            return $this->failed('创建失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $sign
     * @return \Illuminate\Http\Response
     */
    public function show($sign)
    {
        $mp = MpInfo::where('sign', $sign)->first()->append('qr_url');
        if (!$mp) {
            return $this->notFond();
        }else {
            return $this->success($mp);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $sign
     * @return \Illuminate\Http\Response
     */
    public function update($sign)
    {
        $request = app(MpInfoRequest::class);
        $params = $request->all();
        $mp_info = MpInfo::where('sign', $sign)->first();
        if (!$mp_info) {
            return $this->notFond();
        }
        if ($request->hasFile('qr_code')) {
            $file = $request->file('qr_code');
            $res = $this->saveImageFile($file);
            if (!$res) {
                return $this->failed('图片异常');
            }
            $params['qr_code'] = $res;
            Storage::disk('public')->delete($mp_info->qr_code);
        }else {
            unset($params['qr_code']);
        }
        $mp_info->fill($params);
        $res = $mp_info->save();
        if ($res) {
            return $this->created($res);
        }else {
            Storage::disk('public')->delete($params['qr_code']);
            return $this->failed('更新失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $sign
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($sign)
    {
        $model = MpInfo::where('sign', $sign)->first();
        if (!$model) {
            return $this->notFond();
        }else {
            $res = $model->delete();
            if (!$res) {
                return $this->failed('删除失败');
            }
            return $this->success('删除成功');
        }
    }

    public function saveImageFile(File $file)
    {
        $allowed_ext = ['jpg', 'jpeg', 'bmp', 'gif', 'png'];
        // 如果上传的不是图片将终止操作
        if ( !in_array($file->getClientOriginalExtension(), $allowed_ext)) {
            return false;
        }
        $path = Storage::disk('public')->putFile('qr_code', $file);
        if (!$path) {
            return false;
        }
        return $path;
    }
}
