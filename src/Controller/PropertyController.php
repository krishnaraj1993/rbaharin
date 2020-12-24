<?php

namespace App\Controller;

use App\Constants\StatusConstants;
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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("application/properties/{id}", name="property")
     */
    public function index(
        TableMakerService $tableGenerate,
        $id = null,
        Request $request
    ): Response {
        $requestData = $request->query->all();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $roles = $user->getRoles()[0];
        #=====================Pagination================================
        $page = !empty($requestData['page']) ? $requestData['page'] : 1;
        $requestData['page'] = !empty($requestData['page']) && ($requestData['page'] != 1) ? (5 + $requestData['page']) : 1;
        #=====================Pagination================================
        $repository = $this->getDoctrine()->getRepository(Property::class);
        if (!empty($id) && $roles != 'ROLE_ADMIN') {
            $property = $repository->getAllByUser($id, $requestData);
        } else {
            $property = $repository->getAll($requestData);
        }
        $tableGenerate->tableHeader = array('Title', 'Investment', 'Building Name', 'Location', 'Status');
        $propertyArry = [];
        $actionsList = [];
        if (!empty($property)) {
            foreach ($property as $key => $value) {
                $propertyArry[] = array(
                    $value['Title'] . "1" => array('type' => 'text', 'name' => ucfirst($value['Title']), 'link' => '/application/property/' . $value['id']),
                    $value['investment'] . "3" => array('type' => 'text', 'name' => $value['investment']),
                    $value['buildingName'] . "4" => array('type' => 'text', 'name' => $value['buildingName']),
                    $value['location'] . "5" => array('type' => 'text', 'name' => $value['location']),
                    "status_check" => array('type' => 'checkbox', 'name' => 'status', 'id' => $value['id'], 'css' => 'class="product_activitaion"', 'checked' => $value['status']),
                );
                $actionsList[] = array(
                    'Update' => array('type' => 'button', 'name' => 'info', 'link' => '/application/property/' . $value['id'] . '/edit'),
                    'Delete' => array('type' => 'button', 'name' => 'danger deleteProperty-btn', 'custom' => 'data-id="' . $value['id'] . '"', 'link' => '#'),
                );
            }
        }
        $tableGenerate->tableBody = $propertyArry;
        $tableGenerate->tableActions = $actionsList;

        $content = $tableGenerate->tableRender();
        return $this->render('property/index.html.twig', [
            'tableData' => $content,
            'id' => $user->getId(),
            'page' => $page,
        ]);
    }

    /**
     * @Route("application/properties/add/{id}", name="property_new")
     */
    public function add(Request $request, $id = null): Response
    {
        try {
            $propertyStatus = $this->getDoctrine()->getRepository(PropertyStatus::class)->feathAll();
            $propertyType = $this->getDoctrine()->getRepository(PropertyType::class)->feathAll();
            $Ewa = $this->getDoctrine()->getRepository(Ewa::class)->feathAll();
            $Features = $this->getDoctrine()->getRepository(Features::class)->feathAll();
            $Furnishing = $this->getDoctrine()->getRepository(Furnishing::class)->feathAll();

            if ($request->isMethod('post')) {
                $requestParam = $request->request->all();
                $this->propertySave($requestParam, $id);
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
                'AreaWidth' => '',
                'AreaHight' => '',
                'map' => '',
                'Mortgage' => '',
                'features' => '',
                'ewa' => '',
                'city' => '',
                'assets' => null,
                'state' => '',
                'zip' => '',
                'ptype' => '',
                'pstatus' => '',
                'furnishing' => '',
            );
        } catch (\Exception $e) {
            dd($e);
        }
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

    public function propertySave($param, $id = null)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $propertyStatus = $this->getDoctrine()->getRepository(PropertyStatus::class)->findOneBy(['id' => $param['status']]);
        $propertyType = $this->getDoctrine()->getRepository(PropertyType::class)->findOneBy(['id' => $param['ptype']]);
        $Ewa = $this->getDoctrine()->getRepository(Ewa::class)->findOneBy(['id' => $param['ewa']]);
        $Features = $this->getDoctrine()->getRepository(Features::class)->findOneBy(['id' => $param['pfeatures']]);
        $userId = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['id' => $user->getId()]);
        $Furnishing = $this->getDoctrine()->getRepository(Furnishing::class)->findOneBy(['id' => $param['furnishing']]);
        $entityManager = $this->getDoctrine()->getManager();
        if (empty($id)) {
            $property = new Property();
        } else {
            $property = $this->getDoctrine()->getRepository(Property::class)->findOneBy(['id' => $id]);
        }

        $property->setTitle($param['title']);
        $property->setDescription($param['about']);
        $property->setPropertyStatus($propertyStatus);
        $property->setPropertyType($propertyType);
        $property->setInvestment($param['pinvestment']);
        $property->setEwa($Ewa);
        $property->setFurnishing($Furnishing);
        $property->setBuildingName($param['pbuildingName']);
        $property->setLocation($param['location']);
        $property->setValue($param['pvalue']);
        $property->setAddress(null);
        $property->setFeatures(implode(",", $param['pfeatures']));
        $property->setBedRooms($param['bedRooms']);
        $property->setBathRooms($param['bathRooms']);
        $property->setAreaWidth($param['area_weight']);
        $property->setAreaHeight($param['area_heigh']);
        $property->setDateofupdated(new \DateTime('now'));
        $property->setMap('map');
        $property->setCreatedBy($userId);
        $property->setCreatedAt(new \DateTime('now'));
        $property->setMortgage($param['mortgage']);
        $entityManager->persist($property);
        $entityManager->flush();
        $assets = empty($param['assets']) ? [] : $param['assets'];
        $assetsNumber = $param['assetsnumber'];
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
            $applicationAssets->setSlno($assetsNumber[$key]);
            $applicationAssets->setTitle('test');
            $applicationAssets->setDescription('test');
            $entityManager->persist($applicationAssets);
            $entityManager->flush();
        }

        if (empty($id)) {
            $propertyDetails = new PropertyDetails();
        } else {
            $propertyDetails = $this->getDoctrine()->getRepository(PropertyDetails::class)->findOneBy(['parent' => $id]);
        }

        $propertyDetails->setSeoTags($param['tags']);
        $propertyDetails->setCity($param['pcity']);
        $propertyDetails->setState($param['pstate']);
        $propertyDetails->setZip($param['pzip']);
        $propertyDetails->setParent($property);
        $entityManager->persist($propertyDetails);
        $entityManager->flush();

        foreach ($assetsNumber as $key => $slno) {
            $applicationAssetsSLno = $this->getDoctrine()->getRepository(ApplicationAssets::class)->findOneBy(['id' => $key]);
            $applicationAssetsSLno->setSlno($slno);
            $entityManager->persist($applicationAssetsSLno);
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
        $Propertyobj = $this->getDoctrine()->getRepository(Property::class);
        $Property = $Propertyobj->getAllById($id);
        $PropertyAssets = $Propertyobj->findOneById($id)->getApplicationAssets();
        $itemsAssets = [];
        foreach ($PropertyAssets as $index => $items) {
            $itemsAssets[$items->getSlno()] = array(
                'url' => $items->getUrl(),
                'id' => $items->getId(),
            );
        }
        if ($request->isMethod('post')) {
            $requestParam = $request->request->all();
            $this->propertySave($requestParam, $id);
        }
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
                'AreaWidth' => '',
                'AreaHight' => '',
                'map' => '',
                'city' => '',
                'state' => '',
                'zip' => '',
                'Mortgage' => '',
                'features' => '',
                'ewa' => '',
                'ptype' => '',
                'pstatus' => '',
                'furnishing' => '',
                'assets' => '',
            );
        } else {
            $Property[0][0]['pstatus'] = $Property[0]['pstatus'];
            $Property[0][0]['ptype'] = $Property[0]['ptype'];
            $Property[0][0]['ewa'] = $Property[0]['ewa'];
            $Property[0][0]['furnishing'] = $Property[0]['furnishing'];
            $Property[0][0]['features'] = explode(',', $Property[0][0]['features']);
            $Property[0][0]['SeoTags'] = $Property[0]['SeoTags'];
            $Property[0][0]['city'] = $Property[0]['city'];
            $Property[0][0]['state'] = $Property[0]['state'];
            $Property[0][0]['zip'] = $Property[0]['zip'];
            $Property[0][0]['assets'] = $itemsAssets;
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

    /**
     * @Route("application/add-to-featured-list/{id}", name="property_featured")
     */
    public function addToFeaturedList(Request $request, $id = null): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $propertyDetails = $this->getDoctrine()->getRepository(PropertyDetails::class)->findOneByParent($id);
        $propertyDetails->setWebFeaturedListing(1);
        $entityManager->persist($propertyDetails);
        $entityManager->flush();
        return $response = new JsonResponse(['data' => 1]);
    }

    /**
     * @Route("application/delete-assets/{id}", name="property_assets")
     */
    public function deleteAssets(Request $request, $id = null): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $propertyAssets = $this->getDoctrine()->getRepository(ApplicationAssets::class)->findoneBy(['id' => $id]);
        $entityManager->remove($propertyAssets);
        $entityManager->flush();
        return $response = new JsonResponse(['data' => 1]);
    }

    /**
     * @Route("application/property/{id}/delete", name="property_delete")
     */
    public function propertyDelete(Request $request, $id = null): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $property = $this->getDoctrine()->getRepository(Property::class)->find($id);
        $property->setStatus(StatusConstants::DELETED);
        $entityManager->persist($property);
        $entityManager->flush();
        return $response = new JsonResponse(['data' => 1]);
    }
}
