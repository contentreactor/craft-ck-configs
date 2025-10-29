<?php

namespace contentreactor\craftckconfigs\web\assets\typography;

use Craft;
use craft\web\AssetBundle;

/**
 * Typography asset bundle
 */
class TypographyAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/dist';
    public $depends = [];
    public $js = [];
    public $css = [];
}
