<?php
	include realpath(dirname(__FILE__)) . '/objectid.php';

	date_default_timezone_set('America/Sao_Paulo');

	$factory = new ObjectIdFactory();

	for ($i = 1; $i <= 20; $i++) {
		echo "Testing 20 ids\n";
	    echo $factory->getNewId();
	    echo "\n";
	}
	echo "Force getting an id with increment 1\n";
	echo $factory->getNewId(1);
	echo "\n";
	