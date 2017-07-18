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

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enroll_date = $student['enroll_date'];
                $id = $student['id'];
                $new_student =  new Student($name, $enroll_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM students;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }
    }
?>
