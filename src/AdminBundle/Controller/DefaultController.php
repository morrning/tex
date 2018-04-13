<?php

namespace AdminBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\factor;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/dashboard", name="adminDashboard")
     */
    public function dashboard()
    {
        if(! $this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        return $this->render('AdminBundle:Default:dashboard.html.twig');
    }

    /**
     * @Route("/admin/list/users", name="adminListUsers")
     */
    public function adminListUsers()
    {
        if(! $this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');
        $grid = $this->get('entityMgr.listSimple')->render(
            'AdminBundle:users.yml',
            null,
            null,
            null,
            null
        );
        return $this->render('AdminBundle:users:list.html.twig',
            [
                'grid'=>$grid
            ]
        );

    }

    /**
     * @Route("/admin/list/groups", name="adminListGroups")
     */
    public function adminListGroups()
    {
        if(! $this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');
        $grid = $this->get('entityMgr.listSimple')->render(
            'AdminBundle:groups.yml',
            null,
            null,
            null,
            null,
            null,
            'adminListUsersGroup'
        );
        return $this->render('AdminBundle:groups:list.html.twig',
            [
                'grid'=>$grid
            ]
        );

    }

    /**
     * @Route("/admin/list/users/group/{id}", name="adminListUsersGroup")
     */
    public function adminListUsersGroup(Request $request, $id)
    {
        if(! $this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        $form = $this->get('entityMgr.add')->render('AdminBundle:addUserToGroup.yml');
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            if($this->get('entityMgr.mgr')->existByParams('UserBundle:User',['Username'=>$form->get('username')->getData()]))
            {
                $user = $this->get('entityMgr.mgr')->select('UserBundle:User',['Username'=>$form->get('username')->getData()])[0];
                $this->get('user.mgr')->addUserToGroup($user->getId(),$id);
                $this->get('twig')->addGlobal('alerts', [['type' => 'success', 'message' => 'کاربر با موفقیت به گروه اضافه شد.']]);
            }
            else{
                $this->get('twig')->addGlobal('alerts', [['type' => 'danger', 'message' => 'نام کاربری وارد شده یافت نشد!']]);
            }

        }

        $data = [];
        $data['data']=$this->get('user.mgr')->getUsersOfGroup($id);
        $data['selector']=['Id','FullName','Username','Mobile','Tel'];
        $data['header']=['نام خانوادگی','نام کاربری','موبایل','تلفن'];
        $data['btn-delete']='adminDeleteUserFromGroup';
        $data['btn-gridSeperator']='';
        $data['edit-params']=['gid'=>$id];
        $grid = $this->get('grid.onePage')->render($data);

        return $this->render('AdminBundle:groups:listUsers.html.twig',
            [
                'grid'=>$grid,
                'form'=>$form->createView()
            ]
        );

    }

    /**
     * @Route("/admin/delete/users/group/{gid}/{id}", name="adminDeleteUserFromGroup")
     */
    public function adminDeleteUserFromGroup($gid ,$id)
    {
        if(! $this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');
        $this->get('user.mgr')->DeleteUserFromGroup($gid,$id);
        return $this->redirectToRoute('adminListUsersGroup',['id'=>$gid]);

    }

    /**
     * @Route("/admin/list/ques/{page}", name="adminlistQuestions")
     */
    public function adminlistQuestions($page)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');

        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository('AppBundle:qes')->findBy(
            [
                'isStarter'=>true,
            ],
            [
                'dateSubmit'=>'DESC'
            ]
        );
        foreach ($res as $re)
        {
            $re->setUserID($this->get('entityMgr.mgr')->getById('UserBundle:User',$re->getUserID())->getFullName());
        }
        return $this->render('AdminBundle:support:listQes.html.twig',
            [
                'res'=>$res
            ]
        );
    }

    /**
     * @Route("/admin/view/ques/{guid}", name="adminViewQues")
     */
    public function adminViewQues(Request $request,$guid)
    {
        if (!$this->get('user.mgr')->IsLogedIn())
            return $this->redirectToRoute('userLogin');
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:qes',['guid'=>$guid]))
            return $this->redirectToRoute('404');
        if(! $this->get('user.mgr')->ThisUserHasPermission('supportAccess'))
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
                    return $this->redirectToRoute('adminViewQues',['guid'=>$guid]);
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


            return $this->render('AdminBundle:support:viewQus.html.twig',
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
     * @Route("/admin/settings", name="adminSettings")
     */
    public function adminSettings(Request $request)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        $settings = $this->get('entityMgr.mgr')->getById('AdminBundle:setting',1);

        $form = $this->createFormBuilder()
            ->add('term', CKEditorType::class,array('label'=>"شرایط و قوانین خدمات:",'attr'=>array('class' => 'input-sm'),'data' => $settings->getTerms()))
            ->add('about', CKEditorType::class,array('label'=>"درباره ما:",'attr'=>array('class' => 'input-sm'),'data' => $settings->getAbout()))
            ->add('connect', CKEditorType::class,array('label'=>"تماس با ما:",'attr'=>array('class' => 'input-sm'),'data' => $settings->getConnectUs()))
            ->add('save', SubmitType::class, array('label' => 'ذخیره تغییرات','attr'=>array('class' => 'btn-md btn-primary')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('admin.settings')->saveSettings(
                $form->get('term')->getData(),
                $form->get('about')->getData(),
                $form->get('connect')->getData()
            );

        }
        return $this->render('AdminBundle:Default:settings.html.twig',[
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/admin/list/orders", name="adminListAllOeders")
     */
    public function adminListAllOeders(Request $request)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        $grid = $this->get('entityMgr.listSimple')->render(
            'AppBundle:listOrders.yml',
            null,
            null,
            null,
            null,
            null,
            'adminViewOrder'
        );
        return $this->render('AdminBundle:orders:listAll.html.twig',
            [
                'grid'=>$grid
            ]
        );
    }

    /**
     * @Route("/admin/view/order/{id}", name="adminViewOrder")
     */
    public function adminViewOrder(Request $request, $id)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:userOrder',['id'=>$id]))
            return $this->redirectToRoute('404');

        $order = $this->get('entityMgr.mgr')->getById('AppBundle:userOrder',$id);
        $user = $this->get('entityMgr.mgr')->getById('UserBundle:User',$order->getSubmitter());
        $transactions = $this->get('entityMgr.mgr')->select('AppBundle:Transaction',['orderID'=>$id]);
        $gridTrans = $this->get('entityMgr.listSimple')->render(
            'AdminBundle:viewTransactions.yml',
            null,
            null,
            null,
            null,
            ['orderID'=>$id]
        );
        $form = $this->get('entityMgr.add')->render('AdminBundle:submitTransaction.yml');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $canSubmitTrans = True;
            $counter = 0;
            if(! is_null($transactions))
            {
                foreach ($transactions as $tra)
                {
                    if(($tra->getPercent() == 100 || $counter == 1) || ($tra->getPercent() == 50 && $form->get('percent')->getData() == 100) || $order->getPrice() == 0)
                    {
                        $canSubmitTrans = FALSE;
                        break;
                    }

                    $counter ++;
                }
            }
            if($canSubmitTrans)
            {
                $percent = $form->get('percent')->getData();
                $newTrans = new \AppBundle\Entity\Transaction();
                $newTrans->setUserID($order->getSubmitter());
                $newTrans->setDateCreate(time());
                $newTrans->setPaid(False);
                $newTrans->setPaidText("در انتظار پرداخت مشتری");
                $newTrans->setAmount((int) (($order->getPrice()*$percent)/100));
                $newTrans->setOrderID($id);
                $newTrans->setPercent($percent);
                $this->get('entityMgr.mgr')->insertEntity($newTrans);
                return $this->redirectToRoute('adminViewOrder',['id'=>$id]);
            }

        }
        return $this->render('AdminBundle:orders:view.html.twig',
            [
                'user'=>$user,
                'order'=>$order,
                'gridTrans'=>$gridTrans,
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/langssettings", name="adminLangsSettings")
     */
    public function adminLangsSettings(Request $request)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        $grid = $this->get('entityMgr.listSimple')->render(
            'AdminBundle:langs.yml',
            null,
            null,
            'adminDeleteLang'
        );

        $form = $this->get('entityMgr.add')->render('AdminBundle:langs.yml');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('entityMgr.add')->submit(
                'AdminBundle:langs.yml',
                $form
            );
            return $this->redirectToRoute('adminLangsSettings');
        }
        return $this->render('AdminBundle:settings:langsSettings.html.twig',
            [
              'grid'=>$grid,
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/langssettings/deletelang/{id}", name="adminDeleteLang")
     */
    public function adminDeleteLang ($id)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:transLang',['id'=>$id]))
            return $this->redirectToRoute('404');

        $this->get('entityMgr.mgr')->deleteById('AppBundle:transLang',$id);
        return $this->redirectToRoute('adminLangsSettings');
    }

    /**
     * @Route("/admin/fieldsettings", name="adminFieldSettings")
     */
    public function adminfieldSettings(Request $request)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        $grid = $this->get('entityMgr.listSimple')->render(
            'AdminBundle:fields.yml',
            null,
            null,
            'adminDeletefield'
        );

        $form = $this->get('entityMgr.add')->render('AdminBundle:fields.yml');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('entityMgr.add')->submit(
                'AdminBundle:fields.yml',
                $form
            );
            return $this->redirectToRoute('adminFieldSettings');
        }
        return $this->render('AdminBundle:settings:fieldsSettings.html.twig',
            [
                'grid'=>$grid,
                'form'=>$form->createView()
            ]
        );
    }

    /**
     * @Route("/admin/fieldsettings/delete/{id}", name="adminDeletefield")
     */
    public function adminDeletefield ($id)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');
        if(!$this->get('entityMgr.mgr')->existByParams('AppBundle:Field',['id'=>$id]))
            return $this->redirectToRoute('404');

        $this->get('entityMgr.mgr')->deleteById('AppBundle:Field',$id);
        return $this->redirectToRoute('adminFieldSettings');
    }

    /**
     * @Route("/admin/paymentgateways/list", name="adminPaymentGateways")
     */
    public function adminPaymentGateways()
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('adminAccess'))
            return $this->redirectToRoute('401');

        $grid = $this->get('entityMgr.listSimple')->render(
            'AdminBundle:paymentGateways.yml',
            null,
            null,
            null
        );

        return $this->render('AdminBundle:settings:paymentGatewaysList.html.twig',
            [
                'grid'=>$grid,
            ]
        );
    }

}
