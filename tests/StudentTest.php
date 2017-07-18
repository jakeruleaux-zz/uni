<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Student.php";
    require_once "src/Course.php";
    $server = 'mysql:host=localhost:8889;dbname=uni_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            //Arrange
            $name = "Nathan";
            $enroll_date = "7-24-2089";
            $test_student = new Student($name, $enroll_date);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);
        }
    }
?>
