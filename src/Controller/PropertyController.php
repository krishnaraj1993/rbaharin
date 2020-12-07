<?php

namespace App\Controller;

use App\Entity\ApplicationAssets;
use App\Entity\Ewa;
use App\Entity\Features;
use App\Entity\Furnishing;
use App\Entity\Property;
use App\Entity\PropertyDetails;
use App\Entity\PropertyStatus;
use App\Entity\PropertyType;
use App\Entity\Users;
use App\Service\TableMakerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("application/properties/{id}", name="property")
     */
    public function index(TableMakerService $tableGenerate, $id = null): Response
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $repository = $this->getDoctrine()->getRepository(Property::class);
        if (!empty($id)) {
            $property = $repository->getAllByUser($id);
        } else {
            $property = $repository->getAll();
        }

        $tableGenerate->tableHeader = array('Title', 'Description', 'Investment', 'Building Name', 'Location');
        $propertyArry = [];
        $actionsList = [];
        if (!empty($property)) {
            foreach ($property as $key => $value) {
                $propertyArry[] = array(
                    $value['Title'] . "1" => array('name' => ucfirst($value['Title']), 'link' => '/application/property/' . $value['id']),
                    $value['description'] . "2" => array('name' => substr($value['description'].".....", 0, 100)),
                    $value['investment'] . "3" => array('name' => $value['investment']),
                    $value['buildingName'] . "4" => array('name' => $value['buildingName']),
                    $value['location'] . "5" => array('name' => $value['location']),
                );
                //$actionsList[] = array('Update' => array('name' => 'success', 'link' => 'new-users?id=' . $value['id']), 'Delete' => array('name' => 'danger', 'link' => '#'));
            }
        }
        $tableGenerate->tableBody = $propertyArry;
        $tableGenerate->tableActions = $actionsList;

        $content = $tableGenerate->tableRender();
        return $this->render('property/index.html.twig', [
            'tableData' => $content,
            'id' => $user->getId(),
        ]);
    }

    /**
     * @Route("application/properties/add/{id}", name="property_new")
     */
    public function add(Request $request, $id = null): Response
    {
        $propertyStatus = $this->getDoctrine()->getRepository(PropertyStatus::class)->feathAll();
        $propertyType = $this->getDoctrine()->getRepository(PropertyType::class)->feathAll();
        $Ewa = $this->getDoctrine()->getRepository(Ewa::class)->feathAll();
        $Features = $this->getDoctrine()->getRepository(Features::class)->feathAll();
        $Furnishing = $this->getDoctrine()->getRepository(Furnishing::class)->feathAll();

        if ($request->isMethod('post')) {
            $requestParam = $request->request->all();
            $this->propertySave($requestParam,$id);
        }
        $Property[] = array(
            'id' => 0,
            'Title' => '',
            'description' => '',
            'investment' => '',
            'buildingName' => '',
            'location' => '',
            'value' => '',
            'bedRooms' => '',
            'BathRooms' => '',
            'AreaSize' => '',
            'map' => '',
            'Mortgage' => '',
            'features' => '',
            'ewa' => '',
            'ptype' => '',
            'pstatus' => '',
            'furnishing' => '',
        );
        return $this->render('property/new.html.twig', [
            'tableData' => '',
            'propertyStatus' => $propertyStatus,
            'propertyType' => $propertyType,
            'Ewa' => $Ewa,
            'Features' => $Features,
            'Furnishing' => $Furnishing,
            'Property' => $Property[0],
        ]);
    }

    public function propertySave($param, $id=null)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $propertyStatus = $this->getDoctrine()->getRepository(PropertyStatus::class)->findOneBy(['id' => $param['status']]);
        $propertyType = $this->getDoctrine()->getRepository(PropertyType::class)->findOneBy(['id' => $param['ptype']]);
        $Ewa = $this->getDoctrine()->getRepository(Ewa::class)->findOneBy(['id' => $param['ewa']]);
        $Features = $this->getDoctrine()->getRepository(Features::class)->findOneBy(['id' => $param['pfeatures']]);
        $userId = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $user->getId()]);
        $Furnishing = $this->getDoctrine()->getRepository(Furnishing::class)->findOneBy(['id' => $param['furnishing']]);
        $entityManager = $this->getDoctrine()->getManager();
        if(empty($id)){
            $property = new Property();
        }else{
            $property = $this->getDoctrine()->getRepository(Property::class)->findOneBy(['id' => $id]);
        }
        
        $property->setTitle($param['title']);
        $property->setDescription($param['about']);
        $property->setPropertyStatus($propertyStatus);
        $property->setPropertyType($propertyType);
        $property->setInvestment(10000);
        $property->setEwa($Ewa);
        $property->setFurnishing($Furnishing);
        $property->setBuildingName('test');
        $property->setLocation('test');
        $property->setValue($param['pvalue']);
        $property->setAddress(null);
        $property->setFeatures(implode(",", $param['pfeatures']));
        $property->setBedRooms($param['bedRooms']);
        $property->setBathRooms($param['bathRooms']);
        $property->setAreaSize($param['area_heigh'] . "x" . $param['area_weight']);
        $property->setDateofupdated(new \DateTime('now'));
        $property->setMap('map');
        $property->setCreatedBy($userId);
        $property->setCreatedAt(new \DateTime('now'));
        $property->setMortgage($param['mortgage']);
        $entityManager->persist($property);
        $entityManager->flush();
        $assets = $param['assets'];
        $assetObject = [];
        foreach ($assets as $key => $base64Image) {
            $data = explode(',', $base64Image);
            $ext = "";
            switch ($data[0]) {
                case "data:image/png;base64";
                    $ext = "png";
                    break;
                case "data:image/jpg;base64";
                    $ext = "jpg";
                    break;
                case "data:image/jpeg;base64";
                    $ext = "jpg";
                    break;
                case "data:image/gif;base64";
                    $ext = "gif";
                    break;
                case "data:image/webp;base64";
                    $ext = "webp";
                    break;
            }
            $fileName = time() . '-user.' . $ext;

            $base64Image = trim($base64Image);
            $base64Image = str_replace('data:image/png;base64,', '', $base64Image);
            $base64Image = str_replace('data:image/jpg;base64,', '', $base64Image);
            $base64Image = str_replace('data:image/jpeg;base64,', '', $base64Image);
            $base64Image = str_replace('data:image/gif;base64,', '', $base64Image);
            $base64Image = str_replace(' ', '+', $base64Image);
            $imageData = base64_decode($base64Image);
            $filePath = 'assets/appImage/user/' . $user->getEmail() . "/" . $fileName;
            file_put_contents($filePath, $imageData);
            $applicationAssets = new ApplicationAssets();
            $applicationAssets->setProperty($property);
            $applicationAssets->setUrl($filePath);
            $applicationAssets->setType('Property');
            $applicationAssets->setTitle('test');
            $applicationAssets->setDescription('test');
            $entityManager->persist($applicationAssets);
            $entityManager->flush();

            $propertyDetails = new PropertyDetails();
            $propertyDetails->setSeoTags($param['tags']);
            $propertyDetails->setParent($property);
            $entityManager->persist($propertyDetails);
            $entityManager->flush();
        }

    }

    /**
     * @Route("application/property/{id}", name="property_view")
     */
    public function singleView(Request $request, $id = null): Response
    {
        $property = $this->getDoctrine()->getRepository(Property::class)->find($id);
        $propertyAssets = $this->getDoctrine()->getRepository(ApplicationAssets::class)->findBy(['property' => $id]);

        $propertyArry = array();
        $propertyArry['name'] = $property->getTitle();
        $propertyArry['id'] = $property->getId();
        $propertyArry['description'] = $property->getDescription();
        foreach ($propertyAssets as $key => $obj) {
            $propertyArry['images'][] = $obj->getUrl();
        }
        return $this->render('property/single.html.twig', [
            'propertyDetails' => $propertyArry]);
    }

    /**
     * @Route("application/property/{id}/edit", name="property_edit")
     */
    public function Propertyedit(Request $request, $id = null): Response
    {
        $propertyStatus = $this->getDoctrine()->getRepository(PropertyStatus::class)->feathAll();
        $propertyType = $this->getDoctrine()->getRepository(PropertyType::class)->feathAll();
        $Ewa = $this->getDoctrine()->getRepository(Ewa::class)->feathAll();
        $Features = $this->getDoctrine()->getRepository(Features::class)->feathAll();
        $Furnishing = $this->getDoctrine()->getRepository(Furnishing::class)->feathAll();
        $Property = $this->getDoctrine()->getRepository(Property::class)->getAllById($id);

        if (empty($Property)) {
            $Property[] = array(
                'id' => 0,
                'Title' => '',
                'description' => '',
                'investment' => '',
                'buildingName' => '',
                'location' => '',
                'value' => '',
                'bedRooms' => '',
                'BathRooms' => '',
                'AreaSize' => '',
                'map' => '',
                'Mortgage' => '',
                'features' => '',
                'ewa' => '',
                'ptype' => '',
                'pstatus' => '',
                'furnishing' => '',
            );
        } else {
            $Property[0][0]['pstatus'] = $Property[0]['pstatus'];
            $Property[0][0]['ptype'] = $Property[0]['ptype'];
            $Property[0][0]['ewa'] = $Property[0]['ewa'];
            $Property[0][0]['furnishing'] = $Property[0]['furnishing'];
            $Property[0][0]['features'] = explode(',',$Property[0][0]['features']);
        }
        return $this->render('property/new.html.twig', [
            'tableData' => '',
            'propertyStatus' => $propertyStatus,
            'propertyType' => $propertyType,
            'Ewa' => $Ewa,
            'Features' => $Features,
            'Furnishing' => $Furnishing,
            'Property' => $Property[0][0],
        ]);
    }
}
