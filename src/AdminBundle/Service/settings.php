<?php
/**
 * Created by PhpStorm.
 * User: sarkesh
 * Date: 2/16/18
 * Time: 1:49 PM
 */

namespace AdminBundle\Service;

use Doctrine\ORM\EntityManager;


class settings
{
    protected $em;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function saveSettings($term,$about,$content)
    {
        $settings = $this->em->getRepository('AdminBundle:setting')->find(1);
        $settings->setTerms($term);
        $settings->setAbout($about);
        $settings->setConnectUs($content);
        $this->em->persist($settings);
        $this->em->flush();
    }
}