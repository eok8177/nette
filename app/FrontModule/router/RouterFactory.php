<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\SimpleRouter;


class RouterFactory
{

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;

		$router[] = new Route('/blog/<action>[/<id>]', 'Front:Post:Show');

		$router[] = new Route('<presenter>/<action>[/<id>]', 'Front:Default:Default');
		return $router;
	}

}
