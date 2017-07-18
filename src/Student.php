<?php
    class Student
    {
        private $name;
        private $enroll_date;
        private $id;

        function __construct($name, $enroll_date, $id = null)
        {
            $this->name = $name;
            $this->enroll_date = $enroll_date;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getEnrollDate()
        {
            return $this->enroll_date;
        }

        function setEnrollDate($new_enroll_date)
        {
            $this->enroll_date = (string) $new_enroll_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO students (name, enroll_date) VALUES ('{$this->getName()}', '{$this->getEnrollDate()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }
    }
?>
