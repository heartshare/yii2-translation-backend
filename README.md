TranslationBackend
==================

A Yii2 backend module for translation updating 

Installation
============

In config file (main.php) :
  <pre>
 'modules' => [
		'TranslationBackend' => [
            'class' => 'backend\modules\TranslationBackend\TranslationBackend',
        ],
	],
  </pre>	
In you params.php :
  <pre>
return [
	'languages' => [] //add your language here eg : ['fr', 'nl']
];
  </pre>
