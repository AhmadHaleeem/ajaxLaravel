<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
class PagesController extends Controller
{
    /**
     * This method handles dynamic routes when route can begin with a category or a user profile name.
     * /women/t-shirts vs /user-slug/product/something
     *
     * @param $slug1
     * @param null $slug2
     * @return mixed
     */
    public function handle($slug1, $slug2 = null)
    {
        $controller = DefaultController::class;
        $action = 'index';

        if ($slug1 == 'something') {
            $controller = SomeController::class;
            $action = 'myAction';
        }

        $container = app();
        $route = $container->make(Route::class);
        $controllerInstance = $container->make($controller);

        return (new ControllerDispatcher($container))->dispatch($route, $controllerInstance, $action);
    }
}
