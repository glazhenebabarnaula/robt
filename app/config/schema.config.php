<?php
return array(
	'Page' => array(
		'relations' => array(
			'category' => array('belongs', 'Category', 'category_id'),
			'authors' => array('many_many', 'Author', 'page_author', 'page_id', 'author_id'),
		),
	),
	'Category' => array(
		'relations' => array(
			'pages' => array('has_many', 'Category', 'category_id'),
		),
	),

);
