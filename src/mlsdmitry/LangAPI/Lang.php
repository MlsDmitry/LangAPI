<?php


namespace mlsdmitry\LangAPI;


use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\Config;

class Lang
{
    private const DEFAULT_LANGUAGE = 'en_US';

    /** @var Plugin $plugin */
    public $plugin;

    /** @var Config $lang */
    private static $lang;

    /** @var array $languages */
    public static $languages = [];

    public function __construct(Plugin $plugin)
    {
        if (!file_exists($plugin->getDataFolder() . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR))
            mkdir($plugin->getDataFolder() . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR);
        $pattern = $plugin->getDataFolder() . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . '*.{yml,json}';
        foreach (glob($pattern, GLOB_BRACE) as $path) {
            $name = basename($path, '.yml');
            $extension = pathinfo($name, PATHINFO_EXTENSION) == 'json' ? Config::JSON : Config::YAML;
            self::$languages[$name] = new Config($path, $extension);
        }
//        if ($plugin->getConfig()->exists('lang')) {
//            $lang = $plugin->getConfig()->get('lang');
//            if (!isset(self::$languages[$lang]))
//                self::$lang = self::$languages[self::DEFAULT_LANGUAGE];
//            else
//                self::$lang = self::$lang[$lang];
//        }

    }

    public static function get($key, $replaceable = [], Player $p = null)
    {
        $lang = $p === null ? self::$lang : $p->namedtag->getString('lang');
        if (!isset(self::$languages[$lang]))
            $lang = self::$lang;
        $message = self::$languages[$lang]->get($key);
        foreach ($replaceable as $id => $replacement) {
            $message = str_replace(sprintf('{%s}', $id), $replacement, $message);
        }
        return $message;
    }

}