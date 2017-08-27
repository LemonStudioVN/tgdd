<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display(...$path)
    {
        $this->viewBuilder()->layout('client');
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }

        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));
        $this->_setAdvertising();
        $this->_setBanner();

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    /**
     * 
     */
    private function _setAdvertising(){
        $ads[0]['alt'] = "top_left_banner";
        $ads[0]['url'] = "banners/banner1.png";
        
        $ads[1]['alt'] = "top_right_banner";
        $ads[1]['url'] = "banners/banner2.png";
        
        $ads[2]['alt'] = "bottom_banner";
        $ads[2]['url'] = "banners/banner3.png";

        $this->set(compact('ads'));
    }

    /**
     * 
     */
    private function _setBanner(){
        $banner['h2'] = "Chào mừng đến với";
        $banner['span'] = "Lem Mobile";    
        $banner['description'] = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eradum eiusmod tempor incididunt ut labore et dolore magna aliqua.";     
        $banner['link_name'] = "Đến khu mua sắm";
        $banner['h4'] = "Hi!";

        $this->set(compact('banner'));
    }
}
