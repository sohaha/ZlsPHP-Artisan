<?php

namespace Zls\Artisan;

use Z;

/**
 * Artisan
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
abstract class Artisan extends \Zls_Task
{
    use Command;

    abstract public function execute(\Zls_CliArgs $args);


    //命令缺省执行

    public function help(\Zls_CliArgs $args)
    {
        $key = $args->get(2);
        echo self::helpText(get_class($this), $key);
    }

    public static function helpText($class = null, $name = null)
    {
        /** @var self $artisan */
        $artisan = Z::factory($class);
        $title = $artisan->title();
        if ($title) {
            $printText[] = '';
            $printText[] = self::getColoredString($artisan->title() . ':', 'green') . self::getColoredString(' php zls artisan ' . $name, 'light_purple');
            if ($introduction = $artisan->introduction()) {
                $printText[] = self::getColoredString($introduction, 'light_gray');
            }
            if ($options = $artisan->options()) {
                $printText[] = self::getColoredString('  Options:', 'cyan');
                foreach ($options as $value) {
                    $printText[] = self::getColoredString('    ' . $value, 'cyan');
                }
            }
            if ($example = $artisan->example()) {
                $printText[] = self::getColoredString('  Example:', 'dark_gray');
                foreach ($example as $value) {
                    $printText[] = self::getColoredString('    ' . $value, 'dark_gray');
                }
            }
            $printText[] = '';

            return join($printText, PHP_EOL);
        }

        return PHP_EOL . self::getColoredString('Artisan ' . $name . ':', 'green') . self::getColoredString(' No instructions', 'dark_gray') . PHP_EOL;
    }

    /**
     * 命令名称
     * @return string
     */
    abstract public function title();

    /**
     * 命令介绍
     * @return string
     */
    public function introduction()
    {
        return '';
    }

    /**
     * 命令配置
     * @return array
     */
    public function options()
    {
        return [];
    }

    /**
     * 命令示例
     * @return array
     */
    public function example()
    {
        return [];
    }

}
