<?php

namespace Cursos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CursosController extends AbstractActionController {

     public function indexAction()
    {
        return new ViewModel();
    }
	


}

