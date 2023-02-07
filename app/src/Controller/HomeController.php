<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\UseCase\Signup\Handler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route("/", name: "app")]
    public function index(): Response{

        return new Response("hello");
    }

    #[Route("/signup", name: "signup")]
    public function signup(Request $request, Handler $handler): Response{

        dd($handler);

    }
}