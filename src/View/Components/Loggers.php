<?php

namespace Takshak\Alogger\View\Components;

use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use Takshak\Alogger\Models\Logger;

class Loggers extends Component
{
    public $paginate;
    public $loggers;
    public $request;
    public function __construct($paginate = 50)
    {
        $this->request = request();
        $query = Logger::with('user');

        if ($this->request->get('url')) {
            $query->where('url', 'LIKE', '%' . $this->request->get('url') . '%');
        }
        if ($this->request->get('method')) {
            $query->where('method', $this->request->get('method'));
        }
        if ($this->request->get('ip')) {
            $query->where('ip', 'LIKE', '%' . $this->request->get('ip') . '%');
        }
        if ($this->request->get('user_id')) {
            $query->where('user_id', $this->request->get('user_id'));
        }

        if ($this->request->get('search')) {
            $query->where(function ($query) {
                $query->orWhere('method', 'LIKE', '%' . $this->request->get('search') . '%');
                $query->orWhere('session', 'LIKE', '%' . $this->request->get('search') . '%');
                $query->orWhere('request', 'LIKE', '%' . $this->request->get('search') . '%');
                $query->orWhere('data', 'LIKE', '%' . $this->request->get('search') . '%');
                $query->orWhere('remarks', 'LIKE', '%' . $this->request->get('search') . '%');
                $query->orWhere('user_id', 'LIKE', '%' . $this->request->get('search') . '%');
                $query->orWhere('ip', 'LIKE', '%' . $this->request->get('search') . '%');
            });
        }

        $this->loggers = $query->paginate($paginate);
    }

    public function filter($params = [])
    {
        $params['l_filters'] = 1;
        $url = $this->request->url();
        $url .= '?';
        $url .= http_build_query(
            array_merge($this->request->except(['page', 'id']), $params)
        );
        return $url;
    }

    public function render()
    {
        return View::first(['components.aloggers.index', 'alogger::components.aloggers.index']);
    }
}
