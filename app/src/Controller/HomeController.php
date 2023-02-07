<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\User\UseCase\Signup\Command;
use App\Domain\User\UseCase\Signup\Form;
use App\Domain\User\UseCase\Signup\Handler;
use DomainException;
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

        $command = new Command();
        $form = $this->createForm(Form::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                $this->addFlash('success', 'Объект отредактирован');
                return $this->redirectToRoute('signup');
            } catch (DomainException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return  $this->render('user/signup.html.twig', [
            'form' => $form->createView()
        ]);

    }
}