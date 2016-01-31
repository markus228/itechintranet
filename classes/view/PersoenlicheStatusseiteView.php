<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 26.12.15
 * Time: 22:09
 */

namespace view;


use userdb\User;
use view\architecture\View;

class PersoenlicheStatusseiteView extends View
{

    /**
     * @var User
     */
    private $user;


    public function __construct(User $user) {
        parent::__construct(null);
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }





}