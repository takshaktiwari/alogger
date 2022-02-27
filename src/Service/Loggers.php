<?php

namespace Takshak\Alogger\Service;

use Takshak\Alogger\Models\Logger;

class Loggers
{
    public $loggers;
    public function __construct()
    {
        $this->loggers = new Logger();
    }

    public function user($user)
    {
        $user_id = is_integer($user) ? $user : $user->id;
        $this->loggers = $this->loggers->where('user_id', $user_id);
        return $this;
    }

    public function ip($ip = null)
    {
        $this->loggers = $this->loggers->where('ip', $ip);
        return $this;
    }

    public function method($method)
    {
        $this->loggers = $this->loggers->where('method', $method);
        return $this;
    }

    public function url($url, $operator = null)
    {
        if ($operator) {
            $this->loggers = $this->loggers->where('url', $operator, $url);
        } else {
            $this->loggers = $this->loggers->where('url', $url);
        }
        return $this;
    }

    public function session($session, $operator = 'LIKE', $wild = 'both')
    {
        $this->filter('session', $session, $operator, $wild);
        return $this;
    }

    public function request($request, $operator = 'LIKE', $wild = 'both')
    {
        $this->filter('request', $request, $operator, $wild);
        return $this;
    }

    public function data($data, $operator = 'LIKE', $wild = 'both')
    {
        $this->filter('data', $data, $operator, $wild);
        return $this;
    }

    public function remarks($remarks, $operator = 'LIKE', $wild = 'both')
    {
        $this->filter('remarks', $remarks, $operator, $wild);
        return $this;
    }

    public function filter($column, $search, $operator, $wild)
    {
        if ($operator) {
            if (strtolower($operator) == 'like') {
                $match = $search;
                if ($wild == 'left') {
                    $match = '%' . $search;
                } elseif ($wild == 'right') {
                    $match = $search . '%';
                } else {
                    $match = '%' . $search . '%';
                }
                $this->loggers = $this->loggers->where($column, 'LIKE', $match);
                return $this;
            }

            $this->loggers = $this->loggers->where($column, $operator, $search);
            return $this;
        }

        $this->loggers = $this->loggers->where($column, $search);
        return $this;
    }

    public function last()
    {
        $this->loggers = $this->loggers->latest()->limit(1);
        return $this;
    }

    public function models()
    {
        return $this->loggers;
    }

    public function get()
    {
        return $this->loggers->get();
    }

    public function paginate($count)
    {
        return $this->loggers->paginate($count);
    }

    public function first()
    {
        return $this->loggers->first();
    }
}
