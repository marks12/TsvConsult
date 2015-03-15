<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/TsvConsult for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace TsvConsult\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use TsvConsult\Entity\TsvConsultation;
use Zend\View\Model\JsonModel;

class TsvConsultAdminController extends AbstractActionController
{
    public function indexAction()
    {
        return array();
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /tsvConsult/tsv-consult/foo
        return array();
    }
    
    public function saveConsAction()
    {
    	$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    	
    	$request_data = json_decode(file_get_contents("php://input"), true);

    	$start_date = $request_data['start_date'];
    	$end_date = $request_data['end_date'];
        
    	if (checkdate(explode("-", $start_date)[1], explode("-", $start_date)[0], explode("-", $start_date)[2]) 
    	&& checkdate(explode("-", $end_date)[1], explode("-", $end_date)[0], explode("-", $end_date)[2])) 
    	{

    		$consultation = new TsvConsultation();
    		$consultation->__set("start_date", explode("-", $start_date)[2]."-".explode("-", $start_date)[1]."-".explode("-", $start_date)[0]);
    		$consultation->__set("end_date", explode("-", $end_date)[2]."-".explode("-", $end_date)[1]."-".explode("-", $end_date)[0]);
    		$em->persist($consultation);
    		$em->flush();
    		
    		$error = "ok";
    	}
    	else 
    	{
    		$error = "Одна из указанных дат не существует";
    	}
    	
    	$result = new JsonModel(array(
    			'success'	=>	true,
    			'error'		=>	$error
    	));

    	
    	return $result;
    }
}
