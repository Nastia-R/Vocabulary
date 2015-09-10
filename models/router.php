<?php
namespace Models;

class Router {

	public function getUrl($route, $parameters = array())
	{
		$routes = array(
			'wordAdd'=>'index.php?page=wordAdd',
			'wordDelete'=>'index.php?page=wordDelete',
			'wordEdit'=>'index.php?page=wordEdit',
			'userDelete'=>'index.php?page=userDelete',
			'userEdit'=>'index.php?page=userEdit',
			'wordRandom'=>'index.php?page=wordRandom',
			'main'=>'index.php',
			'usersList'=>'index.php?page=usersList',
			'revise'=>'index.php?page=revise',
			'authorisation'=>'index.php?page=authorisation',
			'registration'=>'index.php?page=registration'
			);

		if(array_key_exists($route, $routes))
		{
			if(!empty($parameters))
			{
				return $routes[$route].'&'.http_build_query($parameters);
			}
			return $routes[$route];
		}
		else
		{
			return 'index.php';
		}
	}
}