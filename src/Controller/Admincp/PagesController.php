<?php
namespace App\Controller\Admincp;

use App\Controller\AppController;

class PagesController extends AppController
{
	public function index(){
		$this->viewBuilder()->setLayout(false);
	}
}