<?php

class JoueurModel{
    function getAll(){
        global $entityManager;
        $joueurs = $entityManager->getRepository(Joueur::class)->findAll();
        return $joueurs;
    }

    function getJoueurById($id){
        global $entityManager;
        $joueur= $entityManager->getRepository(Joueur::class)->find($id);
        return $joueur;
    }

    function getAllEquipJ(){
        global $entityManager;
        $equipes = $entityManager->getRepository(Equipe::class)->findAll();
        return $equipes;
    }

    function delete($id){
        global $entityManager;
        $joueur = $entityManager->getRepository(Joueur::class)->find($id);
        $entityManager->remove($joueur);
        $entityManager->flush();
    }

    function add($nom,$prenom, $age, $equipe_id){
        global $entityManager;
        $equipe = $entityManager->getRepository(Equipe::class)->find($equipe_id);
        $joueur = new Joueur();
        $nbJoueurs = $entityManager->getRepository(Joueur::class)->count(['equipe' => $equipe]);
        if ($nbJoueurs >= 5) {
            throw new Exception("Une équipe ne peut contenir que 5 joueurs.");
        }
        $joueur->setNom($nom);
        $joueur->setPrenom($prenom);
        $joueur->setAge($age);
        $joueur->setEquipe($equipe);
        $entityManager->persist($joueur);
        $entityManager->flush();
    }

    function update($id, $nom,$prenom, $age, $equipe_id){
        global $entityManager;
        $equipe = $entityManager->getRepository(Equipe::class)->find($equipe_id);
        $joueur = $entityManager->find(Joueur::class, $id);
        $joueur->setNom($nom);
        $joueur->setPrenom($prenom);
        $joueur->setAge($age);
        $joueur->setEquipe($equipe);
        $entityManager->persist($joueur);
        $entityManager->flush();
    }
}