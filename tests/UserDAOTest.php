<?php


use database\Database;
use database\UserDAO;
use userdb\User;


/**
 * Created by PhpStorm.
 * User: markus
 * Date: 08.01.16
 * Time: 17:56
 */
class UserDAOTest extends PHPUnit_Framework_TestCase
{

    protected $database;
    /**
     * @var UserDAO
     */
    protected $userDAO;

    protected function setUp() {
        $this->database = new Database("127.0.0.1", "root", "root", "intranet");
        $this->userDAO = new UserDAO($this->database);
        $this->database->beginTransaction();
    }

    private function insertTestUsers() {
        $this->userDAO->addUser(new User(null, "testUser1", "Markus", "Jungbluth", "Teststr. 4 66100 SB", "000", "000", "000" ), "test");
        $this->userDAO->addUser(new User(null, "testUser2", "Heinz", "Mustermann", "Teststr. 4 66100 SB", "000", "000", "000" ), "test");
        $this->userDAO->addUser(new User(null, "testUser3", "Alexander", "Jäger", "Teststr. 4 66100 SB", "000", "000", "000" ), "test");
        $this->userDAO->addUser(new User(null, "testUser4", "Peter", "Jordan", "Teststr. 4 66100 SB", "000", "000", "000" ), "test");

    }

    private function insertTestUser() {
        return $this->userDAO->addUser(new User(null, "testUser", "Markus", "Jungbluth", "Schulstr. 4 66133 SB", "000", "000", "000" ), "test");
    }

    /**
     * @test
     */
    public function testAddUser() {
        $inserted = $this->insertTestUser();
        $output = $this->userDAO->getUserByUsername("testUser");
        $this->assertEquals($inserted, $output);
    }

    /**
     * @test
     */
    public function testEditUser() {
        $inserted = $this->insertTestUser();
        $inserted->setNachname("asd");
        $this->userDAO->editUser($inserted);

        $ref = $this->userDAO->getUserByUsername("testUser");

        $this->assertEquals($inserted, $ref);
    }

    public function testDeleteUser() {
        $this->insertTestUser();

        $ret_del = $this->userDAO->deleteUser("testUser");
        $ret_query = $this->userDAO->getUserByUsername("testUser");

        $this->assertTrue($ret_del);
        $this->assertNull($ret_query);
    }

    protected function tearDown() {
        $this->database->rollBack();
    }

    public function testsearchUser() {
        $this->insertTestUsers();
        $ret = $this->userDAO->searchUser("Alexander");

        $this->assertEquals($ret[0]->getVorname(), "Alexander");
    }

}