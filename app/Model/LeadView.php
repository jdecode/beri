<?php

App::uses('AppModel', 'Model');

/**
 * Lead Model
 *
 */
class LeadView extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );

}
