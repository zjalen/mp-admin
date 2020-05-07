<?php

namespace Jalen\MpAdmin\Controllers;

use EasyWeChat\Factory;
use EasyWeChat\Kernel\Exceptions\HttpException;
use EasyWeChat\Kernel\Exceptions\InvalidConfigException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Jalen\MpAdmin\Models\Menu;
use Jalen\MpAdmin\Models\MpInfo;

class MenusController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $builder = Menu::query();
        $this->setBuilder($builder);
        $this->setModel(new Menu());
    }

    public function updateToMp()
    {
        $mp_info = request()->get('mp_info')->toArray();
        $app = Factory::officialAccount($mp_info);
        $content = request()->input('content');
        if (!$content) {
            return $this->failed('菜单参数有误');
        }
        try {
            $content = json_decode($content);
            $res = $app->menu->create($content);
        }catch (HttpException $exception) {
            return $this->failed($exception->getMessage());
        } catch (InvalidConfigException $exception) {
            return $this->failed($exception->getMessage());
        } catch (GuzzleException $exception) {
            return $this->failed($exception->getMessage());
        }
        return $this->success($res);
    }

    public function getCurrentMpMenu()
    {
        $mp_info = request()->get('mp_info')->toArray();
        $app = Factory::officialAccount($mp_info);
        try {
            $res = $app->menu->list();
        }catch (HttpException $exception) {
            return $this->failed($exception->getMessage());
        } catch (InvalidConfigException $exception) {
            return $this->failed($exception->getMessage());
        } catch (GuzzleException $exception) {
            return $this->failed($exception->getMessage());
        }
        return $this->success($res);
    }
}
