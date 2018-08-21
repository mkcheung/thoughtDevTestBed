<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 8/21/18
 * Time: 10:39 AM
 */
namespace App\Entity;

class Article
{
    protected $headline;
    protected $dueDate;

    public function getTask()
    {
        return $this->headline;
    }

    public function setTask($headline)
    {
        $this->headline = $headline;
    }

}