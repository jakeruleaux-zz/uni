<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Course.php";
    require_once "src/Student.php";
    $server = 'mysql:host=localhost:8889;dbcourse_name=uni_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //   Course::deleteAll();
        //   Student::deleteAll();
        // }

        function testgetCourseName()
        {
            //Arrange
            $course_name = "Bio";
            $code = "B101";
            $test_course = new Course($course_name, $code);

            //Act
            $result = $test_course->getCourseName();

            //Assert
            $this->assertEquals($course_name, $result);
        }

        function testgetCode()
        {
            //Arrange
            $course_name = "Bio";
            $code = "B101";
            $test_course = new Course($course_name, $code);

            //Act
            $result = $test_course->getCode();

            //Assert
            $this->assertEquals($code, $result);
        }

    }
?>
