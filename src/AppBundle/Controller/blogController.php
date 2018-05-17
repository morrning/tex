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

class blogController extends Controller
{
    /**
     * @Route("/admin/list/blogpost/{page}", name="adminListBlogPost")
     */
    public function adminListBlogPosts($page)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('blogAccess'))
            return $this->redirectToRoute('401');

        $perPage = 10;
        $grid = $this->get('grid.simple')->render(
            [
                'data' => $this->get('entityMgr.mgr')->getByPage('AppBundle:blogPost', $page, $perPage),
                'header' => ['عنوان'],
                'selector' => ['id', 'Title'],
                'btn-view' => 'blogPost',
                'btn-delete' => 'adminDeleteBlogPost',
                'btn-edit' => 'adminEditBlogPost',
                'current-page-num' => $page,
                'current-route-name' => 'adminListBlogPost',
                'current-route-params' => ['id' => $page],
                'count-all' => count($this->get('entityMgr.mgr')->select('AppBundle:blogPost')),
                'perPage' => $perPage,
            ]
        );
        return $this->render('AdminBundle:blog:listPost.html.twig',
            [
                'grid' => $grid
            ]
        );
    }

    /**
     * @Route("/admin/new/blogpost", name="adminNewBlogPost")
     */
    public function adminNewBlogPost(Request $request)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('blogAccess'))
            return $this->redirectToRoute('401');
        $form = $this->get('entityMgr.add')->render('AdminBundle:blogPostSubmit.yml',
            [
                'dateSubmit' => time(),
                'submitter' => $this->get('user.mgr')->getThisUserInfo()->getId(),
                'SID' => 0
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $this->get('entityMgr.add')->submit('AdminBundle:blogPostSubmit.yml', $form);
            $post = $this->get('entityMgr.mgr')->getById('AppBundle:blogPost', $id);
            $post->setSID(str_replace(' ', '_', $post->getTitle()));
            $this->get('entityMgr.mgr')->update($post);
            return $this->redirectToRoute('blogPost', ['id' => $post->getSID()]);
        }

        return $this->render('AdminBundle:blog:submit.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/blog/post/{id}", name="blogPost")
     */
    public function blogPost(Request $request, $id)
    {
        if (!$this->get('entityMgr.mgr')->existByParams('AppBundle:blogPost', ['SID' => $id]))
            return $this->redirectToRoute('401');
        $post = $this->get('entityMgr.mgr')->select('AppBundle:blogPost', ['SID' => $id])[0];
        $comments = $this->get('entityMgr.mgr')->select('AppBundle:blogComment', ['postID' => $post->getId()]);
        foreach ($comments as $comment)
        {
            $comment->setSubmitter($this->get('entityMgr.mgr')->getById('UserBundle:User', $comment->getSubmitter())->getFullName());
        }
        $form = $this->get('entityMgr.add')->render('AdminBundle:submitComment.yml',
            [
                'submitter' => $this->get('user.mgr')->getThisUserInfo()->getId(),
                'dateSubmit' => time(),
                'postID' => $post->getId()
            ]
        );
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('entityMgr.add')->submit('AdminBundle:submitComment.yml', $form);
            return $this->redirectToRoute('blogPost', ['id' => $post->getSID()]);
        }
        return $this->render('AdminBundle:blog:viewPost.html.twig',
            [
                'submitter' => $this->get('entityMgr.mgr')->getById('UserBundle:User', $post->getSubmitter())->getFullName(),
                'post' => $post,
                'blogposts'=>$this->get('entityMgr.Mgr')->getByPage('AppBundle:blogPost',1,5),
                'form' => $form->createView(),
                'comments' => $comments
            ]
        );
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blog()
    {
        $posts = $this->get('entityMgr.mgr')->select('AppBundle:blogPost', [], ['id' => 'DESC']);
        $newPosts = [];
        foreach ($posts as &$post) {
            $post->setBody(explode('</p>', $post->getBody())[0]);
            $tempPost = [];
            $tempPost['post'] = $post;
            $tempPost['submitter'] = $this->get('entityMgr.mgr')->getById('UserBundle:User', $post->getSubmitter())->getFullName();
            array_push($newPosts, $tempPost);
        }
        return $this->render('AdminBundle:blog:firstPage.html.twig',
            [
                'posts' => $newPosts,
                'blogposts'=>$this->get('entityMgr.Mgr')->getByPage('AppBundle:blogPost',1,5)
            ]
        );
    }

    /**
     * @Route("/admin/delete/blogpost/{id}", name="adminDeleteBlogPost")
     */
    public function adminDeleteBlogPost($id)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('blogAccess'))
            return $this->redirectToRoute('401');
        if(! $this->get('entityMgr.mgr')->existById('AppBundle:blogPost',$id))
            return $this->redirectToRoute('404');

        $this->get('entityMgr.mgr')->deleteById('AppBundle:blogPost',$id);
        return $this->redirectToRoute('adminListBlogPost',['page'=>1]);

    }

    /**
     * @Route("/admin/edit/blogpost/{id}", name="adminEditBlogPost")
     */
    public function adminEditBlogPost(Request $request,$id)
    {
        if (!$this->get('user.mgr')->ThisUserHasPermission('blogAccess'))
            return $this->redirectToRoute('401');
        if(! $this->get('entityMgr.mgr')->existById('AppBundle:blogPost',$id))
            return $this->redirectToRoute('404');
        $form = $this->get('entityMgr.edit')->render('AdminBundle:blogPostSubmit.yml',$id);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $this->get('entityMgr.edit')->submit('AdminBundle:blogPostSubmit.yml', $form);
            $post = $this->get('entityMgr.mgr')->getById('AppBundle:blogPost', $id);
            return $this->redirectToRoute('blogPost', ['id' => $post->getSID()]);
        }

        return $this->render('AdminBundle:blog:editPost.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
