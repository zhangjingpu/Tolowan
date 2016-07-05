<?php
$settings = array(
	'formId' => 'login',
	'form' => array(
		'action' => '',
		'method' => 'post',
		'class' => array(),
		'accept-charset' => 'utf-8',
		'role' => 'form',
		'id' => 'login',
	),
	'password' => array(
		'label' => '密码',
		'userOptions' => array(
			'labelAttributes' => array(
				'class' => array(),
			),
			'groupAttributes' => array(
				'class' => array(),
				'id' => 'group_name',
			),
			'widgetBoxAttributes' => array(
				'class' => array(),
			),
			'helpAttributes' => array(
				'class' => array(),
			),
		),
		'error' => '',
		'description' => '登陆密码',
		'field' => 'string',
		'widget' => 'Password',
		'validate' => array(),
		'attributes' => array(),
		'required' => true,
	),
	'ConfirmationPassword' => array(
		'label' => '确认密码',
		'userOptions' => array(
			'labelAttributes' => array(
				'class' => array(),
			),
			'groupAttributes' => array(
				'class' => array(),
				'id' => 'group_name',
			),
			'widgetBoxAttributes' => array(
				'class' => array(),
			),
			'helpAttributes' => array(
				'class' => array(),
			),
		),
		'error' => '',
		'description' => '重复之前输入的密码',
		'field' => 'string',
		'widget' => 'Password',
		'validate' => array(),
		'attributes' => array(
			array(
				'v' => 'Confirmation',
				'with' => 'password',
				'message' => '前后输入的密码不一样',
			),
		),
		'required' => true,
	),
);
