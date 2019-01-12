<?php


class PagesController
{
    public $db;
    public $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->db = new QueryBuilder($this->pdo);
    }

    public function home()
    {
        $_SESSION['posts'] = $this->db->getPosts();
        require __DIR__ . '/../views/index.html';
    }

    public function add()
    {
        $this->db->create();
    }

    public function changeFavorite()
    {
        parse_str(file_get_contents("php://input"), $put);
        $this->db->changeFavorite($put['id'], $put['val']);

    }

    public function delete($id)
    {
        $this->db->delete($id);
        header("location: /");
    }

    public function getContent()
    {
//        parse_str(file_get_contents("php://input"),$post);
//        die(var_dump($_GET['id']));
        $_SESSION['post'] = $this->db->getPost($_GET['id']);
//        die(var_dump($_SESSION['post']));


    }

    public function article()
    {
        require __DIR__ . '/../views/article.html';

    }
}