<?php
namespace App\Service;

use App\Entity\ApplicationUsers;
use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class UserFunctionService extends AbstractController
{
    public function getLoginUserDetails($field, $fieldData)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(ApplicationUsers::class);
        $userObj = $repository->findOneBy([$field => $fieldData]);
        $data = array(
            'id' => $userObj->getId(),
            'firstname' => $userObj->getFirstName(),
            'lastname' => $userObj->getLastname(),
            'mobilenumber' => $userObj->getMobileNumber(),
            'address' => $userObj->getAddress(),
            'status' => $userObj->getStatus(),
            'image' => $userObj->getProfileImage(),
            'plan' => $userObj->getCurrentPlan(),
        );
        $session = new Session(new NativeSessionStorage(), new AttributeBag());
        $session->set('login-user', $data);
        return $data;
    }

    public function getPropertiesCount($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Property::class);
        $property = $repository->findBy(['createdBy' => $id]);
        return sizeof($property);
    }
    public function getAgentCount($id = null)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userCount = $this->getDoctrine()->getRepository(ApplicationUsers::class)
            ->usersCount('ROLE_AGENT', $id);
        return sizeof($userCount);
    }
    public function getAgencyCount($id = null)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $userCount = $this->getDoctrine()->getRepository(ApplicationUsers::class)
            ->usersCount('ROLE_AGENCY', $id);
        return sizeof($userCount);
    }

    public function getUserTree($role)
    {
        $treeArray = array();
        $treeArray['admin'] = $userTree = $this->getDoctrine()->getRepository(ApplicationUsers::class)
            ->usersTree('ROLE_ADMIN');
        foreach ($userTree as $key => $value) {
            $treeArray['admin']['agency'] = $userTree2 = $this->getDoctrine()->getRepository(ApplicationUsers::class)
                ->usersTree('ROLE_AGENCY', $value['id']);
            foreach ($userTree2 as $key2 => $value2) {
                $treeArray['admin']['agency']['agent'] = $userTree2 = $this->getDoctrine()->getRepository(ApplicationUsers::class)
                    ->usersTree('ROLE_AGENT', $value2['id']);
            }
        }
        return $treeArray;
    }
}
