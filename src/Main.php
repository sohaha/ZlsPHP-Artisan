<?php

namespace Zls\Artisan;

use z;

/**
 * Artisan
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
class Main extends Command
{
    private $args = [];

    public function help(\Zls_CliArgs $args, $errText = '')
    {
        if ($args->get('color')) {
            $this->color();
            z::finish();
        }
        $printText = [''];
        $printText[] = parent::getColoredString('ZlsPHP the built-in command!', 'white', 'green');
        $printText[] = '';
        $printText[] = parent::getColoredString('Quick Start:', 'green', '') . parent::getColoredString(' php zls artisan start', 'light_purple', '');
        $printText[] = parent::getColoredString('    Options:', 'cyan', '');
        $printText[] = parent::getColoredString('      -host  Listening IP', 'cyan', '');
        $printText[] = parent::getColoredString('      -port  Listening Port', 'cyan', '');
        $printText[] = '';
        $printText[] = parent::getColoredString('Code Factory:', 'green', '') . parent::getColoredString(' php zls artisan create ', 'light_purple', '') . 'xxx(file name)';
        $printText[] = parent::getColoredString('    Options:', 'cyan', '');
        $printText[] = parent::getColoredString('      -name  FileName', 'cyan', '');
        $printText[] = parent::getColoredString('      -type  Create type [controller,business,model,task,dao,bean]', 'cyan', '');
        $printText[] = parent::getColoredString('      -db    Database Config Name', 'cyan', '');
        $printText[] = parent::getColoredString('      -env   Environment', 'cyan', '');
        $printText[] = parent::getColoredString('      -force Overwrite old files', 'cyan', '');
        $printText[] = parent::getColoredString('    Example:', 'dark_gray', '');
        $printText[] = parent::getColoredString('    create controller: php zls artisan create:controller -name controllerName', 'dark_gray', '');
        $printText[] = parent::getColoredString('    create business: php zls artisan create:business -name businessName', 'dark_gray', '');
        $printText[] = parent::getColoredString('    create task: php zls artisan create:task -name taskName', 'dark_gray', '');
        $printText[] = parent::getColoredString('    create dao: php zls artisan create:dao -name Zls -table tableName', 'dark_gray', '');
        $printText[] = parent::getColoredString('    ...', 'dark_gray', '');
        $printText[] = '';
        echo join($printText, PHP_EOL);
        if ($errText) {
            echo PHP_EOL . parent::getColoredString($errText, 'white', 'red') . PHP_EOL;
        }
        echo <<<EC
EC;
    }

    private function color()
    {
        $fgs = parent::getColors();
        $bgs = parent::getBgColors();
        foreach ($fgs as $i => $v) {
            echo parent::getColoredString(str_pad($i, 10, ' '), $i) . "\t";
            if (isset($bgs[$i])) {
                echo parent::getColoredString($i, null, $i);
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
        foreach ($fgs as $fg => $v) {
            foreach ($bgs as $bg => $vv) {
                echo parent::getColoredString(str_pad("Text:{$fg}+Bg:{$bg}", 50, ' '), $fg, $bg) . PHP_EOL;
            }
        }
    }
}
