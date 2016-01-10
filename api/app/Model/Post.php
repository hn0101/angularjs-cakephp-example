<?php
App::uses('AppModel', 'Model');

class Post extends AppModel {

    public $belongsTo = array(
        'Category' => array(
            'foreignKey' => 'categoryId'
        )
    );
}