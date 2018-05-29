<?php

namespace Zls\Artisan;

/**
 * Artisan
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
trait Command
{
    private static $colors = [];
    private static $bgColors = [];

    public function __construct()
    {
        self::$colors['black'] = '0;30';
        self::$colors['dark_gray'] = '1;30';
        self::$colors['blue'] = '0;34';
        self::$colors['light_blue'] = '1;34';
        self::$colors['green'] = '0;32';
        self::$colors['light_green'] = '1;32';
        self::$colors['cyan'] = '0;36';
        self::$colors['light_cyan'] = '1;36';
        self::$colors['red'] = '0;31';
        self::$colors['light_red'] = '1;31';
        self::$colors['purple'] = '0;35';
        self::$colors['light_purple'] = '1;35';
        self::$colors['brown'] = '0;33';
        self::$colors['yellow'] = '1;33';
        self::$colors['light_gray'] = '0;37';
        self::$colors['white'] = '1;37';
        self::$bgColors['black'] = '40';
        self::$bgColors['red'] = '41';
        self::$bgColors['green'] = '42';
        self::$bgColors['yellow'] = '43';
        self::$bgColors['blue'] = '44';
        self::$bgColors['magenta'] = '45';
        self::$bgColors['cyan'] = '46';
        self::$bgColors['light_gray'] = '47';
    }


    public static function getColors()
    {
        return self::$colors;
    }

    public static function getBgColors()
    {
        return self::$bgColors;
    }

    public static function error($err, $color = 'light_red')
    {
        return self::getColoredString('[ Error ]', 'white', 'red') . PHP_EOL . self::getColoredString($err, $color);
    }

    public static function getColoredString($string, $color = 'green', $bgColor = null)
    {
        $colored_string = "";
        if (isset(self::$colors[$color])) {
            $colored_string .= "\033[" . self::$colors[$color] . "m";
        }
        if (isset(self::$bgColors[$bgColor])) {
            $colored_string .= "\033[" . self::$bgColors[$bgColor] . "m";
        }
        $colored_string .= $string . "\033[0m";

        return $colored_string;
    }

    public static function success($msg, $color = 'green')
    {
        return self::getColoredString('[ Successfull ]', 'white', 'green') . PHP_EOL . self::getColoredString($msg, $color);
    }

}
