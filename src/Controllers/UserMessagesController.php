<?php

namespace Jalen\MpAdmin\Controllers;

use Illuminate\Http\Request;
use Jalen\MpAdmin\Models\UserMessage;

class UserMessagesController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $builder = UserMessage::query();
        $this->setBuilder($builder);
        $this->setModel(new UserMessage());
    }
}
