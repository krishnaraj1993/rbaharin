<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends AbstractController
{
    /**
     * @Route("application/search", name="user_search")
     */
    public function index(Request $request): Response
    {
        $param = $request->query->all();
        $PropertyData = $this->getDoctrine()->getRepository(Property::class)->getFilterData($param); 
        return $response = new JsonResponse(['data' => $PropertyData]);      
    }
}
