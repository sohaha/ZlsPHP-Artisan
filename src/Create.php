<?php

namespace Zls\Artisan;

use z;

/**
 * Create
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
class Create extends Artisan
{
    const CREATE_CLASS_NAME = 'Zls\Artisan\Create\Common';
    private $args = [];

    public function title()
    {
        return 'Code Factory';
    }

    public function options()
    {
        return [
            '-name  FileName',
            '-type  Create type [controller,business,model,task,dao,bean]',
            '-db    Database Config Name',
            '-env   Environment',
            '-force Overwrite old files',
            '-hmvc  Hmvc Name',
        ];
    }

    public function example()
    {
        return [
            'create controller:   php zls artisan create:controller -name controllerName',
            'create business:     php zls artisan create:business -name businessName',
            'create task:         php zls artisan create:task -name taskName',
            'create dao:          php zls artisan create:dao -name Zls -table tableName',
            'create dao and bean: php zls artisan create:dao:bean -name Zls -table tableName',
            '...',
        ];
    }

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

    public function __call($name,$args)
    {
        call_user_func_array([z::factory(self::CREATE_CLASS_NAME), 'creation'], $this->getArgs($args[0], $name));
    }
}
