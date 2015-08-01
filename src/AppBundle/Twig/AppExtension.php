<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 25-07-15
 * Time: 02:33
 */

namespace AppBundle\Twig;


class AppExtension extends \Twig_Extension
{
	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter('getMeThisContent', array($this, 'getMeThisContent')),
		);
	}

	public function getMeThisContent($raw_url = 'git.io/vYRVw')
	{
		$contents = file_get_contents($raw_url);

		return $contents;
	}

	public function getName()
	{
		return 'app_extension';
	}
}
