<?php
/**
 * Created by PhpStorm.
 * User: markus
 * Date: 28.12.15
 * Time: 17:04
 */

namespace controller;


use controller\architecture\Authenticator;
use controller\Controller;
use exceptions\UnauthorizedException;
use helpers\BootstrapAlert;
use view\BootstrapView;
use view\DashboardContentView;
use view\LoginView;

class LoginController extends Controller
{

    private static $numberOfLoginsInCurrentRequest = 0;

    /**
     * @return BootstrapView
     * @LogInNotPermitted
     */
    public function promptAction() {
        if ($this->router->getRequestAnalyzer()->getRequestMethod() == "POST" && self::$numberOfLoginsInCurrentRequest == 0) {
            $user = $this->router->getRequestAnalyzer()->getPostRequest()["user"];
            $password = $this->router->getRequestAnalyzer()->getPostRequest()["password"];
            self::$numberOfLoginsInCurrentRequest++;
            try {
                $this->router->getApplicationRoot()->getAuthenticator()->authenticate($user, $password);
                $userObject = $this->router->getApplicationRoot()->getUserDAO()->getUserByUsername($user);
                $this->router->getApplicationSession()->setUser($userObject);
            } catch (UnauthorizedException $e) {
                //$this->router->getApplicationSession()->setAlert(BootstrapAlert::WARNING("Login failed."));
                //$this->router->reRouteTo("main", "default");
            }
            $this->router->rewindAndRestartRouting();
        } else {
            $view = new LoginView();
            $view->setHeaderText("Awesome Inc.");
            $view->setBadge("Intranet");

            return BootstrapView::getLoginPage("", $view);
        }
    }


    public function authenticateAction() {
        return;
    }

    /**
     * @AuthRequired
     */
    public function logoutAction() {
        $this->router->destroySession();
        $this->router->redirectTo("main");
    }


    public function defaultAction()
    {
        return $this->router->redirectTo("main");
    }

    public function unsupportedAction()
    {
        // TODO: Implement unsupportedAction() method.
    }
}