<?php

class UserManager
{

    static function add(UserModel $user)
  	{
  		global $db;
  		$res=$db->prepare("insert into user(username, password) values(:username,:password)");
        $res->bindParam(':username',$user->getUsername());
        $res->bindParam(':password',$user->getPassword());
        $res->execute();
  	}

  	static function findAll()
	{
		global $db;
		$users = [];

		$tab=$db->query("select * from user");
        $tab->fetchAll(PDO::FETCH_ASSOC);

		foreach ($tab as $row) {
			$user=new UserModel();
			$user->setId($row['id']);
			$user->setUsername($row['username']);
			$user->setPassword($row['password']);
			$users[] = $user;
		}

		return $users;
	}

	static function getByUsername($username)
	{
		global $db;
		$tab = $db->prepare("SELECT * FROM user WHERE username = :username");
		$tab->execute(array(
           ':username' => $username
        ));
        $row = $tab->fetch();

        if($row)
        {
	        $user=new UserModel();
			$user->setId($row['id']);
			$user->setUsername($row['username']);
			$user->setPassword($row['password']);
			return $user;
		}
       	return false;
	}

	static function getById($id)
	{
		global $db;
		$tab = $db->prepare("SELECT * FROM user WHERE id = :id");
		$tab->execute(array(
           ':id' => $id
        ));
        $row = $tab->fetch();

        if($row)
        {
	        $user=new UserModel();
			$user->setId($row['id']);
			$user->setUsername($row['username']);
			$user->setPassword($row['password']);
			return $user;
		}
       	return false;
	}
}