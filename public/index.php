<?php

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../src/Core/AbstractController.php');
require_once(__DIR__ . '/../src/Core/AbstractAdminController.php');
require_once(__DIR__ . '/../src/Core/AbstractUserController.php');
require_once(__DIR__ . '/../src/Core/Auth.php');
require_once(__DIR__ . '/../src/Core/AltoRouter.php');
require_once(__DIR__ . '/../src/Core/RouteAnnotationsReader.php');
require_once(__DIR__ . '/../src/Core/ExceptionHandlerController.php');
require_once(__DIR__ . '/../src/Core/Database.php');

class App {

    /**
     * @var AltoRouter
     */
	private AltoRouter $router;
	private RouteAnnotationsReader $reader;
	private ExceptionHandlerController $exceptionHandler;
	private array $globals;
	private Database $db;
	private $categories;
	private $manageSystem = 'admin';
	private Auth $auth;

	public function __construct()
	{
		session_start();
		$this->exceptionHandler = new ExceptionHandlerController();

		set_error_handler([$this->exceptionHandler, "errorHandler"]);
		set_exception_handler([$this->exceptionHandler, "displayException"]);
		$this->auth = new Auth();
		$this->db = new Database();
        $this->router = new AltoRouter();
		$this->reader = new RouteAnnotationsReader();
		$this->routes = [];
		$this->globals = [
			'global' => $this,
			'query' => $_GET,
			'body' => $_POST,
			'__VERSION__' => '1.0',
			'em' => $this->db->getEntityManager(),
			
		];

	    try {
			$this->loadModels();
		    $this->loadRoutes();
	    } catch (Exception $e) {
			throw $e;
	    }

		$this->categories = $this->db->getEntityManager()->getRepository('Categories')->findBy(['parent' => null]);
		
		$this->globals['app'] = [
			'name' => "Boutique en ligne",
			'categories' => $this->categories,
			'subCategories' => function ($cid) {
				return $this->db->getEntityManager()->getRepository('Categories')->findBy(['parent' => $cid]);
			}
		];
    }

	private function getFilesFrom(string $directory, array $display): array
	{
		$files = [];

		$it = new RecursiveDirectoryIterator($directory);
	    foreach(new RecursiveIteratorIterator($it) as $file) {
		    $fileInfos = explode('.', $file);
			if (in_array(strtolower(array_pop($fileInfos)), $display)) {
				$files[] = $file;
			}
		}

		return $files;
	}
	

    /**
     * Load route into AltoRouter
     *
     * @return void
     * @throws Exception
     */
    private function loadRoutes(): void
    {
		$directory_path = array();
	    $dir = (__DIR__ . '/../src/Controllers');
	    $display = ['php'];
		
		$its = scandir($dir);
		unset($its[0]);
		unset($its[1]);

	
		foreach($its as $directory) {
			$directory_path = $dir.'/'.$directory;
		

			foreach($this->getFilesFrom($directory_path, $display) as $file) {
				$dir_path = $file->getFileInfo()->getPath();
				$filePath = $dir_path.'/'.$file->getFileInfo()->getFileName();		
				
		 		require_once($filePath);
					
		 	 	$basename = basename($filePath, '.php');
			 	$fqcn = ucfirst($basename);
	 		 	$instance = (new $fqcn);
	 		 	$routes = $this->reader->read($instance);
				
		 		foreach ($routes as $route) {
		 	 		$method = $route['method'];
			 		$path = $route['path'];
	 		 		$target = [
	 		 			'instance' => $instance,
		 				'action' => $route['action']
		 	 		];
			 		$name = $route['name'];

	 		 		$this->router->map($method, $path, $target, $name);
		 		}
		 	}
		}
    }

	
    /**
     * Load models into Doctrine
     *
     * @return void
     * @throws Exception
     */
    private function loadModels(): void
    {
	    $dir = (__DIR__ . '/../src/Models');
	    $display = ['php'];

	    foreach($this->getFilesFrom($dir, $display) as $file) {
			require_once($file);
		}
	}

    /**
     * Process the current request
     *
     * @return void
     */
    public function process() : void {
          $match = $this->router->match();
		
          if (is_array($match)) {
			
		  	ob_start();
	          $target = $match['target'];
	          ($target['action'])->invoke($target['instance'], array_merge([
		          "params" => $match['params'],
              ], $this->globals));
		  	$content =  ob_get_clean ();
			  if($this->auth->allow('administrateur',$this->db->getEntityManager()) === true 
			  	&& strpos($match['name'],$this->manageSystem) !== false) {
				 require_once(__DIR__.'/../src/Views/layout/adminLayout/adminLayout.view.php');
			  } else {
				
				 require_once(__DIR__.'/../src/Views/layout/layout.view.php'); 
			  }
		  	
          } else {
              header("Location: /404");
          }
    }

	public function getRoutes() {
		return $this->router->getRoutes();
	}


}
(new App())->process();


