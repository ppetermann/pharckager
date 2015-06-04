<?php
namespace Pharckager;

use Knight23\Core\Colors\Colors;

class Banner extends \Knight23\Core\Banner\Banner
{
    /**
     * @return string
     */
    public function getBanner()
    {
        $bannerText = <<<EOT
       _                    _
      | |                  | |
 _ __ | |__   __ _ _ __ ___| | ____ _  __ _  ___ _ __
| '_ \| '_ \ / _` | '__/ __| |/ / _` |/ _` |/ _ \ '__|
| |_) | | | | (_| | | | (__|   < (_| | (_| |  __/ |
| .__/|_| |_|\__,_|_|  \___|_|\_\__,_|\__, |\___|_|
| |                                    __/ |
|_|                                   |___/
EOT;

        $version = str_pad("Pharckager: ".Pharckager::VERSION, 55, " ", STR_PAD_BOTH);
        return Colors::COLOR_FG_RED.$bannerText.Colors::RESET."\n".Colors::COLOR_FGL_YELLOW.$version.Colors::RESET;
    }
}
