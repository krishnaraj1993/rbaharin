<?php

namespace App\Controller;

use App\Entity\ApplicationUsers;
use App\Entity\{Users,UserPlan};
use App\Security\AppAuthenticationAuthenticator;
use App\Service\TableMakerService;
use App\Service\UserFunctionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class FsboController extends AbstractController
{
    
    /**
     * @Route("application/fsbo/{id}/dashboard", name="agent_dash")
     */
    public function agentDashboard($id,
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        AppAuthenticationAuthenticator $authenticator,
        UserFunctionService $userFunctionService,
        TableMakerService $tableGenerate
    ): Response {

        $planList = $this->getDoctrine()->getRepository(UserPlan::class)->getAll();
        $userArry = $userFunctionService->getLoginUserDetails('id', $id);
        $tableGenerate->tableHeader = array('Title', 'Description', 'BHD', '6th Month Package');
        $planArry = [];
        $actionsList = [];
        foreach ($planList as $key => $value) {
            $planArry[] = array(
                $value['title']."_1" => array('type'=>'text', 'name' => ucfirst($value['title'])),
                $value['description']."_2" => array('type'=>'text', 'name' => $value['description']),
                $value['bhd']."_3" => array('type'=>'text', 'name' => $value['bhd']),
                $value['sixMonthPackage']."_4" => array('type'=>'text', 'name' => $value['sixMonthPackage']),
            );
            $rowActionsAry['config'][]['tr'] = array('style'=>$userArry['plan']->getId()==$value['id']?"background-color: #b1d2b1;":"");
            $actionsList[] = array('View Details' => array('name' => 'info', 'link' => 'new-users?id=' . $value['id']), 'Activate' => array('name' => 'danger', 'link' => '#'));
        }
        $tableGenerate->tableBody = $planArry;
        $tableGenerate->rowActions = $rowActionsAry;
        $tableGenerate->tableActions = $actionsList;
        $content = $tableGenerate->tableRender();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userArry = $userFunctionService->getLoginUserDetails('id', $id);
        $propertyCount = $userFunctionService->getPropertiesCount($id);
        return $this->render('fsbo/dashboard.html.twig', [
            'registrationForm' => '',
            'role' => 'ROLE_FSBO',
            'data' => $userArry,
            'tableData' => $content,
            'propertyCount' => $propertyCount,
        ]);
    }
}
