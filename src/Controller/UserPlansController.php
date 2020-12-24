<?php

namespace App\Controller;

use App\Entity\UserPlan;
use App\Service\TableMakerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserPlansController extends AbstractController
{
    /**
     * @Route("/application/plans", name="user_plans")
     */
    public function index(TableMakerService $tableGenerate): Response
    {
        $repository = $this->getDoctrine()->getRepository(UserPlan::class);
        $userplans = $repository->getAll();
        $tableGenerate->tableHeader = array(
            'Title',
            'Description',
            'BHD',
            '6th Month Package',
            'Annual Package',
            'Promo Package',
            'Listing',
            'CRM',
            'Agents',
        );
        $userplans = $repository->getAll();

        foreach ($userplans as $key => $value) {
            $userArry[] = array(
                $value['title'] . "_1" => array('type'=>'text','name' => ucfirst($value['title']), 'link' => "#"),
                $value['description'] . "_2" => array('type'=>'text','name' => $value['description'], 'style' => 'width: 20%'),
                $value['bhd'] . "_3" => array('type'=>'text','name' => "BHD ".$value['bhd']),
                $value['sixMonthPackage'] . "_4" => array('type'=>'text','name' => "BHD ".$value['sixMonthPackage']),
                $value['annualPackage'] . "_5" => array('type'=>'text','name' => "BHD ".$value['annualPackage']),
                $value['promoAnnual'] . "_6" => array('type'=>'text','name' => $value['promoAnnual']),
                $value['listing'] . "_7" => array('type'=>'text','name' => $value['listing']),
                $value['crm'] . "_8" => array('type'=>'text','name' => $value['crm']==1?"Yes":"No"),
                $value['agents'] . "_9" => array('type'=>'text','name' => $value['agents']),

            );
            $actionsList[] = array(
                'Update' => array('type'=>'button','name' => 'info', 'link' => 'new-plan/' . $value['id']),
                'Delete' => array('type'=>'button','name' => 'danger', 'link' => '#')
            );
        }
        $tableGenerate->tableBody = $userArry;
        $tableGenerate->tableActions = $actionsList;
        $content = $tableGenerate->tableRender();
        return $this->render('user_plans/index.html.twig', [
            'tableData' => $content,
        ]);
    }

    /**
     * @Route("/application/new-plan/{id}", name="new_plans")
     */
    public function newPlan(Request $request, $id = null): Response
    {
        if ($request->isMethod('post')) {
            $entityManager = $this->getDoctrine()->getManager();
            $bytes = random_bytes(16);
            $postData = $request->request->all();
            if (empty($postData['id'])) {
                $userPlan = new UserPlan();
            }else{
                $userPlan = $this->getDoctrine()->getRepository(UserPlan::class)->findOneById($postData['id']);
            }
            $userPlan->setTitle($postData['title']);
            $userPlan->setDescription($postData['description']);
            //$userPlan->setPlancode(bin2hex($bytes));
            $userPlan->setBhd($postData['bhd']);
            $userPlan->setSixMonthPackage($postData['sixmp']);
            $userPlan->setAnnualPackage($postData['annualpack']);
            $userPlan->setPromoAnnual($postData['promopack']);
            $userPlan->setListing($postData['listing']);
            $userPlan->setCrm($postData['crm']);
            $userPlan->setAgents($postData['agent']);
            $userPlan->setFetured($postData['fetured']);
            $userPlan->setPremium($postData['promo']);
            $entityManager->persist($userPlan);
            $entityManager->flush();
        } else {
            $postData['title'] = "";
            $postData['description'] = "";
            $postData['bhd'] = "";
            $postData['sixmp'] = "";
            $postData['annualpack'] = "";
            $postData['promopack'] = "";
            $postData['listing'] = "";
            $postData['crm'] = "";
            $postData['agent'] = "";
            $postData['fetured'] = "";
            $postData['id'] = "";
            $postData['promo'] = "";
            if (!empty($id)) {
                $userPlan = $this->getDoctrine()->getRepository(UserPlan::class)->findOneById($id);
                $postData['id'] = $userPlan->getId();
                $postData['title'] = $userPlan->getTitle();
                $postData['description'] = $userPlan->getDescription();
                $postData['bhd'] = $userPlan->getBhd();
                $postData['sixmp'] = $userPlan->getSixMonthPackage();
                $postData['annualpack'] = $userPlan->getAnnualPackage();
                $postData['promopack'] = $userPlan->getPromoAnnual();
                $postData['listing'] = $userPlan->getListing();
                $postData['crm'] = $userPlan->getCrm();
                $postData['agent'] = $userPlan->getAgents();
                $postData['fetured'] = $userPlan->getFetured();
                $postData['promo'] = $userPlan->getPremium();
            }
        }

        return $this->render('user_plans/new.html.twig', [
            'data' => $postData,
        ]);
    }
}
