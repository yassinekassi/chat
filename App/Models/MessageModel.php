<?php

class MessageModel
{
	private $_id;
	private $_userId;
	private $_datetime;
	private $_content;


    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    public function getUserid()
    {
        return $this->_userId;
    }

    public function setUserid($userId)
    {
        $this->_userId = $userId;

        return $this;
    }

    public function getDatetime()
    {
        return $this->_datetime;
    }

    public function setDatetime($datetime)
    {
        $this->_datetime = $datetime;

        return $this;
    }

    public function getContenu()
    {
        return $this->_content;
    }

    public function setContenu($contenu)
    {
        $this->_content = $contenu;

        return $this;
    }
}