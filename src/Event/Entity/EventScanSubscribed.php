<?php

namespace Thenbsp\Wechat\Event\Entity;

use Thenbsp\Wechat\Event\Entity;

class EventScanSubscribed extends Entity
{
    /**
     * 扫描带参数的二维码时，提交参数格式为 "SCENE_参数值"，
     * 为了方便获取参数值，手动添加了一个参数叫 "EventKeyValue"
     * 该参数仅在 EventScanSubscribe 和 EventScanSubscribed 事件中可用
     */
    public function __construct(array $options = array())
    {
        if( array_key_exists('EventKey', $options) ) {
            $options['EventKeyValue'] = mb_substr($options['EventKey'], 6);
        }

        parent::__construct($options);
    }

    public function isValid()
    {
        return ($this['MsgType'] === 'event')
            && ($this['Event'] === 'SCAN')
            && $this->containsKey('EventKey');
    }
}
