<?php

class homeController extends controller {

    public function __construct() {
        parent::__construct();
        $u = new usuarios();

        if ($u->isLogged()) {
            header("Location: /twitter/login");
        }
    }

    public function index() {
        $dados = array(
            'nome' => ''
        );
        $p = new posts();
        if(isset($_POST['msg'])&& !empty($_POST['msg'])){
            $msg = $_POST['msg'];
            $p->inserirPosts($msg);
        }
        
        $u = new usuarios($_SESSION['twlg']);
        $dados['nome'] = $u->getnNome();
        $dados['qtdseguidos'] = $u->countSeguidos();
        $dados['qt_seguidores'] = $u->countSeguidores();
        $dados['sugestao'] = $u->getUsuarios(5);

        $lista = $u->getSeguidos();
        $lista[] = $_SESSION['twlg'];
        $dados['feed'] = $p->getFeed($lista, 10);
        
        $this->loadTemplate('home', $dados);
    }

    public function seguir($id) {
        if (!empty($id)) {
            $id = addslashes($id);

            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {

                $r = new relacionamentos();
                $r->seguir($_SESSION['twlg'], $id);
            }
        }

        header("Location: /twitter");
    }
    
    public function desseguir($id) {
        if (!empty($id)) {
            $id = addslashes($id);

            $sql = "SELECT * FROM usuarios WHERE id = '$id'";
            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {

                $r = new relacionamentos();
                $r->desseguir($_SESSION['twlg'], $id);
            }
        }

        header("Location: /twitter");
    }

}
