<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Models\Comments;
use App\Models\Users;

class CommentsController extends Controller
{
    public function getUsers () {
    	$data = UserController::getAllUsersData();
    	return view('comments', ['data' => $data]);
    }

    public function getCommentsByUser ($user_id) {
    	//Задание 7, вывод всех коментариев выбранного аккаунта к постам, в которых есть изображение.

    	//Задание 7.1, альтернативная запись запроса с использованием чистого SQL
    	// $data['comments'] = json_decode(json_encode(DB::select("SELECT id, post_id, content, created_at FROM comments WHERE commentator_id = $user_id")), true);

    	//Получение коллекции с комментариями от выбранного пользователя, а так же ленивой загрузки (7.2) ссылки на изображение поста
    	$data = Comments::join('posts', 'posts.id', '=', 'comments.post_id')->join('images', 'images.id', '=', 'posts.image_id')->where('commentator_id', '=', $user_id)->whereNotNull('posts.image_id')->get(['comments.id', 'comments.post_id', 'comments.content', 'comments.created_at', 'images.url AS image_url']);
    	//Задание 7.2, жадная загрузка тела поста к каждому комментарию
    	//Задание 7.3, подгрузка автора поста в тело каждого поста
    	foreach ($data as $commentKey => $comment) {
    		$comment = $comment->load('post.author');
        }
        //Конвертация коллекции в массив
        $dataArray['comments'] = $data->toArray();
        //Конвертация таймстампа в удобный для вывода формат
    	foreach ($dataArray['comments'] as $commentKey => $comment) {
    		$dataArray['comments'][$commentKey]['created_at'] = explode('T', $dataArray['comments'][$commentKey]['created_at'])[0];
        }
        //Задание 7.1, альтернативная запись запроса с использованием чистого SQL
        // $data['username'] = DB::select("SELECT name FROM users WHERE id = $user_id")[0]->name;

        //Получение имени аккаунта, которое пользователь выбрал на предыдущей странице 
    	$dataArray['username'] = Users::select('name')->where('id', '=', $user_id)->get()->toArray()[0]['name'];
    	//Конвертация данных в формат json, как указано в задании
    	$dataJson = json_encode($dataArray);
    	//Передача массива с данными view
    	return view('commentById', ['data' => $dataJson]);
    }
}
