<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 10.01.16
 * Time: 23:39
 */

namespace session;


use Aura\Session\Segment;
use exceptions\UnauthorizedException;
use helpers\BootstrapAlert;
use userdb\User;

class ApplicationSession
{

    /**
     * @var User
     */
    private $user;


    public function __construct() {

    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function isSessionActive() {
        return !is_null($this->user);
    }

    /**
     * @return User
     * @throws UnauthorizedException
     */
    public function getUser()
    {
        if (is_null($this->user)) throw new UnauthorizedException();
        return $this->user;
    }




}