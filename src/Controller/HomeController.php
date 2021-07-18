<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\SocieteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CallApiService $callApiService, SocieteRepository $societeRepository): Response
    {
        // $call = $callApiService->getData('82912735600014');
        // dd($call);
        $societes = $societeRepository->findAll();
        return $this->render('home/index.html.twig', [
            'societes' => $societes,
        ]);
    }
}
