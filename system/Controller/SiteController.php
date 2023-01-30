<?php

namespace system\Controller;

use system\Core\Controller;
use system\Model\PostModel;
use system\Helpers\Helpers;

class SiteController extends Controller
{
    public function __construct(){
        parent::__construct('templates/site/views/');
    }

    public function index():void
    {
        $posts = (new PostModel())->search(null,null);

        echo $this->template->render('index.html',[
            'title' => 'Home',
            'posts' => $posts
        ]);
    }

    public function search():void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $search = $_POST['search'];
            $posts = ( new PostModel())->searchForm($search);

            echo $this->template->render('index.html', [
                'title' => 'Home',
                'posts' => $posts
            ]);
        }else{
            Helpers::redirect('404/');
        }
    }

    public function post(int $id):void
    {
        $post = (new PostModel())->search("id",$id);

        if(!$post){
            Helpers::redirect('404/');
        }
        echo $this->template->render('post.html',[
            'title' => 'Post',
            'post' => $post[0]
        ]);
    }

    public function about():void
    {
        echo $this->template->render('about.html',[
            'title' => 'Sobre'
        ]);
    }
    public function error404():void
    {
        echo $this->template->render('404.html',[
            'title' => 'Page not found :('  
        ]);
    }
}



