<?php

class Aoe_BlackHoleSession_Model_SessionHandler implements SessionHandlerInterface
{
    protected static $sessionData = [];

    public function close()
    {
        return true;
    }

    public function destroy($session_id)
    {
        unset(self::$sessionData[$session_id]);
        return true;
    }

    public function gc($maxlifetime)
    {
        return true;
    }

    public function open($save_path, $name)
    {
        return true;
    }

    public function read($session_id)
    {
        return self::$sessionData[$session_id];
    }

    public function write($session_id, $session_data)
    {
        self::$sessionData[$session_id] = $session_data;
        return true;
    }

    public function setHandler()
    {
        session_set_save_handler(
            array($this, "open"),
            array($this, "close"),
            array($this, "read"),
            array($this, "write"),
            array($this, "destroy"),
            array($this, "gc")
        );
    }

}