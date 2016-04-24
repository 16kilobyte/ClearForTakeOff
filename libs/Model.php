<?php

class Model
{

	public $time;
    public $ip;

	public function __construct() {
		// retructure and set redirect url
		$redirect_url = (isset($_GET['redirect_url'])) ? $_GET['redirect_url'] : ROOT_URL;
		$url = parse_url($redirect_url);
		if(@$url['scheme'] == 'https' || @$url['scheme'] == 'http') {
			$this->redirect_url = $redirect_url;
		} else {
			$this->redirect_url = ROOT_URL . $redirect_url;
		}

	    $this->ip = $_SERVER["REMOTE_ADDR"];

		//time handler
		$this->time = new DateTime();

		// instantiate database connection
		$this->db = new Database(db_type, db_host, db_name, db_user, db_pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	}

    protected function FetchOne($query, $params=null)
    {
        if (isset($params)) {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
        } else {
            $stmt = $this->db->query($query);
        }
        $row = $stmt->fetch(PDO::FETCH_NUM);
        if ($row) {
            return $row[0];
        } else {
            return false;
        }
    }

    protected function FetchRow($query, $params=null)
    {
        if (isset($params)) {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
        } else {
            $stmt = $this->db->query($query);
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function FetchAll($query, $params=null)
    {
        if (isset($params)) {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
        } else {
            $stmt = $this->db->query($query);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function FetchAssoc($query, $params=null)
    {
        if (isset($params)) {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
        } else {
            $stmt = $this->db->query($query);
        }
        $rows = $stmt->fetchAll(PDO::FETCH_NUM);
        $assoc = array();
        foreach ($rows as $row) {
            $assoc[$row[0]] = $row[1];
        }
        return $assoc;
    }

    protected function Execute($query, $params=null)
    {
        if (isset($params)) {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } else {
            return $this->db->query($query);
        }
    }

    protected function LastInsertId()
    {
        return $this->db->lastInsertId();
    }

    protected function ErrorInfo()
    {
        return $this->db->errorInfo();
    }

}
