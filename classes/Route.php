<?php

class Route
{
    private $listRoutes = [''];
    private $listCallbacks = [''];
    private $listProtections = [''];

    public function add($method, $route, $callback, $protect)
    {
        $this->listRoutes[] = strtoupper($method).':'.$route;
        $this->listCallbacks[] = $callback;
        $this->listProtections[] = $protect;

        return $this;
    }

    public function goTo($route)
    {
        $param = '';
        $callback = '';
        $protect = '';
        $methodServer = $_SERVER['REQUEST_METHOD'];
        $methodServer = isset($_POST['_method']) ? $_POST['_method'] : $methodServer;
        $route = $methodServer.":/".$route;
        
        if (substr_count($route, "/") >= 3) {
            $param = substr($route, strrpos($route, "/")+1);
            $route = substr($route, 0, strrpos($route, "/"))."/[PARAM]";
        }
        
        $index = array_search($route, $this->listRoutes);
        
        if ($index > 0) {
            $callback = explode("::", $this->listCallbacks[$index]);
            $protect = $this->listProtections[$index];
        }

        $class = isset($callback[0]) ? $callback[0] : '';
        $method = isset($callback[1]) ? $callback[1] : '';
        
        if (class_exists($class))
        {
            if (method_exists($class, $method))
            {
                $classInstance = new $class();
                
                return call_user_func_array(
                    array($classInstance, $method),
                    array($param)
                );
            } else {
                $this->notExists();
            }
        } else {
            $this->notExists();
        }

    }

    public function notExists()
    {
        http_response_code(404);
    }
}
