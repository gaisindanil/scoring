<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Client\Query\FindAll\Fetcher;
use App\Domain\Client\Query\FindAll\Query;
use App\Domain\Client\UseCase\Create\Command;
use App\Domain\Client\UseCase\Create\Form;
use App\Domain\Client\UseCase\Create\Handler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    private const PER_PAGE = 5;

    #[Route('/', name: 'client.create')]
    public function create(Request $request, Handler $handler): Response
    {
        $command = new Command();
        $form = $this->createForm(Form::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                $this->addFlash('success', 'Добавлен');

                return $this->redirectToRoute('client.list');
            } catch (\DomainException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->render('app/client/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/create/{id<\d+>}/edit", name: 'client.edit')]
    public function edit(Request $request, int $id, \App\Domain\Client\UseCase\Edit\Handler $handler, \App\Domain\Client\Query\FindOne\Fetcher $fetcher): Response
    {
        $findClient = $fetcher->one($id);
        if (null === $findClient) {
            throw new NotFoundHttpException('404 page not found');
        }

        $command = new \App\Domain\Client\UseCase\Edit\Command(
            $findClient->id,
            $findClient->first_name,
            $findClient->last_name,
            $findClient->phone,
            $findClient->email,
            $findClient->operator_id,
            $findClient->education_id,
            $findClient->consent_personal_data,
        );

        $form = $this->createForm(\App\Domain\Client\UseCase\Edit\Form::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $handler->handle($command);
                $this->addFlash('success', 'Изменено');

                return $this->redirectToRoute('client.list');
            } catch (\DomainException $exception) {
                $this->addFlash('error', $exception->getMessage());
            }
        }

        return $this->render('app/client/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/create/{id<\d+>}/view", name: 'client.view')]
    public function view(Request $request, int $id, \App\Domain\Client\Query\FindOne\Fetcher $fetcher): Response
    {
        $findClient = $fetcher->one($id);
        if (null === $findClient) {
            throw new NotFoundHttpException('404 page not found');
        }

        return $this->render('app/client/view.html.twig', [
            'client' => $findClient,
        ]);
    }

    #[Route('/list', name: 'client.list')]
    public function list(Request $request, Fetcher $fetcher): Response
    {
        $query = new Query();

        $pagination = $fetcher->all(
            $query,
            $request->query->getInt('page', 1),
            self::PER_PAGE
        );

        return $this->render('app/client/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }
}
