<?php


class UserConnectManager
{

	static function add(UserConnectModel $user)
  	{
  		$userId = $user->getUserid();
  		global $db;
  		$res=$db->prepare("insert into user_connect(user_id) values(:user_id)");
        $res->bindParam(':user_id',$userId);
        $res->execute();
  	}

	static function update(UserConnectModel $user)
  	{
  		$now = (new \DateTime())->format('Y-m-d H:i:s');
  		$userId = $user->getUserid();
  		global $db;
  		$res=$db->prepare("update user_connect set lastDate=:lastDate where user_id=:user_id");
        $res->bindParam(':lastDate',$now);
        $res->bindParam(':user_id',$userId);
        $res->execute();
  	}

  	static function remove($id)
  	{
  		global $db;
  		$res=$db->prepare("delete from user_connect where id=:id");
  		$res->bindParam(':id',$id);
        $res->execute();
  	}

	static function findAll()
    {
        global $db;
        $usersConnect = [];

        $tab=$db->query("select * from user_connect")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tab as $row) {
            $userConnect=new UserConnectModel();
            $userConnect->setId($row['id']);
            $userConnect->setUserid($row['user_id']);
            $userConnect->setLastDate($row['lastDate']);
            $usersConnect[] = $userConnect;
        }

        return $usersConnect;
    }

    static function getByUserId($user_id)
	{
		global $db;
		$tab = $db->prepare("SELECT * FROM user_connect WHERE user_id = :user_id");
		$tab->execute(array(
           ':user_id' => $user_id
        ));
        $row = $tab->fetch();

        if($row)
        {
	        $userConnect=new UserConnectModel();
			$userConnect->setId($row['id']);
			$userConnect->setUserid($row['user_id']);
            $userConnect->setLastDate($row['lastDate']);
			return $userConnect;
		}
       	return false;
	}
}