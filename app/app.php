<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/task.php";

    session_start();

    if (empty($_SESSION['list_of_tasks'])) {
    $_SESSION['list_of_tasks'] = array();
    }//storing tasks in user's cookies
    //session is a super global variable

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {//all current tasks page

        return $app['twig']->render('tasks.html.twig', array('tasks' => Task::getAll()));
    });

    $app->post("/tasks", function() use ($app) {//create task page
        $task = new Task($_POST['description']);
        $task->save();
        return $app['twig']->render('create_task.html.twig');
    });

    $app->post("/delete_tasks", function() {

        Task::deleteAll();

        return "
            <h1>List Cleared!</h1>
            <p><a href='/'>Home</a></p>
        ";
    });

    return $app;
?>
