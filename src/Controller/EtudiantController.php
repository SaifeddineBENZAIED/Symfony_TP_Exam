<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\AddEtudiantType;
use App\Form\EditEtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/etudiant')]
class EtudiantController extends AbstractController
{
    #[Route('/', name: 'etudiant.list')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repo = $doctrine->getRepository(Etudiant::class);
        $etudiants = $repo->findAll();
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }

    #[Route('/add/{id?0}', name: 'etudiant.add')]
    public function addPerson(Request $request, ManagerRegistry $doctrine, Etudiant $etudiant = null): Response
    {
        if(!$etudiant) {
            $etudiant = new Etudiant();
            $etudForm = $this->createForm(AddEtudiantType::class, $etudiant);
            $etudForm->handleRequest($request);
            if ($etudForm->isSubmitted() && $etudForm->isValid()) {
                $repo = $doctrine->getManager();
                $repo->persist($etudiant);
                $repo->flush();
                $this->addFlash('success', 'Etudiant ajouté avec succes');
                return $this->redirectToRoute('etudiant.list');
            } else {
                return $this->render('etudiant/add.html.twig', [
                    'etudForm' => $etudForm->createView()
                ]);
            }
        }else{
            $this->addFlash('error','Etudiant déja existant');
            return $this->redirectToRoute('etudiant.list');
        }
    }

    #[Route('/edit/{id?0}', name: 'etudiant.edit')]
    public function editPerson(Request $request, ManagerRegistry $doctrine,$id, Etudiant $etudiant = null): Response
    {
        if(!$etudiant) {
            $this->addFlash('error',"Etudiant inexistant , voulez vous de l'ajouter ?");
            return $this->redirectToRoute('etudiant.add',[
                'id'=>$id
            ]);
        }else {
            $etudForm = $this->createForm(EditEtudiantType::class , $etudiant);
            $etudForm->handleRequest($request);
            if ($etudForm->isSubmitted()) {
                $etud=$etudForm->getData();
                $man = $doctrine->getManager();
                $man->persist($etud);
                $man->flush();
                $this->addFlash('success', 'Etudiant modifié avec succes');

                return $this->redirectToRoute('etudiant.list');
            } else {
                return $this->render('etudiant/edit.html.twig', [
                    'etudForm' => $etudForm->createView()
                ]);
            }
        }
    }

    #[Route('/delete/{id?0}', name: 'etudiant.delete')]
    public function deletePerson(ManagerRegistry $doctrine, Etudiant $etudiant = null): Response
    {
        if(!$etudiant) {
            $this->addFlash('error',"Etudiant déja inexistant");
        }else {
                $man = $doctrine->getManager();
                $man->remove($etudiant);
                $man->flush();
                $this->addFlash('success', 'Etudiant supprimé avec succes');
            }
        return $this->redirectToRoute('etudiant.list');
        }
}
