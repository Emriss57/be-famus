<?php

class RouteAnnotationsReader {

	private const __ROUTE_ANNOTATION__ = "@Route";

	public function read($clazz) : array {
		$routes = [];

		try {
			$name = get_class($clazz);
			$rc = new ReflectionClass($name);
			$methods = $rc->getMethods();

			$meta = $this->parseAnnotation($rc->getDocComment());
			$this->getRoutes($meta, $methods, $routes);
		} catch (ReflectionException $e) {
			if (__DEBUG__) {
				var_dump($e);
			}
		}

		return $routes;
	}


	/**
	 * @param string $annotation
	 * @return mixed
	 */
	private function parseAnnotation(string $annotation)
	{
		$begin = strpos($annotation, self::__ROUTE_ANNOTATION__);

		if ($begin === false) {
			return false;
		}

		$end = strpos($annotation, ')', $begin);
		$routeAnnotation = substr($annotation, $begin, $end - $begin + 1);
		$args = [];

		if (!empty(trim($routeAnnotation))) {
			$beg = strlen(self::__ROUTE_ANNOTATION__) + 1;
			$argsString = substr($routeAnnotation, $beg, strlen($routeAnnotation) - $beg - 1);

			foreach (explode(',', $argsString) as $arg) {
				[$k, $v] = explode('=', trim($arg));
				$args += [$k => $v];
			}

		}

		return array_filter([
			'method' => key_exists('method', $args) ? substr($args['method'], 1, -1) : false,
			'path' => key_exists('path', $args) ? substr($args['path'], 1, -1) : false,
			'name' => key_exists('name', $args) ? substr($args['name'], 1, -1) : false,
		]);
	}

	/**
	 * @param $meta
	 * @param array $methods
	 * @param array $routes
	 */
	private function getRoutes($meta, array $methods, array &$routes): void
	{
		$prefixPath = '';
		$prefixName = '';

		if ($meta !== false) {
			$prefixPath = key_exists('path', $meta) ? trim($meta['path']) : '';
			$prefixName = key_exists('name', $meta) ? trim($meta['name']) : '';
		}

		foreach ($methods as $method) {
			$dc = $method->getDocComment();
			$data = $this->parseAnnotation($dc);

			if ($data !== false) {
				$current = array_merge($data, ['action' => $method]);

				if (!empty($prefixPath) && !empty($current['path'])) {
					$current['path'] = $prefixPath . $current['path'];
				}

				if (!empty($prefixPath) && !empty($current['name'])) {
					$current['name'] = $prefixName . $current['name'];
				}

				$routes[] = $current;
			}
		}
	}

}
