<?php
/**
 * Created by PhpStorm.
 * User: rwd
 * Date: 12/22/17
 * Time: 1:43 AM
 */

namespace gridBundle\Service;

namespace gridBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class perOnePage
{
    //twig template engine
    private $templating;
    //data for store
    private $baseData;
    //header title of datagrid
    private $header;
    //buttons route for edit delet and view
    private $editParams;
    private $deletBtn;
    private $editBtn;
    private $viewBtn;
    private $goBtn;

    private $countAll;


    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
        $this->baseData = [];
        //config buttons
        $this->deletBtn = null;
        $this->editBtn = null;
        $this->viewBtn = null;
        $this->goBtn = null;
        $this->editParams = null;
        $this->countAll = 0;
    }

    public function prepare($gridData)
    {

        $this->data = [];
        if(count($gridData['data'])!= 0){
            $getters = array_filter(get_class_methods($gridData['data'][0]), function($method) {
                return 'get' === substr($method, 0, 3);
            });

            $row = [];
            $rowForShow = [];
            foreach ($gridData['data'] as $entity)
            {
                foreach ($gridData['selector'] as $selector)
                {
                    $methodName = 'get' . $selector;
                    $key =  array_search($methodName, $getters);
                    $varName = str_replace('get','',$getters[$key]);
                    $row[$varName] = $entity->$methodName();
                }

                array_push($this->baseData,$row);
            }

            //perpare headers
            $this->header = $gridData['header'];

            //perpare btns
            if(array_key_exists('btn-delete',$gridData))
                $this->deletBtn = $gridData['btn-delete'];
            if(array_key_exists('btn-edit',$gridData))
                $this->editBtn = $gridData['btn-edit'];
            if(array_key_exists('btn-view',$gridData))
                $this->viewBtn = $gridData['btn-view'];
            if(array_key_exists('btn-go',$gridData))
                $this->goBtn = $gridData['btn-go'];
            if(array_key_exists('edit-params',$gridData))
                $this->editParams = $gridData['edit-params'];
            $this->countAll = count($gridData['data']);
        }

    }

    public function render($gridData)
    {
        if(count($gridData['data']) == 0)
            return $this->templating->render('gridBundle:grid:nothing.html.twig');
        $this->prepare($gridData);
        return $this->templating->render('gridBundle:grid:onePage.html.twig',
            [
                'viewedData'=>$this->baseData,
                'headers'=>$this->header,
                'btnDelete' => $this->deletBtn,
                'btnEdit'=>$this->editBtn,
                'btnView'=>$this->viewBtn,
                'btnGo'=>$this->goBtn,
                'countAll'=>$this->countAll,
                'editParams'=>$this->editParams
            ]);
    }

}