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
use Zarinpal\Zarinpal;

class DefaultController extends Controller
{
    public function generateRandomString($length = 16, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        if($this->get('user.mgr')->isLogedIn())
        {
            if ($this->get('user.mgr')->ThisUserHasPermission('TranslatorAccess'))
                return $this->redirectToRoute('transDashboard');
            return $this->redirectToRoute('userDashboard');
        }
        return $this->render('AppBundle:Default:index.html.twig',
            [
                'blogposts'=>$this->get('entityMgr.Mgr')->getByPage('AppBundle:blogPost',1,3)
            ]
        );
    }

    /**
     * @Route("/submit/order", name="submitOrder")
     */
    public function submitOrder(Request $request)
    {
        if($this->get('user.mgr')->isLogedIn())
        {
            $form = $this->get('entityMgr.add')->render('AppBundle:order.yml',
                [
                    'submitter'=>$this->get('user.mgr')->getThisUserInfo()->getId(),
                    'dateSubmit'=>time(),
                    'state'=>'ثبت سفارش اولیه',
                    'price'=>'0'
                ]
            );

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid())
            {
                $this->get('entityMgr.add')->submit('AppBundle:order.yml',$form);
                return $this->redirectToRoute('successOrder');
            }


            return $this->render('AppBundle:Default:submitOrder.html.twig',
                [
                    'TransForm'=>$form->createView()
                ]
            );
        }
        return $this->redirectToRoute('userRegister');

    }

    /**
     * @Route("/order/submit/success", name="successOrder")
     */
    public function successOrder()
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        return $this->render('AppBundle:Default:successOrderSubmit.html.twig');
    }
    /**
     * @Route("/orderslist", name="listOrder")
     */
    public function listOrder()
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');

        $grid = $this->get('entityMgr.listSimple')->render(
            'AppBundle:listOrders.yml',
            null,
            null,
            null,
            null,
            ['submitter'=>$this->get('user.mgr')->getThisUserInfo()->getId()]
        );
        return $this->render('AppBundle:user:listOrder.html.twig',
            [
                'grid'=>$grid
            ]
        );

    }

    /**
     * @Route("/user/dashboard", name="userDashboard")
     */
    public function userDashboard()
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');

        if ($this->get('user.mgr')->ThisUserHasPermission('TranslatorAccess'))
            return $this->redirectToRoute('transDashboard');

        return $this->render('AppBundle:user:userDashboard.html.twig',
            [
                'user'=>$this->get('user.mgr')->getThisUserInfo()
            ]
        );


    }

    /**
     * @Route("/user/personaldictionaray", name="userPersonalDictionaray")
     */
    public function userPersonalDictionaray(Request $request)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');


        $form = $this->get('entityMgr.add')->render('AppBundle:persoanlDic.yml',
            [
                'userID'=>$this->get('user.mgr')->getThisUserInfo()->getId()
            ]
        );

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->get('entityMgr.add')->submit('AppBundle:persoanlDic.yml',$form);
            return $this->redirectToRoute('userPersonalDictionaray');
        }
        $grid = $this->get('entityMgr.listSimple')->render(
            'AppBundle:persoanlDic.yml',
            null,
            null,
            'userPersonalDictionarayDeleteItem',
            null,
            ['userID'=>$this->get('user.mgr')->getThisUserInfo()->getId()]
        );
        return $this->render('AppBundle:user:persoanlDic.html.twig',
            [
                'grid'=>$grid,
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @Route("/user/deletepersonaldictionaray/{id}", name="userPersonalDictionarayDeleteItem")
     */
    public function userPersonalDictionarayDeleteItem($id)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        if(! $this->get('entityMgr.mgr')->existById('AppBundle:personalDic', $id))
            return $this->redirectToRoute('404');
        if(! $this->get('entityMgr.mgr')->existByParams('AppBundle:personalDic',
            [
                'id'=>$id,
                'userID'=>$this->get('user.mgr')->getThisUserInfo()->getId()
            ]
            ,
            $id))
            return $this->redirectToRoute('503');
        $this->get('entityMgr.mgr')->deleteById('AppBundle:personalDic', $id);
        return $this->redirectToRoute('userPersonalDictionaray');

    }

    /**
     * @Route("/user/new/ques", name="userSubmitNewQuestion")
     */
    public function userSubmitNewQuestion(Request $request)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        $form = $this->get('entityMgr.add')->render('AppBundle:qes.yml',
            [
                'userID'=>$this->get('user.mgr')->getThisUserInfo()->getId(),
                'dateSubmit'=>time(),
                'guid'=>$this->generateRandomString(32),
                'isStarter'=>true
            ]
        );

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $id = $this->get('entityMgr.add')->submit('AppBundle:qes.yml',$form);
            $qus = $this->get('entityMgr.mgr')->getById('AppBundle:qes',$id);
            return $this->redirectToRoute('userViewQues',['guid'=>$qus->getGuid()]);
        }
        return $this->render('AppBundle:user:submitQes.html.twig',
            [
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @Route("/user/list/ques/{type}/{page}", name="userlistQuestions")
     */
    public function userlistQuestions($type,$page)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        if($type != 'all')
            return $this->redirectToRoute('404');
        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository('AppBundle:qes')->findBy(
            [
                'isStarter'=>true,
                'userID'=>$this->get('user.mgr')->getThisUserInfo()->getId()
            ],
            [
                'dateSubmit'=>'DESC'
            ]
        );
        foreach ($res as $re)
        {
            $re->setUserID($this->get('entityMgr.mgr')->getById('UserBundle:User',$re->getUserID())->getFullName());
        }
        return $this->render('AppBundle:user:listQes.html.twig',
            [
               'res'=>$res
            ]
        );
    }

    /**
     * @Route("/user/view/ques/{guid}", name="userViewQues")
     */
    public function userViewQues(Request $request,$guid)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:qes',['guid'=>$guid]))
            return $this->redirectToRoute('404');
        if(
            $this->get('entityMgr.mgr')->select('AppBundle:qes',['guid'=>$guid,'isStarter'=>true])[0]->getUserID()
        == $this->get('user.mgr')->getThisUserInfo()->getId()
        )
        {
            $formView = null;
            if ($this->get('user.mgr')->IsLogedIn())
            {
                $form = $this->get('entityMgr.add')->render('AppBundle:replayQes.yml',
                    [
                        'userID'=>$this->get('user.mgr')->getThisUserInfo()->getId(),
                        'dateSubmit'=>time(),
                        'guid'=>$guid,
                        'isStarter'=>0,
                        'title'=>null
                    ]
                );
                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid())
                {
                    $this->get('entityMgr.add')->submit('AppBundle:replayQes.yml',$form);
                    return $this->redirectToRoute('userViewQues',['guid'=>$guid]);
                }
                $formView = $form->createView();
            }

            $res = $this->get('entityMgr.mgr')->select('AppBundle:qes',['guid'=>$guid,'isStarter'=>false],['id'=>'DESC']);
            $starter = $this->get('entityMgr.mgr')->select('AppBundle:qes',['guid'=>$guid,'isStarter'=>true])[0];
            $starter->setUserID($this->get('entityMgr.mgr')->getById('UserBundle:User',$starter->getUserID())->getFullName());


            foreach ($res as $re)
            {
                $re->setUserID($this->get('entityMgr.mgr')->getById('UserBundle:User',$re->getUserID())->getFullName());
            }


            return $this->render('AppBundle:user:viewQes.html.twig',
                [
                    'res'=>$res,
                    'starter'=>$starter,
                    'form'=>$formView
                ]
            );
        }
        return $this->redirectToRoute('401');

    }

    /**
     * @Route("/pages/{name}", name="showStaticPages")
     */
    public function showStaticPages($name)
    {
        $settings = $this->get('entityMgr.mgr')->getById('AdminBundle:setting',1);
        $title = "";
        $body = "";
        if($name == 'about')
        {
            $title = "درباره ما";
            $body = $settings->getAbout();
        }
        elseif($name == 'term')
        {
            $title = "شرایط و قوانین ارائه خدمات";
            $body = $settings->getTerms();
        }
        elseif($name == 'connect')
        {
            $title = "تماس با ما";
            $body = $settings->getConnectUs();
        }
        else{
            return $this->redirectToRoute('404');
        }

        return $this->render('AppBundle:Default:StaticPage.html.twig',
            [
                'titleContent'=>$title,
                'content'=>$body
            ]
        );

    }

    /**
     * @Route("/user/list/bills", name="userListBills")
     */
    public function userListBills()
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        $uid = $this->get('user.mgr')->getThisUserInfo()->getId();
        $bills =  $this->get('entityMgr.mgr')->select('AppBundle:Transaction',['userID'=>$uid],['id'=>'DESC']);

        $grid = $this->get('entityMgr.listSimple')->render(
            'AppBundle:listBills.yml',
            'userViewBill',
            null,
            null,
            null,
            ['userID'=>$this->get('user.mgr')->getThisUserInfo()->getId()]
        );

        return $this->render('AppBundle:user:listBills.html.twig',
            [
                'grid'=>$grid
            ]
        );

    }

    /**
     * @Route("/user/view/bill/{id}", name="userViewBill")
     */
    public function userViewBill($id)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        $uid = $this->get('user.mgr')->getThisUserInfo();
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:Transaction',['id'=>$id,'userID'=>$uid->getId()]))
            return $this->redirectToRoute('404');
        $transaction = $this->get('entityMgr.mgr')->getById('AppBundle:Transaction',$id);
        $order = $this->get('entityMgr.mgr')->getById('AppBundle:userOrder',$transaction->getOrderID());
        return $this->render('AppBundle:user:userViewBill.html.twig',
            [
                'transaction'=>$transaction,
                'user'=>$uid,
                'order'=>$order
            ]
        );
    }

    /**
     * @Route("/pay/bill/{id}", name="userPayBill")
     */
    public function userPayBill($id)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        $uid = $this->get('user.mgr')->getThisUserInfo();
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:Transaction',['id'=>$id,'userID'=>$uid->getId()]))
            return $this->redirectToRoute('404');
        $transaction = $this->get('entityMgr.mgr')->getById('AppBundle:Transaction',$id);
        $order = $this->get('entityMgr.mgr')->getById('AppBundle:userOrder',$transaction->getOrderID());
        $Amount = (int) $transaction->getAmount()/10; //Amount will be based on Toman - Required
        $Description = $order->getTitle(); // Required
        $Email = $uid->getEmail(); // Optional
        $Mobile = $uid->getMobile(); // Optional
        $CallbackURL = 'http://www.thez.ir/pay/verifly'; // Required
        $gateway = $this->get('entityMgr.mgr')->getById('paymentBundle:gateways',1);
        $pay = new Zarinpal($gateway->getPublicKey());
        $pay->request($CallbackURL,$Amount,$Description,$Email,$Mobile);
        $pay->redirect();
    }

    /**
     * @Route("/pay/verify", name="userPayVerify")
     */
    public function userPayVerify(Request $request)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        $uid = $this->get('user.mgr')->getThisUserInfo();

        $gateway = $this->get('entityMgr.mgr')->getById('paymentBundle:gateways',1);
        $pay = new Zarinpal($gateway->getPublicKey());
        $res = $pay->verify(100,894894);
        if($res['Status'] == 'success')
        {
            return $this->render('AppBundle:user:successPayment.html.twig',
                [
                    'user'=>$uid
                ]
            );
        }

    }

}
