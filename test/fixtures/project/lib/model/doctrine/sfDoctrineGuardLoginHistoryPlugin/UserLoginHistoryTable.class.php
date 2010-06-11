<?php


class UserLoginHistoryTable extends PluginUserLoginHistoryTable
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('UserLoginHistory');
    }
}