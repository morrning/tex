<?php
/**
 * Created by PhpStorm.
 * User: sarkesh
 * Date: 11/27/17
 * Time: 9:53 AM
 */

namespace gridBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class simpleGrid
{
    //twig template engine
    private $templating;
    //data for store
    private $baseData;
    //header title of datagrid
    private $header;
    //buttons route for edit delet and view
    private $deletBtn;
    private $editBtn;
    private $viewBtn;
    private $goBtn;

    //data of current page
    private $currentPageNum;
    private $currentRouteName;
    private $countAll;
    private $perPage;
    private $currentRouteParams;
    private $commandRouteParams;
    private $commandSPVariable;
    public function __construct(EngineInterface $templating)
    {
        $this->templating = $templating;
        $this->baseData = [];
        //config buttons
        $this->deletBtn = null;
        $this->editBtn = null;
        $this->viewBtn = null;
        $this->goBtn = null;

        $this->commandSPVariable = 'id';
        //config current page
        $this->currentPageNum = 1;
        $this->currentRouteParams = [];
        $this->commandRouteParams = [];
        $this->perPage = 10;
        $this->countAll=0;
    }

    private function hasNext()
    {
        if($this->getEndRecord() <= $this->countAll){
            return true;
        }

        return false;
    }

    private function hasPrevious()
    {
        if($this->currentPageNum==1)
            return false;
        return true;
    }

    private function getEndRecord()
    {
        return $this->perPage * $this->currentPageNum;
    }


    public function prepare($gridData)
    {

        $this->data = [];
        if(count($gridData['data'])!= 0){
            if(is_object($gridData['data'][0]))
            {
                $getters = array_filter(get_class_methods($gridData['data'][0]), function($method) {
                    return 'get' === substr($method, 0, 3);
                });

                $row = [];
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
            }
            else
            {
                $newRow = [];
                foreach ($gridData['data'] as $keyRow => $row)
                {
                    foreach ($row as $keyCol => $col)
                    {
                        if(array_key_exists($keyCol,array_keys($gridData['selector'])))
                            $newRow[$keyCol] = $col;
                    }

                    array_push($this->baseData,$row);
                }
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

            if(array_key_exists('current-page-num',$gridData))
                $this->currentPageNum = $gridData['current-page-num'];

            $this->currentRouteName = $gridData['current-route-name'];

            if(array_key_exists('perPage',$gridData))
                $this->perPage = $gridData['perPage'];

            if(array_key_exists('current-route-params',$gridData))
                $this->currentRouteParams = $gridData['current-route-params'];

            if(array_key_exists('command-route-params',$gridData))
                $this->commandRouteParams = $gridData['command-route-params'];

            if(array_key_exists('command-sp-variable',$gridData))
            {
                $this->commandSPVariable = $gridData['command-sp-variable'];
            }
            else
            {
                if(!is_object($gridData['data'][0]))
                    $this->commandSPVariable = 'id';
            }

            $this->countAll = $gridData['count-all'];
        }

    }

    public function render($gridData)
    {
        if(count($gridData['data']) == 0)
            return $this->templating->render('gridBundle:grid:nothing.html.twig');
        $this->prepare($gridData);
        if ( is_object($gridData['data'][0])) {
            $templateName = 'gridBundle:grid:simple.html.twig';
        }
        else
        {
            $templateName = 'gridBundle:grid:simpleArray.html.twig';
        }
        return $this->templating->render($templateName,
            [
                'viewedData'=>$this->baseData,
                'headers'=>$this->header,
                'btnDelete' => $this->deletBtn,
                'btnEdit'=>$this->editBtn,
                'btnView'=>$this->viewBtn,
                'btnGo'=>$this->goBtn,
                'page'=>$this->currentPageNum,
                'route'=>$this->currentRouteName,
                'nextPage'=>$this->hasNext(),
                'previousPage'=>$this->hasPrevious(),
                'perPage'=>$this->perPage,
                'countAll'=>$this->countAll,
                'RouteParams'=>$this->currentRouteParams,
                'commandRouteParams'=>$this->commandRouteParams,
                'spVariable'=>$this->commandSPVariable
            ]);
    }

}
