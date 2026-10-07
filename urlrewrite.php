<?php
$arUrlRewrite=array (
  2 => 
  array (
    'CONDITION' => '#^/kvartiry/([a-z0-9\\-]+)/?(?:\\?.*)?$#',
    'RULE' => 'code=$1',
    'ID' => '',
    'PATH' => '/kvartiry/detail.php',
    'SORT' => 90,
  ),
  3 => 
  array (
    'CONDITION' => '#^/novosti/([a-z0-9\\-]+)/?(?:\\?.*)?$#',
    'RULE' => 'code=$1',
    'ID' => '',
    'PATH' => '/novosti/detail.php',
    'SORT' => 90,
  ),
  0 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
