<?php

class UserConnectModel
{
	private $_id;
	private $_userId;
	private $_lastDate;

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

    public function getLastDate()
    {
        return $this->_lastDate;
    }

    public function setLastDate($lastDate)
    {
        $this->_lastDate = $lastDate;

        return $this;
    }
}