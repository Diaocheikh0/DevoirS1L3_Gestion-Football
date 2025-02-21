<?php
class EquipeModel{
    function getAll(){
        global $entityManager;
        $equipes = $entityManager->getRepository(Equipe::class)->findAll();
        return $equipes;

    }

    function getEquipeById($id){
        global $entityManager;
        $equipe = $entityManager->getRepository(Equipe::class)->find($id);
        return $equipe;
    }

    function delete($id){
        global $entityManager;
        $equipe = $entityManager->find(Equipe::class, $id);

        $nbJoueurs = $entityManager->getRepository(Joueur::class)->count(['equipe' => $equipe]);
        if ($nbJoueurs > 0) {
            throw new Exception("Impossible de supprimer une équipe contenant encore des joueurs.");
        }
        $entityManager->remove($equipe);
        $entityManager->flush();
    }

    function add($libelle){
        global $entityManager;
        $equipe = new Equipe();
        $equipe->setLibelle($libelle);
        $entityManager->persist($equipe);
        $entityManager->flush();
    }

    function update($id, $libelle){
        global $entityManager;
        $equipe = $entityManager->getRepository(Equipe::class)->find($id);
        $equipe->setLibelle($libelle);
        $entityManager->persist($equipe);
        $entityManager->flush();
    }
}
