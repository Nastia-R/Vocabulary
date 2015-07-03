<?php
namespace Models;

class Router {

	public function getUrl($route, $parameters = array())
	{
		$routes = array(
			'add-word'=>'index.php?page=add-word',
			'word-delete'=>'index.php?page=word-delete',
			'word-edit'=>'index.php?page=word-edit',
			'user-delete'=>'index.php?page=user-delete',
			'user-edit'=>'index.php?page=user-edit',
			'randomWord'=>'index.php?page=randomWord',
			'main'=>'index.php',
			'userList'=>'index.php?page=userList',
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