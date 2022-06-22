<?php
require_once __DIR__."/../../vendor/autoload.php";
class Database
{

	// database configuration parameters
	private array $connectionParams = [
        'dbname' => 'be_famus',
        'user' => 'root',
        'password' => '',
        'host' => 'localhost',
        'driver' => 'pdo_mysql',
    ];
	private Doctrine\DBAL\Connection $conn;
    private Doctrine\ORM\EntityManager $entityManager;

    public function __construct()
    {
        $this->conn = Doctrine\DBAL\DriverManager::getConnection($this->connectionParams);

        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $path = [__DIR__ . '/../../src/Models'];
        $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($path, $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);    

		// obtaining the entity manager
		$this->entityManager = Doctrine\ORM\EntityManager::create($this->conn, $config);

    }

	public function getEntityManager() {
		return $this->entityManager;
	}

}