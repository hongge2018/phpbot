<?php
namespace app\index\controller;


class Bot
{
    public function index()
    {
        return '';
    }

    public function bot()
    {
        return array2json(['code' => app('request')->param()]);
    }
}
