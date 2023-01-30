<?php

namespace system\Core;

class Message 
{
    
    private $text;
    private $css;
    
    public function __toString()
    {
        return $this->render();   
    }
    
    public function success(string $msg): Message
    {
        $this->css = 'alert alert-success';
        $this->text = $this->filter($msg);
        return $this;
    }
    public function error(string $msg): Message
    {
        $this->css = 'alert alert-danger';
        $this->text = $this->filter($msg);
        return $this;
    }
    public function warning(string $msg): Message
    {
        $this->css = 'alert alert-warning';
        $this->text = $this->filter($msg);
        return $this;
    }
    public function info(string $msg): Message
    {
        $this->css = 'alert alert-info';
        $this->text = $this->filter($msg);
        return $this;
    }
    public function render(): string
    {
        return "<div class='{$this->css}' > {$this->text} </div>";
    }
    
    private function filter(string $msg):string
    {
        return filter_var(strip_tags($msg), FILTER_SANITIZE_SPECIAL_CHARS);
    }
    
}


