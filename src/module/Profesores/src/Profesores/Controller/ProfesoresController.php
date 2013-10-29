<?php

namespace Profesores\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ProfesoresController extends AbstractActionController {

    public function indexAction()
    {
        return new ViewModel();
    }
	


}

