<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('welcome');
});

Route::get('/test/echo', function () {
    echo 'welcome';
});

Route::get('/test/noesp', function () {
    $str = 'welcome<br>welcome';
    echo $str;
});

Route::get('/test/esp', function () {
    $str = 'welcome<br>welcome';
    echo htmlspecialchars($str);
});

Route::get('/test/esp', function () {
    $str = 'welcome<br>welcome';
    echo $str;
});

Route::get('/test/json', function () {
    $ary = ['one', 'two', 'three'];
    return $ary;
});

Route::get('/test/jsonmulti', function () {
    $ary = [['id'=>1, 'title'=>'one'], ['id'=>2,'title'=>'two']];
    return $ary;
});

Route::get('/test/param/{id}', function ($id) {
    echo "id={$id}";
});

Route::get('/test/param/{id}/{title}', function ($id, $title) {
    echo "id={$id},title={$title}";
});

Route::get('/test/anyparam/{id?}', function ($id=0) {
    echo "id={$id}";
});

Route::get('/test/name', function () {
    echo "routename";
})->name('routename');

Route::get('/test/modeldump', function () {
    $message = new App\Message;
    var_dump($message);
});

Route::get('/test/modelinsert', function () {
    $message = new App\Message;
    $message->title = 'title_101';
    $message->body = 'body_101';
    $message->save();
    // 追加された主キーの取得。
    $id = $message->id;
    var_dump($id);
});

Route::get('/test/modelreuse', function () {
    $message = new App\Message;
    $message->title = 'title_102';
    $message->body = 'body_102';
    $message->save();
    // 追加された主キーの取得。
    $id = $message->id;
    var_dump($id);
    // created_atとupdated_atの差分用
    sleep(3);
    // インスタンスをそのまま使い、今度は更新
    $message->title = 'title_102_reuse';
    $message->body = 'body_102_reuse';
    $message->save();
    // 今度は更新なので主キーは変わらない。
    $id_reuse = $message->id;
    var_dump($id_reuse);
});

Route::get('/test/modelupdate', function () {
    $message = App\Message::find(1);
    $message->title = 'title_1_update';
    $message->body = 'body_1_update';
    $message->save();
    var_dump($message->id);
});

Route::get('/test/modeldelete', function () {
    // delete()するようのデータを新規追加
    $message = new App\Message;
    $message->title = 'title_delete';
    $message->body = 'body_delete';
    $message->save();
    $id = $message->id;
    $message->delete();
    var_dump($id);
});

Route::get('tutorial', 'TutorialController@index');
Route::get('tutorial/create', 'TutorialController@create');
Route::post('tutorial', 'TutorialController@store');

Route::match(['get', 'post', 'patch'], 'tutorial/formtest', function () {
    return view('tutorial.formtest');
});

Route::get('sitemap', 'SiteMap');
Route::get('sitemap/{status}', 'SiteMap');

Route::resource('messages', 'MessagesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
