<?php

class Rota
{

    private $controlador = "Paginas";
    private $metodo = "index";

    public function __construct()
    {

        $url =  $this->url() ? $this->url() : [0];

        if (file_exists("../app/Controllers/" . ucwords($url[0]) . ".php")) {
            $this->controlador = ucwords($url[0]);
            unset($url[0]);
        };

        require_once '../app/Controllers/' . $this->controlador . ".php";
        $this->controlador = new $this->controlador;

        if (isset($url[1])) {
            if (method_exists($this->controlador, $url[1])) {
                $this->metodo = $url[1];
                unset($url[1]);
            }    //var_dump($url);
        }

        var_dump($this);
    }
    private function url()
    {

        $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

        if (isset($url)) {

            $url = trim(rtrim($url, '/'));//trim retia os ospaços vazio no inicio e fim. E rtrim retira espaços e caracteres no final da url.
            
            $url = explode('/', $url);//trasnforma em array as string ente as '/'.

            return $url;
        }
    }
}
