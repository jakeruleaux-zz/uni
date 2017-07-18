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

        function testGetCourseName()
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

        function testGetCode()
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

        function testGetId()
        {
            //Arrange
            $course_name = "Bio";
            $code = "B101";
            $test_course = new Course($course_name, $code);
            $test_course->save();

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            //Arrange
            $course_name = "Bio";
            $code = "B101";
            $test_course = new Course($course_name, $code);

            //Act
            $executed = $test_course->save();

            //Assert
            $this->assertTrue($executed, "Theres no course in database!!!!");
        }
    }
?>
