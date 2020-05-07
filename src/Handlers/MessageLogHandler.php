<?php


namespace Jalen\MpAdmin\Handlers;


use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use Illuminate\Support\Facades\Log;
use Jalen\MpAdmin\Models\MpInfo;
use Jalen\MpAdmin\Models\UserMessage;

class MessageLogHandler implements EventHandlerInterface
{

    /**
     * @param mixed $payload
     */
    public function handle($payload = null)
    {
//        Log::info($payload);
        $mp_model = MpInfo::where('raw_id', $payload['ToUserName'])->first();
        if (!$mp_model) {
            Log::error($payload['ToUserName'].' not found');
            return;
        }
        $model = new UserMessage();
        $model->mp_info_id = $mp_model->id;
        $model->openid = $payload['FromUserName'];
        switch ($payload['MsgType']) {
            case 'text':
                $model->type = UserMessage::TYPE_TEXT;
                $model->content = $payload['Content'];
                break;
            case 'image':
                $model->type = UserMessage::TYPE_IMAGE;
                $model->content = $payload['MediaId'];
                break;
            case 'video':
            case 'shortvideo':
                $model->type = UserMessage::TYPE_VIDEO;
                $model->content = $payload['MediaId'];
                break;
            default:
                return;
        }

        $model->save();
        return;
    }
}