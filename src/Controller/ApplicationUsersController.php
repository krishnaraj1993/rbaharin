<?php

namespace App\Controller;

use App\Entity\ApplicationUsers;
use App\Entity\UserPlan;
use App\Entity\Users;
use App\Security\AppAuthenticationAuthenticator;
use App\Service\TableMakerService;
use App\Service\UserFunctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Constants\StatusConstants;

class ApplicationUsersController extends AbstractController
{
    /**
     * @Route("/application/users", name="agency_users")
     */
    public function index(TableMakerService $tableGenerate): Response
    {
        $repository = $this->getDoctrine()->getRepository(ApplicationUsers::class);
        $userList = $repository->listUsers('ROLE_AGENCY,ROLE_FSBO');
        $tableGenerate->tableHeader = array('First Name', 'Last Name', 'Email', 'User Role', 'Mobile Number', 'Status');
        $userArry = [];
        $actionsList = [];
        foreach ($userList as $key => $value) {
            $userArry[] = array(
                $value['firstname'] => array('type'=>'text', 'name' => ucfirst($value['firstname']), 'link' => ($value['userId']['roles'][0] == 'ROLE_AGENCY') ? 'agent/' . $value['id'] : 'fsbo/' . $value['id'] . '/dashboard'),
                $value['lastname'] => array('type'=>'text', 'name' => $value['lastname']),
                $value['userId']['email'] => array('type'=>'text', 'name' => $value['userId']['email']),
                $value['userId']['roles'][0] => array('type'=>'text', 'name' => $value['userId']['roles'][0]),
                $value['mobilenumber'] => array('type'=>'text', 'name' => $value['mobilenumber']),
                $value['status'] == '1' ? 'ACTIVE' : 'INACTIVE' => array('type'=>'text', 'name' => $value['status'] == '1' ? 'ACTIVE' : 'INACTIVE'),
            );
            $actionsList[] = array('Update' => array('name' => 'info', 'link' => 'new-users?id=' . $value['id']), 'Delete' => array('name' => 'danger', 'link' => '#'));
        }

        $tableGenerate->tableBody = $userArry;
        $tableGenerate->tableActions = $actionsList;

        $content = $tableGenerate->tableRender();
        return $this->render('agency/index.html.twig', [
            'tableData' => $content,
        ]);
    }

