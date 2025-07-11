<?php
namespace App\Helpers;

use App\Models\User;

class Session
{
    private static $instances = [];
    private $signedIn = false;
    public $userId;
    public $message;

    private function __construct()
    {
        //session_start();
        $this->checkLogin();
        $this->checkMessage();
    }

    private function __clone(){}

    public static function getInstance(): Session
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function isSignedIn()
    {
        return $this->signedIn;
    }

    public function checkLogin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
            $this->signedIn = true;
        } else {
            unset($this->userId);
            $this->signedIn = false;
        }
    }

    public function login($user)
    {
        if ($user) {
            $this->userId = $user->id;
            $_SESSION['user_id'] = $user->id;
            $this->signedIn = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_role']);
        unset($_SESSION['userId']);
        unset($_SESSION['userRole']);
        $this->signedIn = false;

    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $this->message = $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    public function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
    public static function getGlobals() {
        return array(
            'session' => [
                'user_id' => $_SESSION['user_id'] ?? null,
                'user_role' => $_SESSION['user_role'] ?? null,
            ],
        );
    }
}
?>