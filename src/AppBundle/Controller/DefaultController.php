<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormError;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    /**
     * @Route("/submit/order", name="submitOrder")
     */
    public function submitOrder(Request $request)
    {
        if($this->get('user.mgr')->isLogedIn())
        {
            $transForm = $this->createFormBuilder()
                ->add('username', TextType::class,array('label'=>"نام کاربری:",'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('password', PasswordType::class,array('label'=>"کلمه عبور:",'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('repassword', PasswordType::class,array('label'=>"تکرار کلمه عبور:",'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('email', EmailType::class,array('label'=>"پست الکترونیکی:",'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('nameUser', TextType::class,array('label'=>"نام و نام‌خانوادگی:",'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('company', TextType::class,array('label'=>"شرکت:",'required'=>false,'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('tel', TextType::class,array('label'=>"تلفن ثابت:",'required'=>false,'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('mobile', TextType::class,array('label'=>"تلفن همراه:",'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('field', TextType::class,array('label'=>"رشته تحصیلی:",'required'=>false,'attr'=>array('class' => 'input-sm'),'data' => ''))
                ->add('save', SubmitType::class, array('label' => 'عضویت','attr'=>array('class' => 'btn-md btn-primary')))
                ->getForm();
            $transForm->handleRequest($request);
            if($transForm->isSubmitted() && $transForm->isValid()) {

                $this->get('twig')->addGlobal('alerts', [['type' => 'success', 'message' => 'صورت وضعیت جدید با موفقیت اضافه شد.']]);

            }

            return $this->render('AppBundle:Default:submitOrder.html.twig',
                [
                    'TransForm'=>$transForm->createView()
                ]
            );
        }
        return $this->redirectToRoute('userRegister');

    }

}
