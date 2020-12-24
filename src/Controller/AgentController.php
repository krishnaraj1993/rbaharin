<?php

namespace App\Controller;

use App\Entity\ApplicationUsers;
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

class AgentController extends AbstractController
{
    /**
     * @Route("application/agent/{id}", name="agent")
     */
    public function index($id, TableMakerService $tableGenerate): Response
    {
        $repository = $this->getDoctrine()->getRepository(ApplicationUsers::class);
        $userList = $repository->listUsers('ROLE_AGENT', $id);
        $tableGenerate->tableHeader = array('First Name', 'Last Name', 'Email', 'Mobile Number', 'Status');
        $userArry = [];
        $actionsList = [];
        foreach ($userList as $key => $value) {
            $userArry[] = array(
                $value['firstname'] => array('type'=>'text', 'name' => ucfirst($value['firstname']), 'link' => '' . $value['id'] . '/dashboard'),
                $value['lastname'] => array('type'=>'text', 'name' => $value['lastname']),
                $value['userId']['email'] => array('type'=>'text', 'name' => $value['userId']['email']),
                $value['mobilenumber'] => array('type'=>'text', 'name' => $value['mobilenumber']),
                $value['status'] == '1' ? 'ACTIVE' : 'INACTIVE' => array('type'=>'text', 'name' => $value['status'] == '1' ? 'ACTIVE' : 'INACTIVE'),
            );
            $actionsList[] = array('Update' => array('name' => 'success', 'link' => '/application/new-users?id=' . $value['id']), 'Delete' => array('name' => 'danger', 'link' => '#'));
        }

        $tableGenerate->tableBody = $userArry;
        $tableGenerate->tableActions = $actionsList;

        $content = $tableGenerate->tableRender();
        return $this->render('agent/index.html.twig', [
            'tableData' => $content, 'agent' => $id,
        ]);
    }

    /**
     * @Route("application/agent/{id}/new-users", name="new_agent")
     */
    public function newUser($id, Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppAuthenticationAuthenticator $authenticator): Response
    {
        try {
            $data['email'] = " ";
            $data['plainPassword'] = " ";
            $data['firstname'] = " ";
            $data['lastname'] = " ";
            $data['mobile'] = " ";
            $data['address'] = " ";
            $data['id'] = 0;
            if ($request->isMethod('post')) {
                $user = new Users();
                $postData = $request->request->all();
                // encode the plain password
                $user->setEmail($postData['email']);
                $user->setRoles([$postData['userrole']]);
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
                $appUser->setFirstname($postData['firstname']);
                $appUser->setLastname($postData['lastname']);
                $appUser->setMobilenumber($postData['mobile']);
                $appUser->setAddress($postData['address']);
                $appUser->setUserId($userId);
                $appUser->setStatus(1);
                $appUser->setSubUsers($this->getDoctrine()->getRepository(ApplicationUsers::class)->findOneById($id));
                $appUser->setCreateAt(\DateTime::createFromFormat('Y-m-d H:i:s', $date));
                $appUser->setCreatedBy('User');
                $appUser->setLastActivityDate(\DateTime::createFromFormat('Y-m-d H:i:s', $date));
                $entityManager->persist($appUser);
                $entityManager->flush();
                /*return $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $authenticator,
            'main' // firewall name in security.yaml
            );*/
            }
        } catch (\Exception $e) {

        }
        return $this->render('agency/newUser.html.twig', [
            'registrationForm' => '',
            'role' => 'ROLE_AGENT',
            'id' => $id,
            'data'=>$data,
        ]);
    }

    /**
     * @Route("application/agent/{id}/user-update", name="update_agent")
     */
    public function updateUser($id,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator
    ): Response {
        return $this->render('agent/newUser.html.twig', [
            'registrationForm' => '', 'role' => 'ROLE_AGENT', 'id' => $id,
        ]);
    }

    /**
     * @Route("application/agent/{id}/dashboard", name="agent_dashashboard")
     */
    public function agentDashboard($id,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator,
        UserFunctionService $userFunctionService
    ): Response {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userArry = $userFunctionService->getLoginUserDetails('id', $id);
        $propertyCount = $userFunctionService->getPropertiesCount($id);
        return $this->render('agent/dashboard.html.twig', [
            'registrationForm' => '',
            'role' => 'ROLE_AGENT',
            'data' => $userArry,
            'propertyCount' => $propertyCount,
        ]);
    }
}
