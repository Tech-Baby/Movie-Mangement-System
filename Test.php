<?php

 include_once "DbConfig.php";
 include_once "Crud.php";



// $data_array = [
//     'mv_year_released' => '1999-03-01',
//     'mv_title' => 'Rush hour 1' 

    
// ];

// $crud = new Crud();

// // $crud->create($data_array,'movies');


// // $results = $crud->read('SELECT * from movies');

// // var_dump($results);

// // $crud->update("UPDATE movies SET mv_title = 'Titanic 2' where mv_id = 1");


// $crud->delete("DELETE from movies where mv_id = 2");

// include_once "Paginator.php";

// $paginator = new Paginator(15,5);

    
// echo $paginator->get_pagination_links();
// echo $paginator->get_offset_and_limit();


$crud = new Crud();
$crud->create(['name'=>'Admin User', 'username'=>'admin','password'=> md5('admin123')],'users');



?>