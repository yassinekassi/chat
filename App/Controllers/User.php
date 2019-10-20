<?php

class User extends Controller{

    public function login()
	{
		//unset($_SESSION['username']);
		if (isset($_SESSION['username']))
		{
			header("Location: /message/index");
			exit();
		}

		if(!empty($_POST))
		{

				$user = UserManager::getByUserName($_POST['username']);
				if ($user)
				{
					if(MD5($_POST['password'])==$user->getPassword())
					{
						$_SESSION['username'] = $user->getUsername();
						header("Location: /message/index");
					}
					else
					{
						$this->view->error = 'Mot de passe incorrect';
					}
				}
				else
				{
					$this->view->error = 'Identifiants incorrect';
				}

		}
		$this->view->render("User/login");
	}

	public function inscription()
	{
		if(!empty($_POST))
		{
				if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']))
				{
					if($_POST['password'] == $_POST['password2'])
					{

						$users = UserManager::findAll();
						foreach($users as $user)
						{
							if($user->getUsername() == MD5($_POST['username']))
							{
								$this->view->error = 'Pseudo déjà existant';
								$alreadyExist = true;
							}
						}

						if(!isset($alreadyExist))
						{
							$user = new UserModel();
							$user->setUsername($_POST['username']);
							$user->setPassword(MD5($_POST['password']));
							UserManager::add($user);
							$_SESSION['username'] = $user->getUsername();
							header("Location: /message/index");
						}
						
					}
					else
					{
						$this->view->error = 'Les mots de passe doivent être identiques';
					}
				}
				else
				{
					$this->view->error = 'Veuillez remplir tous les champs';
				}
		}
		$this->view->render("user/inscription");
	}

}