<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\LibrariesService;

class ProfileController extends AbstractController
{
    public function __construct(LibrariesService $lib)
    {
        $this->lib = $lib;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request): Response
    {
        if ($request->request->get('search')) {
            $data = $this->lib->searchLibraries($request->request->get('search'));
        } else {
            $data = $this->lib->getLibraries();
        }


        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'data' => $data,
        ]);
    }
}