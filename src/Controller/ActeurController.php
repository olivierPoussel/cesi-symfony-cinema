<?php

namespace App\Controller;

use App\Entity\Acteur;
use App\Form\ActeurType;
use App\Repository\ActeurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/acteur")
 */
class ActeurController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ActeurRepository $acteurRepository)
    {
        $listActeur = $acteurRepository->findAll();

        return $this->render('acteur/list.html.twig', [
            'acteurs' => $listActeur,
        ]);
    }

    /**
     * @Route("/acteur/{id}", name="acteur_detail", requirements={"id"="\d+"})
     *
     * @param ActeurRepository $acteurRepository
     * @return void
     */
    public function acteurDetail(Acteur $acteur)
    {
        // $idActeur = $request->get('id');
        // $acteur = $acteurRepository->find($id);

        return $this->render('acteur/acteur.html.twig', [
            'acteur' => $acteur,
        ]);
    }

    /**
     * @Route("/acteur/create", name="acteur_create")
     * @IsGranted("ROLE_ADMIN")
     * 
     * @return void
     */
    public function createActeur(Request $request, ManagerRegistry $doctrine)
    {
        $acteur = new Acteur();
        // $form = $this->createFormBuilder($acteur)
        //     ->add('nom', TextType::class)
        //     ->add('prenom', TextType::class)
        //     // ->add('email', EmailType::class)
        //     ->add('submit', SubmitType::class)
        //     ->getForm();
        $form = $this->createForm(ActeurType::class, $acteur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($acteur);
            $manager = $doctrine->getManager();
            $manager->persist($acteur);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('acteur/form/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
