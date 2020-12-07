<?php
namespace App\Service;

use App\Entity\UserPlan;
use App\Service\TableMakerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class UserPlanService extends AbstractController
{
    public function getUserPlan(TableMakerService $tableGenerate)
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
                $value['title'] . "_1" => array('name' => ucfirst($value['title']), 'link' => "#"),
                $value['description'] . "_2" => array('name' => $value['description'], 'style' => 'width: 20%'),
                $value['bhd'] . "_3" => array('name' => "BHD ".$value['bhd']),
                $value['sixMonthPackage'] . "_4" => array('name' => "BHD ".$value['sixMonthPackage']),
                $value['annualPackage'] . "_5" => array('name' => "BHD ".$value['annualPackage']),
                $value['promoAnnual'] . "_6" => array('name' => $value['promoAnnual']),
                $value['listing'] . "_7" => array('name' => $value['listing']),
                $value['crm'] . "_8" => array('name' => $value['crm']==1?"Yes":"No"),
                $value['agents'] . "_9" => array('name' => $value['agents']),

            );
            $actionsList[] = array('Update' => array('name' => 'info', 'link' => 'new-plan/' . $value['id']), 'Delete' => array('name' => 'danger', 'link' => '#'));
        }
        $tableGenerate->tableBody = $userArry;
        $tableGenerate->tableActions = $actionsList;
        return $tableGenerate->tableRender();
    }
}
