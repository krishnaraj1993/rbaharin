<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\ApplicationUsers;
use App\Entity\UserPlan;
use App\Entity\Users;
use App\Security\AppAuthenticationAuthenticator;
use App\Service\TableMakerService;
use App\Service\UserFunctionService;
use App\Constants\StatusConstants;
use Symfony\Component\HttpFoundation\JsonResponse;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->render('admin/index.html.twig', [
                'controller_name' => 'AdminController',
            ]);
        } else {
            return $this->redirectToRoute('app_login');
        }
    }

    /**
     * @Route("application/config", name="config")
     */
    public function config()
    {
        return $this->render('admin/config.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/application/admin/approve-plan/{plan}/{user}", name="plan_approve")
     */
    public function adminPlanChange(
        $plan,
        $user,
        Request $request,
        UserFunctionService $userFunctionService,
        TableMakerService $tableGenerate
    ): Response {
        try {
            $userPlan = $this->getDoctrine()->getRepository(UserPlan::class)->findOneById($plan);
            $apprepository = $this->getDoctrine()->getRepository(ApplicationUsers::class)->findOneById($user);
            $apprepository->setPlanStatus(StatusConstants::ACTIVE);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apprepository);
            $entityManager->flush();
            return $response = new JsonResponse(['result' => 1, 'message'=>'Plan updated successfully']);
        } catch (Exception $e) {
            return $response = new JsonResponse(['result' => 0, 'message'=>'Plan updation fail']);
        }
        
    }


    /**
     * @Route("/application/{id}/profile", name="user_profile")
     */
    public function userProfile(
        $id,
        Request $request,
        UserFunctionService $userFunctionService
    ): Response {
        try {
            $userProfile = $this->getDoctrine()->getRepository(ApplicationUsers::class)->profile($id);
            return $this->render('admin/profile.html.twig', [
                'data' => $userProfile[0],
            ]);
        } catch (Exception $e) {
            return $response = new JsonResponse(['result' => 0, 'message'=>'Plan updation fail']);
        }
        
    }

    /**
     * @Route("/application/{id}/change-password", name="user_change_password")
     */
    public function userChangePassword(
        $id,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        UserFunctionService $userFunctionService
    ): Response {
        try {
            $postData = $request->request->all();
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $postData['plainPassword']
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Password changed successfully');
            return $this->redirectToRoute('user_profile',['id' => $id]);
        } catch (Exception $e) {
            $this->addFlash('error', 'Error on Password changing process');
            return $response = new JsonResponse(['result' => 0, 'message'=>'Plan updation fail']);
        }
        
    }
}