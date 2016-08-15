<?php

class Aoe_BlackHoleSession_Model_Session extends Mage_Core_Model_Session
{

    protected $isBot = false;

    public function __construct(array $data)
    {
        parent::__construct($data);
        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $config = Mage::getConfig()->getNode('global/aoeblackholesession');
            $botRegex = (string) $config->descend('bot_regex');
            if (preg_match($botRegex, $_SERVER['HTTP_USER_AGENT'])) {
                $this->isBot = true;
            }
        }
    }

    public function getSessionSaveMethod()
    {
        if ($this->isBot) {
            return 'user';
        } else {
            return parent::getSessionSaveMethod();
        }
    }

    public function getSessionSavePath()
    {
        if ($this->isBot) {
            $sessionHandler = Mage::getModel('aoeblackholesession/sessionHandler'); /* @var $sessionHanlder Aoe_BlackHoleSession_Model_SessionHandler */
            return array($sessionHandler, 'setHandler');
        } else {
            return parent::getSessionSavePath();
        }
    }

}