<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Item\Controller\Item' => 'Item\Controller\ItemController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'item' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/item[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Item\Controller\Item',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    
    'view_manager' => array(
        'template_path_stack' => array(
            'Item' => __DIR__ . '/../view',
        ),
    ),
);
