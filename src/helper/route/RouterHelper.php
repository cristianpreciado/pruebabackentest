<?php
namespace zinobe\helper\route;

use zinobe\helper\route\RouteHelper;

class RouterHelper {

	protected $requestUri;
	protected $routes;

	const GET_PARAMS_DELIMITER = '?';

	public function __construct($requestUri)
	{
		$this->routes = [];

		$this->setRequestUri($requestUri);
	}

	public function setRequestUri($requestUri)
	{
		if (strpos($requestUri, self::GET_PARAMS_DELIMITER))
		{
			$requestUri = strstr($requestUri, self::GET_PARAMS_DELIMITER, true);
		}
		$this->requestUri = $requestUri;
	}

	public function getRequestUri()
	{
		return $this->requestUri;
	}

	public function add($uri, $closure)
	{
		$route = new RouteHelper($uri, $closure);
		array_push($this->routes, $route);
	}

	public function run()
	{
		$response = false;
		$requestUri = $this->getRequestUri();

		foreach ($this->routes as $route)
		{
			if ($route->checkIfMatch($requestUri))
			{
				$response = $route->execute();
				break;
			}
		}

		$this->sendResponse($response);
	}

	public function sendResponse($response)
	{
		if (is_string($response))
		{
			echo $response;
		}
		else if (is_array($response))
		{
			echo json_encode($response);
		}
		else if ($response instanceof Response)
		{
			$response->execute();
		}
		/* else
		{
			header("HTTP/1.0 404 Not Found");
			exit('404');
		} */
	}

}