<?php

declare(strict_types=1);

namespace Anker\OpenGraphBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Anker\OpenGraphBundle\OpenGraphBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function getBundles(ParserInterface $parser): array
	{
		return [
			BundleConfig::create(OpenGraphBundle::class)
				->setLoadAfter([ContaoCoreBundle::class])
				->setReplace(['opengraph']),
		];
	}
}
