<?php 
/*
  |------------------------------------------------------------------
  |          REGISTRATION ALL LISTS ROUTES OF APPLICATION
  |------------------------------------------------------------------
*/

# add home route

// Route::package('task', "TaskController");


Route::get('', "TaskController@index");
Route::get('page=:id', "TaskController@index")->with('id', '([0-9]+)');
Route::get('sort_by=:sort', "TaskController@index")->with('sort', '[a-z\-]+');



# https ? http ://your-base-url/task/create
Route::get('/task/add', "TaskController@add");
Route::post('/task/add', "TaskController@add");


# https ? http ://your-base-url/task/edit/1
Route::get('/task/edit/:id', "TaskController@edit", 'task.show')->with('id', '[0-9]+');
Route::post('/task/edit/:id', "TaskController@edit")->with('id', '[0-9]+');


# https ? http ://your-base-url/task/delete/1
Route::get('/task/delete/:id', "TaskController@delete", 'task.remove')->with('id', '[0-9]+');



// Logout 
Route::get('/logout', "BaseController@logout");



/*
 |------------------------------------------------------------------
 |                 NOT FOUND ROUTE / PAGE
 |------------------------------------------------------------------
*/

Route::get('/404', 'NotFoundController@index');
Route::notFound('/404');




/*
  /------------------------------------------------------------------
  /                ADMIN WHITE LISTS ROUTES
  /------------------------------------------------------------------
*/
  

$adminOptions = [
	'prefix' => '/dashboard',
	'controller' => 'admin'
];


Route::group($adminOptions, function () {
    
    // http://framework.loc/dashboard/login
    Route::get('/login', "UserController@login");
    Route::post('/login', "UserController@login");
    
});











