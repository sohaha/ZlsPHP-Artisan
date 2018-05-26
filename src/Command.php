<?php

namespace Zls\Artisan;
use Z;

/**
 * Artisan
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
abstract class Command extends \Zls_Task {

    private static $colors   = [];
    private static $bgColors = [];

    public function __construct() {
        parent::__construct();
        self::$colors['black']        = '0;30';
        self::$colors['dark_gray']    = '1;30';
        self::$colors['blue']         = '0;34';
        self::$colors['light_blue']   = '1;34';
        self::$colors['green']        = '0;32';
        self::$colors['light_green']  = '1;32';
        self::$colors['cyan']         = '0;36';
        self::$colors['light_cyan']   = '1;36';
        self::$colors['red']          = '0;31';
        self::$colors['light_red']    = '1;31';
        self::$colors['purple']       = '0;35';
        self::$colors['light_purple'] = '1;35';
        self::$colors['brown']        = '0;33';
        self::$colors['yellow']       = '1;33';
        self::$colors['light_gray']   = '0;37';
        self::$colors['white']        = '1;37';
        self::$bgColors['black']      = '40';
        self::$bgColors['red']        = '41';
        self::$bgColors['green']      = '42';
        self::$bgColors['yellow']     = '43';
        self::$bgColors['blue']       = '44';
        self::$bgColors['magenta']    = '45';
        self::$bgColors['cyan']       = '46';
        self::$bgColors['light_gray'] = '47';
    }

    abstract public function title();
    abstract public function example();
    abstract public function options();
    abstract public function execute(\Zls_CliArgs $args);

    public static function getColoredString($string, $color = null, $bgColor = null) {
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

    public static function getColors() {
        return self::$colors;
    }

    public static function getBgColors() {
        return self::$bgColors;
    }

    public static function helpText($class = null, $name = null) {
        $artisan = Z::factory($class);
        $title   = $artisan->title();
        if ($title) {
            $printText[] = '';
            $printText[] = self::getColoredString($artisan->title() . ':', 'green') . self::getColoredString(' php zls artisan ' . $name, 'light_purple');
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

    public function error($err, $color = 'light_red') {
        return self::getColoredString('[ Error ]', 'white', 'red') . PHP_EOL . self::getColoredString($err, $color);
    }

    public function success($err, $color = 'green') {
        return self::getColoredString('[ Successfull ]', 'white', 'green') . PHP_EOL . self::getColoredString($err, $color);
    }

    public function help(\Zls_CliArgs $args) {
        $key = $args->get(2);
        echo self::helpText(get_class($this), $key);
    }

}
