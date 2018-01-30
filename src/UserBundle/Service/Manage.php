<?php

namespace UserBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Manage
{
    protected $em;
    protected $session;
    protected $form;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager,$form)
    {
        $this->em = $entityManager;
        $this->session = new Session();
        $this->form = $form;
    }

    public function isLogedIn()
    {
        $sessionID = $this->session->getId();
        $result = $this->em->getRepository('UserBundle:User')->findOneBy(['OnlineGUID'=>$sessionID]);

        if(count($result) != 0 && $result->getOnlineGUID() != '')
            return true;
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function DoLogin($username, $password){

        $params = ["Username"=>$username,"Password"=>md5($password)];
        $result = $this->em->getRepository('UserBundle:User')->findOneBy($params);
        if(count($result)!=0)
        {
            $result->setOnlineGUID($this->session->getId());
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function GetThisUserInfo(){
        $sessionID = $this->session->getId();
        return $this->em->getRepository('UserBundle:User')->findOneBy(['OnlineGUID'=>$sessionID]);
    }

   
    public function DoLogout(){
        if($this->isLogedIn()){
            $sessionID = $this->session->getId();
            $result = $this->em->getRepository('UserBundle:User')->findOneBy(['OnlineGUID'=>$sessionID]);
            $result->setOnlineGUID("");
            return $this->em->flush();
        }
    }

    public function ChangePassword($user,$password){
        if(count($user) != 0){
            $userData = $this->em->getRepository('UserBundle:User')->findOneBy(['id'=>$user->getid()]);
            $userData->setPassword(md5($password));
            $this->em->flush();
            return true;
        }
        return false;
    }

    public function getAllUsers($page=1 ,$perPage=10)
    {
        return $this->em->createQuery('SELECT u FROM UserBundle:User u')
            ->setMaxResults($perPage)
            ->setFirstResult(($perPage * ($page -1) ))
            ->getResult();
    }

    public function getAllUsersForCob()
    {
        return $this->em->getRepository('UserBundle:User')->findAll();
    }

    public function getUserInfoByUsername($username)
    {
        return $this->em->getRepository('UserBundle:User')->findOneBy(['Username'=>$username]);
    }

    public function getUserInfoByID($id)
    {
        return $this->em->getRepository('UserBundle:User')->findOneBy(['id'=>$id]);
    }

    public function updateUser($user)
    {
        $this->em->persist($user);
        return $this->em->flush();
    }

    public function isUserExist($username)
    {
        $user = $this->em->getRepository('UserBundle:User')->findOneBy(['Username'=>$username]);
        if(count($user)!=0)
        {
            return true;
        }
        return false;
    }

    public function addUser($title,$username,$password,$codemeli,$tel,$name,$family,$fatherName,$orgNum)
    {
        $user = new \UserBundle\Entity\User();
        $user->setNameUser($name);
        $user->setFamilyUser($family);
        $user->setTitle($title);
        $user->setUsername($username);
        $user->setPassword(md5($password));
        $user->setCodeMeli($codemeli);
        $user->setTel($tel);
        $user->setFatherName($fatherName);
        $user->setOrgNum($orgNum);
        $user->setFullName($title . ' ' . $name . ' ' . $family);
        $this->em->persist($user);
        return $this->em->flush();
    }

    public function getThisUserInfoLabel()
    {
        if($this->isLogedIn())
        {
            $user = $this->GetThisUserInfo();
            return  $user->getNameUser() . ' ' . $user->getFamilyUser();
        }
        return null;
    }

    public function allUsersCount()
    {
        return count($this->em->getRepository('UserBundle:User')->findAll());
    }

    public function ThisUserHasPermission($permissionName,$option=null)
    {
        if($this->isLogedIn()){
            $GroupIDs = $this->GetThisUserInfo()->getGroupID();
            $groups = explode(',',$GroupIDs);
            foreach ($groups as $group)
            {
                $params = [
                    'permissionName'=>$permissionName,
                ];
                $result = $this->em->getRepository('UserBundle:Permission')->findOneBy($params);
                if(count($result) != 0){
                    if($result->getStatus() == '1')
                    {
                        $groupsIN = explode(',',$result->getGroupName());
                        if(in_array($group , $groupsIN)){
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function addUserToGroup($UserID,$groupID)
    {
        $user = $this->em->getRepository('UserBundle:User')->find($UserID);
        $groups = explode(',',$user->getGroupID());
        if(! array_search($groupID,$groups)){
            array_push($groups,$groupID);
            $newGroupList = implode(',',$groups);
            $user->setGroupID($newGroupList);
            $this->em->persist($user);
            $this->em->flush();
        }
    }
}
?>