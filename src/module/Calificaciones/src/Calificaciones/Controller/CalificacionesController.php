<?php

namespace Calificaciones\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CalificacionesController extends AbstractActionController {

    public function indexAction()
    {
        return new ViewModel();
    }


}

