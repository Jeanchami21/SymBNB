<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        
        $ads = $repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet de créer une annonce
     *
     * @Route("/ads/new", name="ads_create")
     * @return Response
     */
    public function create() {
        $ad = new Ad();
        $form = $this->createFormBuilder($ad)
                     ->add('title')
                     ->add('introduction')
                     ->add('content')
                     ->add('rooms')
                     ->add('price')
                     ->add('coverImage')
                     ->add('save', SubmitType::class, [
                         'label' => 'Créer la nouvelle annonce',
                         'attr' => [
                             'class' => 'btn btn-primary'
                         ]
                     ])
                     ->getForm();

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * Permet d'afficher une seule annonce
     * 
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */
    public function show($slug, Ad $ad) {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }
}
