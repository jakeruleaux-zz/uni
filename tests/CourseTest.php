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
        protected function tearDown()
        {
          Course::deleteAll();
          Student::deleteAll();
        }

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

        function testGetAll()
        {
            //Arrange
            $course_name = "Bio";
            $course_name_2 = "Trig";
            $code = "B101";
            $code_2 = "T105";
            $test_course = new Course($course_name, $code);
            $test_course->save();
            $test_course_2 = new Course($course_name_2, $code_2);
            $test_course_2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course_2], $result);
        }

        function testDeleteAll()
         {
             //Arrange
             $course_name = "bio";
             $course_name_2 = "Trig";
             $code = "B101";
             $code_2 = "T105";
             $test_course = new Course($course_name, $code);
             $test_course->save();
             $test_course_2 = new Course($course_name_2, $code_2);
             $test_course_2->save();

             //Act
             Course::deleteAll();
             $result = Course::getAll();

             //Assert
             $this->assertEquals([], $result);
         }

         function testFind()
         {
             //Arrange
             $course_name = "Bio";
             $course_name_2 = "Trig";
             $code = "12-23-1234";
             $code_2 = "11-13-3456";
             $test_course = new Course($course_name, $code);
             $test_course->save();
             $test_course_2 = new Course($course_name_2, $code_2);
             $test_course_2->save();

             //Act
             $result = Course::find($test_course->getId());

             //Assert
             $this->assertEquals($test_course, $result);
         }

         function testUpdate()
         {
             //Arrange
             $course_name = "Bio";
             $code = "12-25-2000";
             $test_course = new Course($course_name, $code);
             $test_course->save();

             $new_course_name = "trig";

             //Act
             $test_course->update($new_course_name);

             //Assert
             $this->assertEquals("trig", $test_course->getCourseName());
         }

         function testDelete()
         {
             //Arrange
             $course_name = "Nathan";
             $code = "12-10-2345";
             $test_course = new Course($course_name, $code);
             $test_course->save();
             $course_name_2 = "Gabriel";
             $code_2 = "09-23-4908";
             $test_course_2 = new Course($course_name_2, $code_2);
             $test_course_2->save();

             //Act
             $test_course->delete();

             //Assert
             $this->assertEquals([$test_course_2], Course::getAll());
         }

         function testGetStudents()
         {
             //Arrange
             $course_name = "Bio";
             $code = "B101";
             $id = null;
             $test_course = new Course($course_name, $code, $id);
             $test_course->save();

             $name = "Nathan";
             $enroll_date = "12-12-2345";
             $id = null;
             $test_student = new Student($name, $enroll_date, $id);
             $test_student->save();

             $student_name_2 = "Trig";
             $enroll_date_2 = "12-12-2123";
             $id_2 = null;
             $test_student_2 = new Student($student_name_2, $enroll_date_2, $id_2);
             $test_student_2->save();

             //Act
             $test_course->addStudent($test_student);
             $test_course->addStudent($test_student_2);

             //Assert
             $this->assertEquals($test_course->getStudents(), [$test_student, $test_student_2]);
         }

         function testAddStudent()
         {
             //Arrange
             $course_name = "Bio";
             $code = "B101";
             $id = null;
             $test_course = new Course($course_name, $code, $id);
             $test_course->save();

             $name = "Nathan";
             $enroll_date = "12-12-2345";
             $id = null;
             $test_student = new Student($name, $enroll_date, $id);
             $test_student->save();

             //Act
             $test_course->addStudent($test_student);

             //Assert
             $this->assertEquals($test_course->getStudents(), [$test_student]);
         }

    }
?>
