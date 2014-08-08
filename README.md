TranslationBackend
==================

A Yii2 backend module for translation updating 

Installation
============

In config file (main.php) :

 'modules' => [
		'TranslationBackend' => [
            'class' => 'backend\modules\TranslationBackend\TranslationBackend',
        ],
	],
	
In you params.php :
return [
	'languages' => [] //add your language here eg : ['fr', 'nl']
];
