<?php
declare(strict_types=1);

namespace contentreactor\craftckconfigs\traits;

use contentreactor\craftckconfigs\services\Config;

/**
 * @mixin Plugin
 */
trait Services
{
	public function getConfig(): Config
	{
		return $this->get('config');
	}
}
