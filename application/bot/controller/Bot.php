<?php
namespace zzcms\bot\controller;

use think\Request;
use zzcms\bot\model\BotLog;

class Bot
{

    public function bot(Request $request)
    {
        $param = $request->param();
        $useragent = strtolower($param['code']);
        $cache = getCache('bot');
        foreach ($cache as $item) {
            if (false !== strpos($useragent, $item['tag'])) {
                $data = [];
                $data['bot_id'] = $item['id'];
                $data['agent'] = $useragent;
                $data['url'] = $param['url'];
                $data['ip'] = $request->ip();
                $data['create_time'] = time();
                BotLog::getInstance()->addData($data);
                return array2json(['code' => 1]);
            }
        }
        return array2json(['code' => 0]);
    }


}
