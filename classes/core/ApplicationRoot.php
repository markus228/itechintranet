<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 16.01.16
 * Time: 15:47
 */

namespace core;


use database\Authenticator;
use database\Database;
use database\UserDAO;

class ApplicationRoot
{

    /**
     * @var Authenticator
     */
    private $authenticator;
    /**
     * @var UserDAO
     */
    private $userDAO;
    /**
     * @var Database
     */
    private $database;


    public function __construct() {

    }

    /**
     * @return Authenticator
     */
    public function getAuthenticator()
    {
        if (!$this->authenticator instanceof Authenticator) {
            $this->authenticator = $this->getUserDAO();
        }
        return $this->authenticator;
    }


    /**
     * @return UserDAO
     */
    public function getUserDAO()
    {
        if (!$this->userDAO instanceof UserDAO) {
            $this->userDAO = new UserDAO($this->getDatabase());
        }
        return $this->userDAO;
    }

    /**
     * @return Database
     */
    public function getDatabase()
    {
        if (!$this->database instanceof Database) {
            $this->database = new Database("127.0.0.1", "root", "root", "intranet");
        }
        return $this->database;
    }



}