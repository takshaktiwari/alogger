<?php

namespace Takshak\Alogger\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Takshak\Alogger\Models\Logger as LoggerModel;

class Logger extends Component
{
    public $logger;
    public $request;
    public function __construct($loggerId)
    {
        $this->request = request();
        $this->logger = LoggerModel::find($loggerId);
    }

    public function render()
    {
        return View::first(['components.aloggers.show', 'alogger::components.aloggers.show']);
    }
}
