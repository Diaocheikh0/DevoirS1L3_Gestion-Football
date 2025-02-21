<?php
    require_once '../app/config/bootstrap.php';
    require_once '../app/models/Equipe.php';
    require_once '../app/models/Joueur.php';
    require_once '../app/models/EquipeModel.php';
    require_once '../app/models/JoueurModel.php';
    require_once '../app/controllers/EquipeController.php';
    require_once '../app/controllers/JoueurController.php';
    require_once '../app/controllers/interfaceController.php';

    require_once '../vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader([
        '../app/views/',
    ]);
    $twig = new \Twig\Environment($loader, []);

    $modelE = new EquipeModel();
    $modelA = new JoueurModel();


    if (isset($_GET["controller"])) {
    $controller = $_GET["controller"];
    } else {
    $controller = "defaultController";
    }

    if ($controller == "equipe") {
    $ctl = new EquipeController();
    }elseif ($controller == "joueur") {
        $ctl = new JoueurController();
    }else{
            $ctl = new InterfaceController();
    }


    if(isset($_GET['action']) && !empty($_GET['action'])){
    if($_GET['action']=='add'){
    $ctl->pageAdd();
    }

    if($_GET['action']=='delete'){
    $ctl->remove();
    }
    if($_GET['action']=='save'){
    $ctl->save();
    }

    if($_GET['action']=='edit'){
    $ctl->edit();
    }

    if($_GET['action']=='updateEedit'){
    $ctl->updateEdit();
    }

    }else{
    $ctl->index();
    }