<?php

namespace App\Controller;

use App\Entity\Section;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/section')]
class SectionController extends AbstractController
{
    #[Route('/', name: 'section.list')]
    public function index(): Response
    {
        return $this->render('section/index.html.twig', [
            'controller_name' => 'SectionController',
        ]);
    }

    #[Route('/selectbyname', name: 'section.select.name')]
    public function selectbyname(ManagerRegistry $doctrine,$tab,$position): Response
    {
        $repo = $doctrine->getRepository(Section::class);
        $mySection = $repo->findOneBy(['designation'=>$tab[$position]]);
        return $mySection;
    }
}
