<?php

/*
 * *********************************************
 * @author:XuanDacIT <xuandac990@gmail.com>
 * Time:Sep 14, 2017, 3:11:55 PM. 
 * *********************************************
 */
$w = ":\w+"; //String params
$d = ":\d+"; //Integer params
return [
    "<controller$w>/<id$d>" => "<controller>/view",
    "<controller$w>/<action$w>/<id$d>" => "<controller>/<action>",
    "404.html" => 'site/error',
    //"tin-tuc"=>'categories-post/index',      
    [
        'pattern' => '/tin-moi',
        'route' => 'categories-post/new',
    ],
    "<slug>-c<id:\d+>" => 'categories-post/index',
    "<slug>" => 'categories-post/view-post',
    [
        'pattern' => '/tin-moi/<alias:[\w-]+>',
        'route' => 'categories-post/new',
    ],
    
        [
        'pattern' => 'tag/<slug>',
        'route' => 'categories-post/tag-post',
    ],
        [
        'pattern' => '/tin-noi-bat/<alias:[\w-]+>',
        'route' => 'categories-post/new-feature',
    ],
];
