<?php

namespace App\Controller;

use App\Entity\LeaveRequest;
use App\Entity\Enum\StatusEnum;
use App\Form\LeaveRequestFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LeaveRequestRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class LeaveRequestController extends AbstractController
{
    #[Route('/leave/request', name: 'app_leave_request')]
    public function index(Request $request, EntityManagerInterface $entityManager, LeaveRequestRepository $leaveRequestRepository): Response
    { 
        $leaveRequest = new LeaveRequest();
        $form = $this->createForm(LeaveRequestFormType::class, $leaveRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $leaveRequest->setUser($this->getUser());
            $leaveRequest->setStatus(StatusEnum::Submitted);    
            $entityManager->persist($leaveRequest);
            $entityManager->flush();

            return $this->redirectToRoute('app_leave_request');

        }
        return $this->render('leave_request/index.html.twig', [
            'controller_name' => 'LeaveRequestController',
            'form' => $form->createView(),
            'leaveRequests' => $leaveRequestRepository->findBy(['user' => $this->getUser()])
        ]);
    }
}
