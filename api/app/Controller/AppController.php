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

    public $components = array('RequestHandler');

    public function beforeFilter()
    {
        if ( $this->request->is('options') ) {
            $this->_set_json( 'OK' );
        }
        $this->response->header('Access-Control-Allow-Origin: *');
        $this->response->header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        $this->response->header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        $this->RequestHandler->ext = 'json';
    }


    public function index()
    {
        if ( $this->request->is('options')==false ) {
            $this->_set_json( $this->{ $this->modelClass }->find('all') );
        }
    }


    public function view($id=null)
    {
        if ( $this->request->is('options')==false ) {
            $res = $this->{ $this->modelClass }->findById($id);
            $this->_set_json( $this->{ $this->modelClass }->findById($id) );
        }
    }


    public function add()
    {
        if ( $this->request->is('options')==false ) {
            $this->request->data['id']=null;
            $this->{ $this->modelClass }->create();
            $results = $this->{ $this->modelClass }->save($this->request->data);
            if ( $results ) {
                $results = 'Saved';
            } else {
                $results = 'Error';
            }
            $this->_set_json( $results );
        }
    }


    public function edit($id=null)
    {
        if ( $this->request->is('options')==false ) {
            $this->{ $this->modelClass }->id = $id;
            $results = $this->{ $this->modelClass }->save($this->request->data);
            if ( $results ) {
                $results = 'Saved';
            } else {
                $results = 'Error';
            }
            $this->_set_json( $results );
        }
    }


    public function delete($id=null)
    {
        if ( $this->request->is('options')==false ) {
            $results = $this->{ $this->modelClass }->delete( $this->request->params['id'] );
            if ( $results ) {
                $results = 'Saved';
            } else {
                $results = 'Error';
            }
            $this->_set_json( $results );
        }
    }


    function _set_json($results)
    {
        $this->set(array(
                'results' => $results,
                '_serialize' => 'results'
        ));
    }
}
