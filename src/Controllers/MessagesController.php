<?php

namespace Jalen\MpAdmin\Controllers;

use Illuminate\Http\Request;
use Jalen\MpAdmin\Models\Message;

class MessagesController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $builder = Message::query();
        $this->setBuilder($builder);
        $this->setModel(new Message());
    }
}
