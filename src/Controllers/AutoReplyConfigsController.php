<?php

namespace Jalen\MpAdmin\Controllers;

use Illuminate\Http\Request;
use Jalen\MpAdmin\Models\AutoReplyConfig;

class AutoReplyConfigsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $builder = AutoReplyConfig::query();
        $this->setBuilder($builder);
        $this->setModel(new AutoReplyConfig());
    }
}
