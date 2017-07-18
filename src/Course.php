<?php

    class Course
    {
        private $course_name;
        private $code;
        private $id;

        function __construct($course_name, $code, $id = null)
        {
            $this->course_name = $course_name;
            $this->code = $code;
            $this->id = $id;
        }

        function getCourseName()
        {
            return $this->course_name;
        }

        function setCourseName($new_course_name)
        {
            $this->course_name = (string) $new_course_name;
        }

        function getCode()
        {
            return $this->code;
        }

        function setCode($new_code)
        {
            $this->code = (string) $new_code;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO courses (course_name, code) VALUES ('{$this->getCourseName()}', '{$this->getCode()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }


    }
 ?>
