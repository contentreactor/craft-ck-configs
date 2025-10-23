<?php

namespace contentreactor\craftckconfigs;

use contentreactor\craftckconfigs\services\Config;
use contentreactor\craftckconfigs\traits\Services;
use Craft;
use craft\base\Event;
use craft\base\Plugin as BasePlugin;
use craft\services\Plugins;

/**
 * ContentReactor CK Configs plugin
 *
 * @method static Plugin getInstance()
 * @author ContentReactor <dusan@contentreactor.at>
 * @copyright ContentReactor
 * @license MIT
 */
class Plugin extends BasePlugin
{
	use Services;

	public string $schemaVersion = '1.0.0';

	public static function config(): array
	{
		return [
			'components' => [
				'config' => Config::class,
			],
		];
	}

	public function init(): void
	{
		parent::init();

		$this->attachEventHandlers();

		// Any code that creates an element query or loads Twig should be deferred until
		// after Craft is fully initialized, to avoid conflicts with other plugins/modules
		Craft::$app->onInit(function () {
			// ...
		});
	}

	private function attachEventHandlers(): void
	{
		Event::on(
			Plugins::class,
			Plugins::EVENT_AFTER_INSTALL_PLUGIN,
			function ($event) {
				Craft::$app->getPlugins()->installPlugin('cke-shy');
				$this->getConfig()->generateAllConfigs();
			}
		);

		//for development only
		// Event::on(
		// 	Plugins::class,
		// 	Plugins::EVENT_AFTER_UNINSTALL_PLUGIN,
		// 	function ($event) {
		// 		Craft::$app->getPlugins()->uninstallPlugin('cke-shy');
		// 		$this->getConfig()->removeCkConfigs();
		// 	}
		// );
	}
}
