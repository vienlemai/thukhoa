<?php
$config = array();

if($_SERVER['HTTP_HOST']=='localhost'){
    $config['base']['sitename']='LibraryManagement';
    $config['base']['url'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$config['base']['sitename'].'/';   
}  
else{
    $config['base']['sitename']=''; // neu chay truc tiep tren domain thi de trong
    $config['base']['url'] = 'http://'.$_SERVER['HTTP_HOST'].'/'.$config['base']['sitename'].'/';
    if(substr($config['base']['url'],strlen($config['base']['url'])-2,2)=='//')
       $config['base']['url'] = substr($config['base']['url'],0,-1); 
}                           
$config['base']['file'] = $config['base']['url'].'app/webroot/files/'; 
$config['base']['upload'] = $config['base']['url'].'app/webroot/files/image-uploaded/';
$config['base']['img'] = $config['base']['url'].'app/webroot/img/';
$config['base']['images'] = $config['base']['url'].'app/webroot/images/';
$config['admin']['rows_per_page'] = 20;
$config['site']['languages'] = array(
    'vie'=>array(
        'img'=>'worldflagicon/png/vn.png'),
        'eng'=>array('img'=>'worldflagicon/png/england.png'
    )
);
$config['site']['default_language'] = 'vie';

?>