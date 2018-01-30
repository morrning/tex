<?php

namespace UserBundle\Controller;

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
use DateBundle\Form\Type\jdateType;

class DefaultController extends Controller
{
    /**
     * @Route("/user/login", name="userLogin")
     */
    public function login(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('Username', TextType::class,array('label'=>"نام کاربری:",'attr'=>array('class' => 'input-sm'),'data' => ''))
            ->add('Password', PasswordType::class,array('label'=>"کلمه عبور:",'attr'=>array('class' => 'input-sm'),'data' => ''))
            ->add('save', SubmitType::class, array('label' => 'ورود','attr'=>array('class' => 'btn-md btn-primary')))
            ->getForm();
        $form->get('Username')->setData('');
        $form->get('Password')->setData('');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($this->get('user.mgr')->DoLogin($form->get('Username')->getData(),$form->get('Password')->getData())){
                return $this->redirectToRoute('home');
            }
            //login incerect
            $this->get('twig')->addGlobal('alerts', [['type'=>'danger','message'=>'نام کاربری یا کلمه عبور اشتباه است. لطفا مجددا سعی نمایید.']]);

        }
        return $this->render('UserBundle:Default:Login.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/user/register", name="userRegister")
     */
    public function register(Request $request)
    {
        if(!$this->get('user.mgr')->isLogedIn())
        {
            $form = $this->createFormBuilder()
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
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {

                $this->get('twig')->addGlobal('alerts', [['type' => 'success', 'message' => 'صورت وضعیت جدید با موفقیت اضافه شد.']]);

            }

            return $this->render('UserBundle:Default:RegisterUser.html.twig',
                [
                    'form'=>$form->createView()
                ]
            );
        }
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/user/logout", name="userLogout")
     */
    public function logout(Request $request)
    {
        if($this->get('user.mgr')->isLogedIn())
        {
            $this->get('user.mgr')->DoLogout();
        }
        return $this->redirectToRoute('home');
    }
}
