<?php

class JoueurController{

    function index(){
        global $twig;
        global $modelA;
        $joueurs = $modelA->getAll();
        echo $twig->render('joueur/index.twig', ['joueurs' => $joueurs]);
    }

    function remove(){
        global $modelA;
        $id = $_GET['id'];
        $modelA->delete($id);
        header('location:index.php?controller=joueur');
    }

    function pageAdd(){
        global $twig;
        global $modelA;
        $equipes = $modelA->getAllEquipJ();
        echo $twig->render('joueur/create.twig', ['equipes' => $equipes]);
    }

    function save(){
        global $modelA;
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $equipe_id = $_POST['equipe_id'];
        $modelA->add($nom, $prenom, $age, $equipe_id);
        header('location:index.php?controller=joueur');
    }

    function edit() {
        global $twig;
        global $modelA;
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            $joueur= $modelA->getJoueurById($id);
            $equipes = $modelA->getAllEquipJ();

            if (!$joueur) {
                header('Location: index.php');
                exit();
            }
            echo $twig->render('joueur/edit.twig', ['joueur' => $joueur, 'equipes' => $equipes]);
        } else {
            header('Location: index.php?controller=animal');
            exit();
        }
    }

    function updateEdit(){
        global $modelA;
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $age = $_POST['age'];
        $equipe_id = $_POST['equipe_id'];
        $modelA->update($id, $nom,$prenom, $age, $equipe_id);
        header('location:index.php?controller=joueur');

    }
}