<?php
/**
 * Generator for Mongo-like ObjectIds in pure PHP
 * Author: Mauricio Piacentini
 *
 * Inspired by https://github.com/justaprogrammer/ObjectId.js
 *
 */

class ObjectIdFactory
{   
    private $_datetime = null;
    private $_machine = null;
    private $_pid = null;
    private $_increment = null;

    public function __construct()
    {
        $this->_machine = str_pad(dechex(rand(0, 16777215)), 6, "0", STR_PAD_LEFT);
        $this->_pid = str_pad(dechex(rand(0, 32767)), 4, "0", STR_PAD_LEFT);
        $this->_increment = rand(0, 16777215);

        //We need a DateTime object to get timestamps, cache it
        $this->_datetime = new DateTime();
    }
    
    public function getNewId($forcedincrement = null)
    {
        if (is_null($forcedincrement)) {
            $this->_increment++;
            if ($this->_increment > 0xffffff) {
                $this->_increment = 0;
            }
        } else {
            $this->_increment = $forcedincrement;
        }
        $timestamp = $this->_datetime->getTimestamp();

        $timestamp_final = str_pad(dechex($timestamp), 8, "0", STR_PAD_LEFT);
        $increment_final = str_pad(dechex($this->_increment), 6, "0", STR_PAD_LEFT);
        return $timestamp_final . $this->_machine . $this->_pid . $increment_final;
    }
    
}
