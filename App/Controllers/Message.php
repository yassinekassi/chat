<?php

class Message extends Controller{
    function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['username'])) {
            header("Location: /user/login");
            exit();
        }
    }

    public function index()
	{
        if(!empty($_POST))
        {
            require ROOT . '/App/Models/UserModel.php';
            require ROOT . '/App/Models/UserManager.php';
            $user = UserManager::getByUserName($_SESSION['username']);
            $message = new MessageModel();
            $message->setContenu($_POST['contenu']);
            $message->setUserid($user->getId());

            MessageManager::add($message);
        }
		$this->view->render("Message/index");
	}

    public function getAllMessages() 
    {

        require ROOT . '/App/Models/UserModel.php';
        require ROOT . '/App/Models/UserManager.php';
        $response = [];

        $messages = MessageManager::findAll();
        foreach ($messages as $message)
        {
            $response[$message->getId()]['contenu'] = $message->getContenu();
            $response[$message->getId()]['username'] = UserManager::getById($message->getUserid())->getUserName();
            $response[$message->getId()]['datetime'] = $message->getDatetime();
        }

        echo json_encode($response);
    }

    public function getUsersConnect()
    {
        require ROOT . '/App/Models/UserConnectModel.php';
        require ROOT . '/App/Models/UserConnectManager.php';
        require ROOT . '/App/Models/UserModel.php';
        require ROOT . '/App/Models/UserManager.php';

        $usersConnect = UserConnectManager::findAll();
        $user = UserManager::getByUserName($_SESSION['username']);
        $response = [];
        $newUser = true;

        foreach ($usersConnect as $userConnect)
        {

            if ($userConnect->getUserid() == $user->getId())
            {
                UserConnectManager::update($userConnect);
                $newUser = false;           
            }

            $now = (new \DateTime())->format('Y-m-d H:i:s');
            $lastupdate = (new \DateTime($userConnect->getLastDate()))->format('Y-m-d H:i:s');

            if (strtotime($now) - strtotime($lastupdate) >= 100 )
            {

                UserConnectManager::remove($userConnect->getId());
            }
            else
            {
                $response[] = UserManager::getById($userConnect->getUserid())->getUserName();
            }
        }

        if($newUser)
        {
            $userConnect = new UserConnectModel();
            $userConnect->setUserid($user->getId());
            UserConnectManager::add($userConnect);
            $response[] = UserManager::getById($userConnect->getUserid())->getUserName();
        }

        echo json_encode($response);
    }

    public function deconnexion()
    {
        require ROOT . '/App/Models/UserConnectModel.php';
        require ROOT . '/App/Models/UserConnectManager.php';
        require ROOT . '/App/Models/UserModel.php';
        require ROOT . '/App/Models/UserManager.php';
        $user = UserManager::getByUserName($_SESSION['username']);
        $userConnect = UserConnectManager::getByUserId($user->getId());
        UserConnectManager::remove($userConnect->getId());
        unset($_SESSION['username']);
        header("Location: /User/login");
    }

}