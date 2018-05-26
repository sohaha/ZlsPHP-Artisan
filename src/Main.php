<?php

namespace Zls\Artisan;
use Z;

/**
 * Artisan
 * @author        影浅-Seekwe
 * @email       seekwe@gmail.com
 * @updatetime    2017-2-27 16:52:51
 */
class Main extends Command {
    private $args = [];

    private $artisans = [
        'start'  => '\Zls\Artisan\Start',
        'create' => '\Zls\Artisan\Create',
    ];

    public function title() {

    }

    public function options() {

    }
    public function example() {

    }

    public function execute(\Zls_CliArgs $args) {

    }

    public function help(\Zls_CliArgs $args) {
        if ($args->get('color')) {
            self::color();
            z::finish();
        }
        $printText   = [''];
        $printText[] = parent::getColoredString('ZlsPHP the built-in command!', 'white', 'green');
        $printText[] = '';
        echo join($printText, PHP_EOL);
        $artisans = array_merge($this->artisans, Z::config()->getArtisans());
        foreach ($artisans as $key => $value) {
            echo parent::helpText($value, $key) ;
        }
    }

    private static function color() {
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
