<?php

namespace Zls\Artisan;

use z;

/**
 * Create
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
class Create extends Command
{
    const CREATE_CLASS_NAME = 'Zls\Artisan\Create\Common';
    private $args = [];

    public function execute(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args);
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }

    private function getArgs(\Zls_CliArgs $args, $type = '')
    {
        $name = $args->get('name');
        $type = $type ?: strtolower($args->get('type'));
        if (empty($name)) {
            Z::finish(parent::getColoredString('name required , please use : -name FileName', 'red'));
        }
        if (empty($type)) {
            Z::finish(parent::getColoredString('type required, please use : -type [controller,business,model,task,dao,bean]', 'red'));
        }
        $force = $args->get('force', $args->get('f'));
        $style = $args->get('style');
        $table = $args->get('table');
        $dbGroup = $args->get('db');
        $hmvc = $args->get('hmvc');
        $argc = [$name, $type, $table, $hmvc, $dbGroup, $force, $style];

        return $argc;
    }

    public function model(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args, 'model');
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }

    public function task(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args, 'task');
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }

    public function business(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args, 'business');
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }

    public function bean(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args, 'bean');
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }

    public function dao(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args, 'dao');
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }

    public function controller(\Zls_CliArgs $args)
    {
        list($name, $type, $table, $hmvc, $dbGroup, $force, $style) = $this->getArgs($args, 'controller');
        z::factory(self::CREATE_CLASS_NAME)->creation($name, $type, $table, $hmvc, $dbGroup, $force, $style);
    }
}
