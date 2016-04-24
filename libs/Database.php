<?php

class Database extends PDO
{

	public function __construct($db_type,$db_host,$db_name,$db_user,$db_pass) {
		parent::__construct($db_type.':host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
	}

}
