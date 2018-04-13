<?php
/**
 * Created by PhpStorm.
 * User: sarkesh
 * Date: 1/16/18
 * Time: 6:55 AM
 */

namespace entityManagerBundle\Service;

use Doctrine\ORM\EntityManager;

class mgr
{

    protected $em;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function existById($entityName,$id)
    {
        if(! is_null($this->em->getRepository($entityName)->find($id)))
            return true;
        return false;
    }
    public function existByParams($entityName,$params)
    {
        if(! is_null($this->em->getRepository($entityName)->findOneBy($params)))
            return true;
        return false;
    }
    public function deleteById($entityName,$id)
    {
        if($this->existById($entityName,$id))
        {
            $res = $this->em->getRepository($entityName)->find($id);
            $this->em->remove($res);
            $this->em->flush();
        }
    }
    public function getById($entityName,$id)
    {
        if($this->existById($entityName,$id))
        {
            return $this->em->getRepository($entityName)->find($id);
        }
    }
    public function select($entity,$params = [],$orders =[])
    {
        return $this->em->getRepository($entity)->findBy($params,$orders);
    }
    public function update($obj)
    {
        $this->em->persist($obj);
        $this->em->flush();
    }

    public function getByPage($entityName,$page=1,$perPage=20)
    {
        return $this->em->createQueryBuilder('q')
            ->select('q')
            ->from($entityName,'q')
            ->setMaxResults($perPage)
            ->setFirstResult($perPage * ($page -1) )
            ->orderBy('q.id','DESC')
            ->getQuery()
            ->execute();
    }

    public function insertEntity($entity)
    {
        $this->em->persist($entity);
        return $this->em->flush();
    }

}