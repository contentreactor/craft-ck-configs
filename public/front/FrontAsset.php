<?php

namespace contentreactor\craftckconfigs\web\assets\front;

use contentreactor\craftckconfigs\web\assets\typography\TypographyAsset;
use Craft;
use craft\web\AssetBundle;

/**
 * Front asset bundle
 */
class FrontAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/dist';
    public $depends = [
        TypographyAsset::class,
    ];
    public $js = [];
    public $css = [];
}
