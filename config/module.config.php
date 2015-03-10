<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'TsvConsult\Controller\TsvConsult' => 'TsvConsult\Controller\TsvConsultController',
            'TsvConsult\Controller\TsvConsultAdmin' => 'TsvConsult\Controller\TsvConsultAdminController',
        ),
    ),
    'router' => array(
        'routes' => array(
      		'zfcadmin' => array(
				'child_routes' => array(
      				'consultation' => array(
      					'type'    => 'Literal',
      						'options' => array(
      							// Change this to something specific to your module
      							'route'    => '/consultation',
      							'defaults' => array(
      									// Change this value to reflect the namespace in which
      									// the controllers for your module are found
      									'__NAMESPACE__' => 'TsvConsult\Controller',
      									'controller'    => 'TsvConsultAdmin',
      									'action'        => 'index',
      							),
      						),
      						'may_terminate' => true,
      						'child_routes' => array(
      							// This route is a sane default when developing a module;
      							// as you solidify the routes for your module, however,
      							// you may want to remove it and replace it with more
      							// specific routes.
      							'default' => array(
      								'type'    => 'Segment',
      								'options' => array(
      										'route'    => '/[:controller[/:action]]',
      										'constraints' => array(
      												'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
      												'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
      										),
      										'defaults' => array(
      												),
									),
      							),
      						),
      				),
      			),
			),
      			
            'consultation' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/consultation',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'TsvConsult\Controller',
                        'controller'    => 'TsvConsult',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
	'navigation' => array(
			'admin' => array(
					'consultation' => array(
							'label' => 'План мероприятий',
							'route' => 'zfcadmin/consultation',
					),
			),
	),
    'view_manager' => array(
        'template_path_stack' => array(
            'TsvConsult' => __DIR__ . '/../view',
        ),
    ),
	'bjyauthorize' => array(
			'guards' => array(
					'BjyAuthorize\Guard\Controller' => array(
	
							array(
									'controller' => 'TsvConsult\Controller\TsvConsult',
									'roles'	=> array('admin','user'),
							),
							array(
									'controller' => 'TsvConsult\Controller\TsvConsultAdmin',
									'roles'	=> array('admin'),
							),
	
					),
			),
	),
);
