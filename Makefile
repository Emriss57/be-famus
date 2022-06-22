serverOn:
 	php -S localhost:8000 -t public
	 
reset:
	vendor/bin/doctrine orm:schema-tool:drop --force
	vendor/bin/doctrine orm:schema-tool:create

fixtures: 
	php src/Fixture/categorie.fixture.php ORM
	php src/Fixture/role.fixture.php ORM
	php src/Fixture/user.fixture.php ORM
	php src/Fixture/adress.fixture.php ORM


	
