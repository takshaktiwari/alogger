<?php

namespace Takshak\Alogger\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Takshak\Alogger\Models\Logger;

class Alogger
{
    public $request;
    public $str;
    public $logger;

    public function __construct($request)
    {
        $this->request = $request;
        $this->str = new Str;
    }

    public function log($user_id=null, $url=null, $data=null, $remarks=null)
    {
        if(!config('alogger.log', true)){
            return false;
        }

        $this->logger = Logger::create([
            'user_id'   =>  $this->getUserId($user_id),
            'ip'        =>  $this->getIp(),
            'url'       =>  $this->getUrl($url),
            'method'    =>  $this->getMethod(),
            'session'   =>  $this->getSession(),
            'request'   =>  $this->getRequest(),
            'data'      =>  $data,
            'remarks'   =>  $remarks
        ]);

        return $this;
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
        $user_id = $user_id ? $user_id : auth()->id();
        return in_array($user_id, config('alogger.record.user_id.except', [])) ? null : $user_id;
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
        $sessions = session()->all();
        foreach (config('alogger.record.session.except', []) as $key) {
            unset($sessions[$key]);
        }

        return $sessions;
    }

    public function getRequest()
    {
        $requests = $this->request->all();
        foreach (config('alogger.record.session.except', []) as $key) {
            unset($requests[$key]);
        }

        return $requests;
    }
}
