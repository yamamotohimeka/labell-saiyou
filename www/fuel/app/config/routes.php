<?php
return array(
	'_root_'  => 'index',  // The default route
	'_404_'   => '404',    // The main 404 route
    'index/:id' => 'index/$1',

    'inputdata/data/:id' => 'inputdata/data/$1',
    'inputdata/sameperson/:id' => 'inputdata/sameperson/$1',
    'inputdata/send_schdl/:id' => 'inputdata/send_schdl/$1',
    'mailtmpl/form/:id' => 'mailtmpl/form/$1',

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

    'img/(:any)/(:num)/(:num)' => 'Picresize/index/$1/$2/0/0/1/',
    'img/(:any)/(:num)/w(:num)' => 'Picresize/index/$1/$2/$3/0/1/',
    'img/(:any)/(:num)/h(:num)' => 'Picresize/index/$1/$2/0/$3/1/',
    'img/(:any)/(:num)/w(:num)-h(:num)' => 'Picresize/index/$1/$2/$3/$4/1/',
);
