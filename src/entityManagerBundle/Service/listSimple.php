<?php
/**
 * Created by PhpStorm.
 * User: rwd
 * Date: 1/15/18
 * Time: 10:59 AM
 */

namespace entityManagerBundle\Service;

use Symfony\Component\Yaml\Yaml;
use Doctrine\ORM\EntityManager;

class listSimple
{
    protected $em;
    protected $AppFolder;
    private $gridOnePageService;
    private $JdateService;

    // We need to inject this variables later.
    public function __construct
    (
        EntityManager $entityManager,
        $kernel,
        \gridBundle\Service\perOnePage $gridOnePage
    )
    {
        $this->em = $entityManager;
        $this->AppFolder =  $kernel->getProjectDir();
        $this->gridOnePageService = $gridOnePage;
        $this->JdateService = new \DateBundle\Service\Date();

    }

    public function render($EntityPattern,$btnView = null,$btnEdit=null,$btnDelete=null,$editParams=null,$filter=[],$btnGo=null,$order=null)
    {
        if(is_null($filter))
            $filter = [];
        $entityAdr = explode(':',$EntityPattern);
        $YamlForm = Yaml::parse(file_get_contents($this->AppFolder . '/src/' . $entityAdr[0]. '/entityPattern/' . $entityAdr[1]));
        $result = $this->em->getRepository($YamlForm['entity']['name'])->findBy($filter,['id'=>'DESC']);
        foreach ($result as $rowKey=>$row)
        {
            foreach($YamlForm['items'] as $key=>$item)
            {
                $getmethodName = 'get'.ucfirst($key);
                $setmethodName = 'set'.ucfirst($key);

                if($item['type'] == 'jdateType')
                {
                    $row->$setmethodName($this->JdateService->jdate('Y/m/d',$row->$getmethodName()));
                }
                elseif ($item['type'] == 'choiceType.entity')
                {
                    $getItemMethod = 'get' . ucfirst($item['colTitle']);
                    $row->$setmethodName(
                        $this->em->getRepository($item['entity'])->findOneBy(
                            [
                                $item['colValue']=>$row->$getmethodName()
                            ]
                        )->$getItemMethod()
                    );
                }
                elseif ($item['type'] == 'hidden')
                {
                    if(array_key_exists('viewType',$item))
                    {
                        $row->$setmethodName($this->JdateService->jdate('Y/m/d',$row->$getmethodName()));
                    }
                    else
                    {
                        $row->$setmethodName('hiddenContent');
                    }
                }
            }
        }

        $titles = [];
        $headers = ['Id'];
        foreach($YamlForm['items'] as $key=>$item)
        {
            array_push($titles,$item['title']);
            array_push($headers,ucfirst($key));
        }

        $data = [];
        $data['data']=$result;
        $data['selector']=$headers;
        $data['header']=$titles;

        $data['btn-delete']=$btnDelete;
        $data['btn-edit']=$btnEdit;
        $data['btn-view']=$btnView;
        $data['btn-go']=$btnGo;
        $data['btn-gridSeperator']='';
        if(! is_null($editParams))
            $data['edit-params']=$editParams;
        return $this->gridOnePageService->render($data);

    }
}