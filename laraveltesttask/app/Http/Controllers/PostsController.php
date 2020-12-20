<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Requests\FormCustomRequest;
use App\Models\Posts;
use App\Models\Comments;

class PostsController extends Controller
{   
    public function getAll ($posts_limit = null) {
        //Задание 6, вывод всех активных пользователей вместе с их неудаленными постами. Код писался с основным упором на минимальное количество используемых запросов к БД. 

        //Получение массива со всеми пользователями
    	$data = UserController::getAllUsersData();
        //Получение массива с id всех полученных пользователей
        foreach ($data as $user) {
            $usersId[] = $user['id'];
        }
        //Выполнение запроса с получением неудаленных постов всех пользователей
		$posts = Posts::join('images', 'posts.image_id', '=', 'images.id')->whereIn('author_id', $usersId)->where('deleted_at', '=', NULL)->get(['posts.id', 'posts.author_id', 'posts.content', 'posts.created_at', 'images.url']); 
        //Перевод данных в формат массива
		$postsArray = $posts->toArray();
        //Получение массива с id всех полученных постов, а так же конвертирование даты публикации постов в более удобный формат
        foreach ($postsArray as $postKey => $post) {
            //Конвертация даты публикации с использованием функции explode()
            $postsArray[$postKey]['created_at'] = explode('T', $postsArray[$postKey]['created_at'])[0];

            $postsId[] = $post['id'];
        }
        //Задание 6.2, получение количества комментариев к каждому посту
        //Выполнение запроса с получением комментариев ко всем полученным постам
        $comments = Comments::join('posts', 'comments.post_id', '=', 'posts.id')->whereIn('comments.post_id', $postsId)->get('comments.post_id');
        //Перевод данных в формат массива
        $commentsArray = $comments->toArray();
        //Определение зависимости комментариев к постам и добавление количества комментариев к каждому посту
        foreach ($postsArray as $postKey => $post) {
            $postComments = [];
            foreach ($commentsArray as $commentKey => $comment) {
                if ($post['id'] == $comment['post_id']) {
                    $postComments[] = $commentsArray[$commentKey];
                }
            }
            $postsArray[$postKey]['count_of_comments'] = count($postComments);
        }
        //Задание 6.3, сортировка постов по количеству комментариев по убыванию
        usort($postsArray, function ($a, $b) {
            return $a['count_of_comments'] < $b['count_of_comments'];
        });
        //Определение зависимости постов к определенным пользователям и добавление постов в коллекцию соответственно
        foreach ($data as $userKey => $user) {
            $userPosts = [];
            foreach ($postsArray as $postKey => $post) {
                //Задание 6.1, обработка параметра $posts_limit
                if (count($userPosts) < $posts_limit){
                    if ($user['id'] == $post['author_id']) {
                        $userPosts[] = $postsArray[$postKey];
                    }
                }
            }
            $data[$userKey]['posts'] = $userPosts;
        }
        //Передача массива с данными view
		return view('posts', ['data' => $data]);
    }
}

//  Изначальный вариант метода, который был переписан из-за использования большого количества запросов к БД в цикле
    
    // $users = isset($posts_limit) ? 
    // Users::select('id', 'name')->limit($posts_limit)->where('active', '=', 'TRUE')->get() :
    // Users::select('id', 'name')->where('active', '=', 'TRUE')->get();
    // //Переводим данные с формата json в формат массива
    // $data = $users->toArray();
    // for ($i=0; $i < count($data); $i++) { 
    //     //Выполняем запрос с получением неудаленных постов заданного пользователя
    //     $posts = Posts::join('images', 'posts.image_id', '=', 'images.id')->where('author_id', '=', $data[$i]['id'])->where('deleted_at', '=', NULL)->get(['posts.id', 'posts.content', 'posts.created_at', 'images.url']); 
    //     //Переводим данные с формата json в формат массива
    //     $postsArray = $posts->toArray(); 
    //     for ($j=0; $j < count($postsArray); $j++) { 
    //         $commentscount = Comments::join('posts', 'comments.post_id', '=', 'posts.id')->where('comments.post_id', '=', $postsArray[$j]['id'])->count();
    //         $postsArray[$j]['count_of_comments'] = $commentscount;
    //         $postsArray[$j]['created_at'] = explode('T', $postsArray[$j]['created_at'])[0];
    //     }
    //     usort($postsArray, function ($a, $b) {
    //         return $a['count_of_comments'] < $b['count_of_comments'];
    //     });
    //     $data[$i]['posts'] = $postsArray;
    // }    

