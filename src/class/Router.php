<?php
namespace App;

class Router {

    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new \AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null):self
    {
        $this->router->map('GET|POST', $url, $view, $name);

        return $this;
    }

    public function run():self
    {
        $match = $this->router->match();
        ob_start();
        if($match){
            $view = $match['target'];
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        }else{
            require $this->viewPath . DIRECTORY_SEPARATOR . '404.php';
        }
        $content = ob_get_clean();
        require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php';

        return $this;
    }

    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

}