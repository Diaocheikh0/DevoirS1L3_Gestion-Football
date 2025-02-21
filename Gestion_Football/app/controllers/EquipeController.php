<?php
class EquipeController {
    function index() {
        global $twig;
        global $modelE;
        $equipes = $modelE->getAll();
        echo $twig->render('equipe/index.twig', ['equipes' => $equipes]);
    }

    function remove(){
        global $modelE;
        $id = $_GET['id'];
        $modelE->delete($id);
        header('location:index.php?controller=equipe');
    }

    function pageAdd(){
        global $twig;
        echo $twig->render('equipe/create.twig');
    }

    function save(){
        global $modelE;
        $libelle = $_POST['libelle'];
        $modelE->add($libelle);
        header('location:index.php?controller=equipe');
    }

    function edit(){
        global $twig;
        global $modelE;
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            $equipe = $modelE->getEquipeById($id);

            if (!$equipe) {
                header('Location: index.php');
                exit();
            }
            echo $twig->render('equipe/edit.twig', ["equipe" => $equipe]);
        } else {
            header('Location: index.php?controller=equipe');
            exit();
        }

    }

    function updateEdit(){
        global $modelE;
        $id = $_POST['id'];
        $libelle = $_POST['libelle'];
        $modelE->update($id, $libelle);
        header('location:index.php?controller=equipe');

    }
}