<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
   public $components = array(
                        'Session',
                        'Auth' => array(
			       'loginAction' => array(
                                               'controller' => 'user',
                                               'action' => 'login'
                               ),
/*
                               'loginRedirect' => array(
                                               'controller' => 'user',
                                               'action' => 'index'
                               ),
*/
                               'loginRedirect' => array(
                                               'controller' => 'vendor',
                                               'action' => 'index'
                               ),
/* Causes loop with the 'user' => 'logout' action
                               'logoutRedirect' => array(
                                                'controller' => 'user',
                                                'action' => 'logout'
                               ),
*/
                               'authenticate' => array('Form')
                         ),
                        'DebugKit.Toolbar'
   );
//-----------------------------------------------------------------------------
   public function beforeFilter() {
      if (isset($this->request->params['admin'])) {
//echo "\n<pre>PARAMS array\n";
//debug($this->request->params);
echo "\n<pre>PARAMS=admin\n";
debug($this->request->params['admin']);
echo "\n</pre>\n";
//         $this->Auth->loginRedirect = array('controller'=>'user', 'action'=>'index');
         $this->Auth->loginRedirect = array('controller'=>'vendor', 'action'=>'index');
      } else {
echo "\n<pre>THIS IS NOT AN ADMIN!!!\n";
echo "\n</pre>\n";
      // sb: Definte actions which Auth does not need to check sid and session
         $this->Auth->loginRedirect = array('controller'=>'vendor', 'action'=>'index');
         $this->Auth->allow('register', 'thanks');
      }
   }
//-----------------------------------------------------------------------------
}
