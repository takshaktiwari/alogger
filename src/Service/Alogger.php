<?php

namespace Takshak\Alogger\Service;
use Illuminate\Support\Str;
use Takshak\Alogger\Models\Logger;

class Alogger
{
    public $request;
    public $str;
    public $remarks;
    public $data;
    public $logger;
    public $user_id;

    public function __construct($request)
    {
        $this->request = $request;
        $this->str = new Str;
    }

    public function remarks($remarks, $data = null)
    {
        $this->remarks = $remarks;
        $this->data = $data;
        return $this;
    }
    public function activity($activity, $data = null)
    {
        $this->remarks($activity, $data);
        return $this;
    }

    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    public function user($user)
    {
        $this->user_id = is_integer($user) ? $user : $user?->id;
        return $this;
    }

    public function log($user_id = null, $url = null, $data = null, $remarks = null)
    {
        if (!$this->allowLog()) {
            return false;
        }

        $this->data = $data ? $data : $this->data;
        $this->remarks = $remarks ? $remarks : $this->remarks;

        $this->logger = Logger::create([
            'user_id'   =>  $this->getUserId($user_id),
            'ip'        =>  $this->getIp(),
            'url'       =>  $this->getUrl($url),
            'method'    =>  $this->getMethod(),
            'session'   =>  $this->getSession(),
            'request'   =>  $this->getRequest(),
            'data'      =>  $this->data,
            'remarks'   =>  $this->remarks
        ]);

        return $this;
    }

    public function allowLog()
    {
        $allow = true;
        if (!config('alogger.log', true) || request()->get('l_filters')) {
            $allow = false;
        }

        $allow = $this->str->of($this->request->fullUrl())->contains(config('alogger.except.matches', [])) ? false : true;
        if ($allow) {
            $allow = in_array($this->request->fullUrl(), config('alogger.except.urls', [])) ? false : true;
        }

        if ($allow) {
            $allow = $this->request->get('l_filters') ? false : true;
        }
        return $allow;
    }

    public function getUrl($url=null)
    {
        $url = $url ? $url : $this->request->fullUrl();

        $url = $this->str->of($url)->contains(config('alogger.record.url.except', [])) ? null : $url;

        if (!$url) {
            return null;
        }

        $url = $this->str->of($url)->after(url('/'));
        if(!$this->str->of($url)->startsWith('/')){
            $url = '/'.$url;
        }

        return $url;
    }

    public function getUserId($user_id=null)
    {
        $this->user_id = $user_id ? $user_id : $this->user_id;
        if (!$this->user_id) {
            $this->user_id = auth()->id();
        }
        return in_array($this->user_id, config('alogger.record.user_id.except', [])) ? null : $this->user_id;
    }

    public function getIp()
    {
        $ip = $this->request->ip();
        if ($this->str->of($ip)->contains(config('alogger.record.ip.except', []))) {
            return null;
        }

        return $ip;
    }

    public function getLogger()
    {
        return $this->logger;
    }

    public function getMethod()
    {
        $method = $this->request->method();
        if ($this->str->of($method)->contains(config('alogger.record.method.except', []))) {
            return null;
        }

        return $method;
    }

    public function getSession()
    {
        $sessions = array_filter(session()->all(), function ($key) {
            return $this->str->of($key)->contains('login_web') ? false : true;
        }, ARRAY_FILTER_USE_KEY);

        foreach (config('alogger.record.session.except', ['_token']) as $key) {
            unset($sessions[$key]);
        }

        $sessions = array_filter($sessions, function ($item) {
            if (is_array($item)) {
                return count($item) ? true : false;
            }
            return true;
        });

        $sessions = array_map(function ($item) {
            if ($item instanceof \Illuminate\Database\Eloquent\Collection) {
                return $item->toArray();
            }
        }, $sessions);

        return $sessions;
    }

    public function getRequest()
    {
        $requests = $this->request->all();
        foreach (config('alogger.record.session.except', ['_token']) as $key) {
            unset($requests[$key]);
        }

        return $requests;
    }
}
