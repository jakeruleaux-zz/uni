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
          Course::deleteAll();
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

        function testFind()
        {
            //Arrange
            $name = "Nathan";
            $name_2 = "Gabriel";
            $enroll_date = "12-23-1234";
            $enroll_date_2 = "11-13-3456";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();
            $test_student_2 = new Student($name_2, $enroll_date_2);
            $test_student_2->save();

            //Act
            $result = Student::find($test_student->getId());

            //Assert
            $this->assertEquals($test_student, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Nathan";
            $enroll_date = "12-25-2000";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();

            $new_name = "Gabriel";

            //Act
            $test_student->update($new_name);

            //Assert
            $this->assertEquals("Gabriel", $test_student->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Nathan";
            $enroll_date = "12-10-2345";
            $test_student = new Student($name, $enroll_date);
            $test_student->save();
            $name_2 = "Gabriel";
            $enroll_date_2 = "09-23-4908";
            $test_student_2 = new Student($name_2, $enroll_date_2);
            $test_student_2->save();

            //Act
            $test_student->delete();

            //Assert
            $this->assertEquals([$test_student_2], Student::getAll());
        }

        function testGetCourses()
        {
            //Arrange
            $name = "Nathan";
            $id = null;
            $test_student = new Student($name, $id);
            $test_student->save();

            $course_name = "Bio";
            $code = "B101";
            $id = null;
            $test_course = new Course($course_name, $code, $id);
            $test_course->save();

            $course_name2 = "Trig";
            $code_2 = "T101";
            $id_2 = null;
            $test_course2 = new Course($course_name2, $code_2, $id_2);
            $test_course2->save();

            //Act
            $test_student->addCourse($test_course);
            $test_student->addCourse($test_course2);

            //Assert
            $this->assertEquals($test_student->getCourses(), [$test_course, $test_course2]);
        }

        function testAddCourse()
        {
            //Arrange
            $name = "Nathan";
            $id = null;
            $test_student = new Student($name, $id);
            $test_student->save();

            $course_name = "Bio";
            $code = "B101";
            $id = null;
            $test_course = new Course($course_name, $code, $id);
            $test_course->save();

            //Act
            $test_student->addCourse($test_course);

            //Assert
            $this->assertEquals($test_student->getCourses(), [$test_course]);
        }

    }
?>
