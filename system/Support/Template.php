<?php

namespace system\Support;
use Twig\Lexer;
use system\Helpers\Helpers;

class Template
{
    private \Twig\Environment $twig;

    public function __construct(string $dir)
    {
        $loader = new \Twig\Loader\FilesystemLoader($dir);
        $this->twig = new \Twig\Environment($loader,[]) ; 
        
        $lexer = new Lexer($this->twig, array(
            $this->helpers()
        ));
        $this->twig->setLexer($lexer);
    }

    public function render(string $view, array $data):string
    {
        return $this->twig->render($view, $data);
    }

    private function helpers():void
    {
        array(
            $this->twig->addFunction(
                new \Twig\TwigFunction('url',function(string $url=NULL):string{
                    return Helpers::url($url);
                })
            ),
            $this->twig->addFunction(
                new \Twig\TwigFunction('hello',function(string $usr=''){
                    return Helpers::hello($usr);
                })
            )
        );
    }
}