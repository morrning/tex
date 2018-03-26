<?php
/**
 * Created by PhpStorm.
 * User: sarkesh
 * Date: 2/16/18
 * Time: 10:54 AM
 */

namespace entityManagerBundle\Service;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Yaml\Yaml;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use DateBundle\Form\Type\jdateType;
use Symfony\Component\Form\FormError;
class editSimple
{
    protected $em;
    protected $AppFolder;
    private $formFactory;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager,$kernel,\Symfony\Component\Form\FormFactory $formFactory)
    {
        $this->em = $entityManager;
        $this->AppFolder =  $kernel->getProjectDir();
        $this->formFactory = $formFactory;
    }


    public function render($EntityPattern,$id)
    {
        $entityAdr = explode(':',$EntityPattern);
        $YamlForm = Yaml::parse(file_get_contents($this->AppFolder . '/src/' . $entityAdr[0]. '/entityPattern/' . $entityAdr[1]));
        $entityLoaded = $this->em->getRepository($YamlForm['entity']['name'])->find($id);

        $form = $this->formFactory->createNamedBuilder('formBuilder');

        foreach($YamlForm['items'] as $key=>$item)
        {
            $getMethod = 'get' . ucfirst($key);
            if($item['type'] == 'TextType')
            {
                $form->add($key, TextType::class,array('label'=>$item['title'],'data'=>$entityLoaded->$getMethod(),'attr'=>array('class' => 'input-sm')));
            }
            elseif ($item['type'] == 'NumberType')
            {
                $form->add($key, NumberType::class,array('label'=>$item['title'],'data'=>$entityLoaded->$getMethod(),'attr'=>array('class' => 'input-sm')));
            }
            elseif ($item['type'] == 'jdateType')
            {
                $form->add($key, jdateType::class,array('label'=>$item['title']));
            }
            elseif ($item['type'] == 'CKEditorType')
            {
                $form->add($key, CKEditorType::class,array('label'=>$item['title'],'data'=>$entityLoaded->$getMethod(),'attr'=>array('class' => 'input-sm')));
            }
            elseif ($item['type'] == 'TextareaType')
            {
                $form->add($key, TextareaType::class,array('label'=>$item['title'],'data'=>$entityLoaded->$getMethod(),'attr'=>array('class' => 'input-sm')));
            }
            elseif ($item['type'] == 'hidden')
            {
                $form->add($key, HiddenType::class,array('data'=>$entityLoaded->$getMethod(),'attr'=>array('class' => 'input-sm')));
            }
            elseif ($item['type'] == 'choiceType.entity')
            {
                $colItems = $this->em->getRepository($item['entity'])->findAll();
                $form->add($key,ChoiceType::class,['label'=>$item['title'],'choices'=>$colItems,'choice_label'=>$item['colTitle'],'choice_value'=>$item['colValue']]);

            }
            elseif ($item['type'] == 'choiceType.integer')
            {
                $col = [];
                for($i=$item['startValue'];$i<= $item['endValue'];$i++)
                {
                    array_push($col,$i);
                }
                $form->add($key,ChoiceType::class,['label'=>$item['title'],'choices'=>$col]);

            }
            elseif ($item['type'] == 'choiceType.array')
            {
                $items = explode(',',$item['values']);
                $orgiItems =[];
                foreach ($items as $it)
                {
                    $orgiItems[$it]=$it;
                }
                $form->add($key,ChoiceType::class,['label'=>$item['title'],'choices'=>$orgiItems]);

            }
        }
        $form->add('id', HiddenType::class,array('data'=>$entityLoaded->getId()));
        $form->add('save', SubmitType::class, array('label' => 'ثبت','attr'=>array('class' => 'btn-md btn-primary')));
        return $form->getForm();

    }

    public function submit($EntityPattern,$form)
    {
        $entityPattern = explode(':',$EntityPattern);
        $YamlForm = Yaml::parse(file_get_contents($this->AppFolder . '/src/' . $entityPattern[0]. '/entityPattern/' . $entityPattern[1]));
        $entity = $this->em->getRepository($YamlForm['entity']['name'])->find($form->get('id')->getData());
        foreach($YamlForm['items'] as $key=>$item)
        {
            $methodStr = 'set' . ucfirst($key);
            if($item['type'] == 'choiceType.entity')
            {
                $subMethodStr = 'get' . ucfirst($item['colValue']);
                $entity->$methodStr($form->get($key)->getData()->$subMethodStr());
            }
            elseif($item['type'] == 'jdateType') {
                $jdateService = new \DateBundle\Service\Date();
                $entity->$methodStr($jdateService->jallaliToUnixTime($form->get($key)->getData()));
            }
            else
            {
                $entity->$methodStr($form->get($key)->getData());
            }
        }

        $this->em->persist($entity);
        $this->em->flush();
        return $entity->getId();

    }
}