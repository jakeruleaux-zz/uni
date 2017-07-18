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

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach($returned_courses as $course) {
                $course_name = $course['course_name'];
                $course_code = $course['code'];
                $id = $course['id'];
                $new_course = new Course($course_name, $course_code, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM courses;");
            if ($executed) {
                 return true;
            } else {
                 return false;
            }
        }

        static function find($search_id)
        {
            $returned_courses = $GLOBALS['DB']->prepare("SELECT * FROM courses WHERE id = :id");
            $returned_courses->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_courses->execute();
            foreach ($returned_courses as $course) {
              $course_name = $course['course_name'];
              $course_code = $course['code'];
              $id = $course['id'];
              if ($id == $search_id) {
                  $found_course = new Course($course_name, $course_code, $id);
              }
            }
            return $found_course;
        }

        function update($new_course_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE courses SET course_name = '{$new_course_name}' WHERE id = {$this->getID()};");
            if ($executed) {
             $this->setCourseName($new_course_name);
             return true;
            } else {
             return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
            if (!$executed) {
                return false;
            }
            $executed = $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE course_id = {$this->getId()};");
            if (!$executed) {
                return false;
            } else {
                return true;
            }
        }
    }
 ?>
