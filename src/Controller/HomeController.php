<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\RegisterFormType;
use App\Form\LeaveRequestFormType; 
use App\Entity\LeaveRequest; 
use App\Entity\User; 
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

final class HomeController extends AbstractController
{
    private $userPasswordHasher;
    private $entityManager;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('user/homePage.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    #[Route('/leave-request', name: 'app_leave_request')]
    public function leaveRequest(Request $request): Response
    {
        $leaveRequest = new LeaveRequest();
        $form = $this->createForm(LeaveRequestFormType::class, $leaveRequest);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Save the leave request to the database
            // $entityManager->persist($leaveRequest);
            // $entityManager->flush();

            // Redirect or show a success message
        }

        return $this->render('congés/conge.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
