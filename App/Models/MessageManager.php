<?php
class MessageManager
{

    static function add(MessageModel $message)
    {
        $contenu = $message->getContenu();
        $idUser = $message->getUserid();
        global $db;
        $res=$db->prepare("insert into message(contenu, user_id) values(:contenu,:user_id)");
        $res->bindParam(':contenu',$contenu);
        $res->bindParam(':user_id',$idUser);
        $res->execute();
    }

    static function findAll()
    {
        global $db;
        $messages = [];

        $tab=$db->query("select * from message")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tab as $row) {
            $message=new MessageModel();
            $message->setId($row['id']);
            $message->setContenu($row['contenu']);
            $message->setUserid($row['user_id']);
            $message->setDateTime($row['datetime']);
            $messages[] = $message;
        }

        return $messages;
    }
}