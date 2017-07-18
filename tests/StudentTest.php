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
        protected function tearDown()
        {
          Student::deleteAll();
        //   Course::deleteAll();
        }

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

        function testGetEnrollDate()
        {
            //Arrange
            $name = "Nathan";
            $enroll_date = "7-24-2089";
            $test_student = new Student($name, $enroll_date);

            //Act
            $result = $test_student->getEnrollDate();

            //Assert
            $this->assertEquals($enroll_date, $result);
        }

        function testSave()
        {
            //Arrange
            $name = "Nathan";
            $enroll_date = "7-24-2089";
            $test_student = new Student($name, $enroll_date);

            //Act
            $executed = $test_student->save();

            //Assert
            $this->assertTrue($executed, "Student not successfully saved to database");
        }

        function testGetId()
        {
            //Arrange
            $name = "Nathan";
            $enroll_date = "7-24-2089";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            //Act
            $result = $test_student->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));

        }

        function testGetAll()
        {
            //Arrange
            $name = "Nathan";
            $name_2 = "Gabriel";
            $enroll_date = "12-12-1234";
            $enroll_date_2 = "11-11-1111";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();
            $test_student_2 = new Student($name_2, $enroll_date_2);
            $test_student_2->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student, $test_student_2], $result);
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Nathan";
            $name_2 = "Gabriel";
            $enroll_date = "12-12-1234";
            $enroll_date_2 = "11-11-1111";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();
            $test_student_2 = new Student($name_2, $enroll_date_2);
            $test_student_2->save();

            //Act
            Student::deleteAll();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([], $result);
        }
    }
?>
