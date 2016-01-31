<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 08.01.16
 * Time: 16:24
 */

namespace database;

use exceptions\IntranetDatabaseException;
use exceptions\UnauthorizedException;
use userdb\User;

class UserDAO implements Authenticator
{

    public static $FIELDS_FOR_USER_OBJECT = array ("id", "username", "vorname", "nachname", "anschrift", "telefonDurchwahl", "telefonPrivat", "telefonMobil");


    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPasswordHash($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * @var Database
     */
    private $database;


    public function __construct(Database $database) {
        $this->database = $database;
    }

    /**
     * @param $username
     * @return User
     */
    public function getUserByUsername($username) {
        $result = $this->database
            ->fetchRow("SELECT * FROM users WHERE username = :username",
                array(
                    "username" => $username
                )
            );

        return $this->userParser($result);

    }

    /**
     * @param $id
     * @return null|User
     */
    public function getUserById($id) {
        $result = $this->database
            ->fetchRow("SELECT * FROM users WHERE id = :id",
                array(
                    "id" => $id
                )
            );

        return $this->userParser($result);
    }


    /**
     * @param User $user
     * @return User
     */
    public function addUser(User $user, $password) {
        $id = $this->database->insert("users", array(
            "username" => $user->getUsername(),
            "password_hash" => self::hashPassword($password),
            "vorname" => $user->getVorname(),
            "nachname" => $user->getNachname(),
            "anschrift" => $user->getAnschrift(),
            "telefonDurchwahl" => $user->getTelefonDurchwahl(),
            "telefonPrivat" => $user->getTelefonPrivat(),
            "telefonMobil" => $user->getTelefonMobil()
        ));

        $user->setId($id);
        return $user;

    }

    /**
     * @param $searchTerms
     * @return User[]
     */
    public function searchUser($searchTerms) {
        //TODO: Performance is a bitch here!
        $searchTerms = "%".$searchTerms."%";
        $results = $this->database
            ->fetchRowMany(
                "SELECT * FROM users WHERE vorname LIKE :searchTerms OR nachname LIKE :searchTerms",
                array(
                    "searchTerms" => $searchTerms
                )
            );

        return $this->userSetParser($results);
    }

    /**
     * @param User $user
     * @param null $password
     * @return User
     * @throws \Simplon\Mysql\MysqlException
     */
    public function editUser(User $user, $password = NULL) {

        $data = array(
            "username" => $user->getUsername(),
            "vorname" => $user->getVorname(),
            "nachname" => $user->getNachname(),
            "anschrift" => $user->getAnschrift(),
            "telefonDurchwahl" => $user->getTelefonDurchwahl(),
            "telefonPrivat" => $user->getTelefonPrivat(),
            "telefonMobil" => $user->getTelefonMobil()
        );
        //Method Overloading is a bitch in PHP... :/
        if (!is_null($password)) $data["password_hash"] = $password;

        $this->database->update("users",
            array("id" => $user->getId()),
            $data
        );
        return $user;
    }


    /**
     * @param $username
     * @return bool
     */
    public function deleteUser($username) {
        return $this->database->delete("users", array("username" => $username));
    }

    /**
     * @param $field
     * @param $array
     * @throws IntranetDatabaseException
     */
    private function assertFieldInArray($field, $array) {
        if (!array_key_exists("id", $array)) throw new IntranetDatabaseException("Feld: ".$field." nicht vorhanden!");
    }


    /**
     * @param array $resultSet
     * @return null|User
     * @throws IntranetDatabaseException
     */
    private function userParser(array $resultSet) {

        if (empty($resultSet)) return null;

        foreach (self::$FIELDS_FOR_USER_OBJECT as $field) {
            $this->assertFieldInArray($field, $resultSet);
        }

        return new User(
            $resultSet["id"],
            $resultSet["username"],
            $resultSet["vorname"],
            $resultSet["nachname"],
            $resultSet["anschrift"],
            $resultSet["telefonDurchwahl"],
            $resultSet["telefonPrivat"],
            $resultSet["telefonMobil"]
        );

    }

    private function userSetParser(array $resultSets) {
        $output = array();

        foreach($resultSets as $resultSet) {
            $output[] = $this->userParser($resultSet);
        }

        return $output;
    }


    /**
     * @param $user
     * @param $password
     * @throws UnauthorizedException
     */
    function authenticate($user, $password)
    {
        if (!$this->hasValidCredentials($user, $password)) throw new UnauthorizedException();
    }


    /**
     * @param $user
     * @param $password
     * @return bool
     */
    function hasValidCredentials($user, $password)
    {
        $hash = $this->database
            ->fetchColumn(
                "SELECT password_hash FROM users WHERE username = :username",
                array(
                    "username" => $user
                )
            );
        return self::verifyPasswordHash($password, $hash);
    }
}