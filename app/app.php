<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=uni';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' =>__DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll(), 'courses' => Course::getAll()));
    });

    $app->get("/courses", function() use ($app) {
        return $app['twig']->render('courses.html.twig', array('courses' => Course::getAll()));
    });

    $app->post("/courses", function() use ($app) {
      $course_name = $_POST['course_name'];
      $code = $_POST['code'];
      $course = new Course($course_name, $code, $id = null);
      $course->save();
      return $app['twig']->render('courses.html.twig', array('courses' => Course::getAll()));
    });

    $app->get("/courses/{id}", function($id) use ($app) {
        $course = Course::find($id);
        return $app['twig']->render('course.html.twig', array('course' => $course, 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->post("/add_courses", function() use ($app) {
        $student = Student::find($_POST['student_id']);
        $course = Course::find($_POST['course_id']);
        $student->addCourse($course);
        return $app['twig']->render('student.html.twig', array('student' => $student, 'students' => Student::getAll(), 'courses' => $student->getCourses(), 'all_courses' => Course::getAll()));
    });

    $app->post("/add_students", function() use ($app) {
        $student = Student::find($_POST['student_id']);
        $course = Course::find($_POST['course_id']);
        $course->addStudent($student);
        return $app['twig']->render('course.html.twig', array('course' => $course, 'courses' => Course::getAll(), 'students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->get("/students", function() use ($app) {
        return $app['twig']->render('students.html.twig', array('students' => Student::getAll()));
    });

    $app->get("/students/{id}", function($id) use ($app) {
        $student = Student::find($id);
        return $app['twig']->render('student.html.twig', array('student' => $student, 'courses' => $student->getCourses(), "all_courses" => Course::getAll()));
    });

    $app->post("/students", function() use ($app) {
        $student = new Student($_POST['name']);
        $student->save();
        return $app['twig']->render('students.html.twig', array('students' => Student::getAll()));
    });

    $app->get("/students/{id}/edit", function($id) use ($app) {
        $student = Student::find($id);
        return $app['twig']->render('student_edit.html.twig', array('student' => $student));
    });

    $app->patch("/students/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $student = Student::find($id);
        $student->update($name);
        return $app['twig']->render('student.html.twig', array('student' => $student, 'courses' => $student->getCourses()));
    });

    $app->delete("/students/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();
        return $app['twig']->render('index.html.twig', array('students' => Student::getAll()));
    });

    $app->post("/delete_students", function() use ($app) {
      Student::deleteAll();
      return $app['twig']->render('index.html.twig');
    });

    $app->post("/delete_courses", function() use ($app) {
        Course::deleteAll();
        return $app['twig']->render('index.html.twig');
    });

    return $app;
?>
