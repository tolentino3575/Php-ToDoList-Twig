<?php
class Task
{
    private $description;
    private $Title;

    function __construct($description)
    {
        $this->description=$description;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function save()
    {
        array_push($_SESSION['list_of_tasks'], $this);
    }//allows you to save tasks in the superglobal variable

    static function getAll()
    {
        return $_SESSION['list_of_tasks'];
    }//static functions are getters. its job is to return the list of all of our tasks.

    static function deleteAll()
    {
        $_SESSION['list_of_tasks'] = array();
    }
}
?>