    /**
     * @Route("/application/new-users", name="application_new_users")
     */
    public function newUser(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator,
        UserFunctionService $userFunctionService
    ): Response {
        try {
            $data['email'] = " ";
            $data['plainPassword'] = " ";
            $data['firstname'] = " ";
            $data['lastname'] = " ";
            $data['mobile'] = " ";
            $data['address'] = " ";
            $data['id'] = 0;

            if ($request->isMethod('post')) {
                $postData = $request->request->all();
                $user = new Users();
                if ($postData['id']) {
                    $user = $this->getDoctrine()->getRepository(Users::class)->findOneById($postData['id']);
                }
                $user->setEmail($postData['email']);
                if ($postData['id'] == 0) {
                    $user->setRoles([$postData['userrole']]);
                }
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $postData['plainPassword']
                    )
                );

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                // do anything else you need here, like send an email
                $userId = $user->getId();
                $date = date('Y-m-d H:i:s');

                $repository = $this->getDoctrine()->getRepository(Users::class);
                $userId = $repository->findOneById($userId);

                $appUser = new ApplicationUsers();
                if ($postData['id']) {
                    $appUser = $this->getDoctrine()->getRepository(ApplicationUsers::class)->findOneByUserId($postData['id']);
                }
                $appUser->setProfileImage('assets/appImage/user/admin@gmail.com/profile/profile.png');
                $appUser->setFirstname($postData['firstname']);
                $appUser->setLastname($postData['lastname']);
                $appUser->setMobilenumber($postData['mobile']);
                $appUser->setAddress($postData['address']);
                $appUser->setUserId($userId);
                $appUser->setStatus(1);
                $appUser->setCreateAt(\DateTime::createFromFormat('Y-m-d H:i:s', $date));
                $appUser->setCreatedBy('User');
                $appUser->setLastActivityDate(\DateTime::createFromFormat('Y-m-d H:i:s', $date));
                $entityManager->persist($appUser);
                $entityManager->flush();

                if ($postData['id']) {
                    $this->addFlash('success', 'User updated successfully!');
                } else {
                    $this->addFlash('success', 'New user created successfully!');
                }
                return $this->redirectToRoute('agency_users');
                /*return $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main' // firewall name in security.yaml
            );*/
            }
            if ($request->isMethod('get')) {
                $id = $request->query->get('id');
                if (!empty($id)) {
                    $apprepository = $this->getDoctrine()->getRepository(ApplicationUsers::class)->findOneById($id);
                    $userRepository = $this->getDoctrine()->getRepository(Users::class)->findOneById($apprepository->getUserId()->getId());

                    $data['email'] = $userRepository->getEmail();
                    $data['firstname'] = $apprepository->getFirstname();
                    $data['lastname'] = $apprepository->getLastname();
                    $data['mobile'] = $apprepository->getMobilenumber();
                    $data['address'] = $apprepository->getAddress();
                    $data['id'] = $userRepository->getId();
                }
            }
        } catch (\Exception $e) {
            $this->addFlash('error', 'Error Occured! Please contact system admin');
        }
        $usersTree = $userFunctionService->getUserTree('ROLE_ADMIN');
        return $this->render('agency/newUser.html.twig', [
            'registrationForm' => '',
            'role' => 'ROLE_AGENCY',
            'data' => $data,
        ]);
    }

    /**
     * @Route("/application/admin/dashboard", name="admin_profile")
     */
    public function adminDashboard(Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator,
        UserFunctionService $userFunctionService,
        UserFunctionService $userfunctions,
        TableMakerService $tableGenerate
    ): Response {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userArry = $userFunctionService->getLoginUserDetails('userId', $user->getId());
        $propertyCount = $userfunctions->getPropertiesCount($user->getId());
        $agencycount = $userfunctions->getAgencyCount();
        $agentsCount = $userfunctions->getAgentCount();
        #=======================================================================
        $planList = $this->getDoctrine()->getRepository(ApplicationUsers::class)->getRequestedPlansList();
        
        $tableGenerate->tableHeader = array('Requested User', 'mobile number', 'Requested Plan', 'Previous Plan');
        $planArry = [];
        $actionsList = [];
        foreach ($planList as $key => $value) {
            $planArry[] = array(
                $value['firstname'] . "_1" => array('type'=>'text', 'name' => ucfirst($value['firstname'].' '.$value['lastname'])),
                $value['mobilenumber'] . "_2" => array('type'=>'text', 'name' => $value['mobilenumber']),
                $value['title'] . "_3" => array('type'=>'text', 'name' => $value['title']),
                $value['ptitle'] . "_4" => array('type'=>'text', 'name' =>  $value['ptitle']),
            );
            
            $actionsList[] = array(
                'View Details' => array('type' => 'button', 'name' => 'info', 'link' => '#'), 
                'Approve' => array('type' => 'button', 'name' => 'danger planUpdate-btn', 'custom' => 'data-plan="' . $value['plan'] . '"data-user="' . $value['user'] . '"', 'link' => '#'));
        }
        $tableGenerate->tableBody = $planArry;
        $tableGenerate->tableActions = $actionsList;
        $content = $tableGenerate->tableRender();

        #=======================================================================
        return $this->render('admin/dashboard.html.twig', [
            'registrationForm' => '', 'role' => 'ROLE_ADMIN',
            'data' => $userArry,
            'propertyCount' => $propertyCount,
            'agencyCount' => $agencycount,
            'agentsCount' => $agentsCount,
            'tableData' => $content,
        ]);
    }

    /**
     * @Route("/application/agency/{id}/dashboard", name="agency_profile")
     */
    public function agencyDashboard(
        $id,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator,
        UserFunctionService $userFunctionService,
        TableMakerService $tableGenerate
    ): Response {
        $userArry = $userFunctionService->getLoginUserDetails('id', $id);
        $propertyCount = $userFunctionService->getPropertiesCount($id);
        $agentsCount = $userFunctionService->getAgentCount($id);
        $planList = $this->getDoctrine()->getRepository(UserPlan::class)->getAll();

        $tableGenerate->tableHeader = array('Title', 'Description', 'BHD', '6th Month Package');
        $planArry = [];
        $actionsList = [];
        foreach ($planList as $key => $value) {
            $planArry[] = array(
                $value['title'] . "_1" => array('type'=>'text', 'name' => ucfirst($value['title'])),
                $value['description'] . "_2" => array('type'=>'text', 'name' => $value['description']),
                $value['bhd'] . "_3" => array('type'=>'text', 'name' => 'BHD ' . $value['bhd']),
                $value['sixMonthPackage'] . "_4" => array('type'=>'text', 'name' => 'BHD ' . $value['sixMonthPackage']),
            );
            $rowActionsAry['config'][]['tr'] = array('style' => $userArry['plan']->getId() == $value['id'] ? "background-color: #b1d2b1;" : "");
            $actionsList[] = array('View Details' => array('name' => 'info', 'link' => 'new-users?id=' . $value['id']), 'Activate' => array('name' => 'danger activate-btn', 'custom' => 'data-id="' . $value['id'] . '"', 'link' => '#'));
        }
        $tableGenerate->tableBody = $planArry;
        $tableGenerate->rowActions = $rowActionsAry;
        $tableGenerate->tableActions = $actionsList;
        $content = $tableGenerate->tableRender();

        return $this->render('agency/dashboard.html.twig', [
            'registrationForm' => '',
            'role' => 'ROLE_AGENCY',
            'propertyCount' => $propertyCount,
            'data' => $userArry,
            'tableData' => $content,
            'agentsCount' => $agentsCount,
        ]);
    }

    /**
     * @Route("/application/agency/{id}/update-plan/{plan}", name="agency_plan_update")
     */
    public function agencyPlanChange(
        $id,
        $plan,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator,
        UserFunctionService $userFunctionService,
        TableMakerService $tableGenerate
    ): Response {
        try {
            $userPlan = $this->getDoctrine()->getRepository(UserPlan::class)->findOneById($plan);
            $apprepository = $this->getDoctrine()->getRepository(ApplicationUsers::class)->findOneById($id);
            $apprepository->setPrevPlan($apprepository->getCurrentPlan());
            $apprepository->setCurrentPlan($userPlan);
            $apprepository->setPlanStatus(StatusConstants::PENDING);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($apprepository);
            $entityManager->flush();
            return $response = new JsonResponse(['result' => 1, 'message'=>'Plan updated successfully']);
        } catch (Exception $e) {
            return $response = new JsonResponse(['result' => 0, 'message'=>'Plan updation fail']);
        }
        
    }

}
