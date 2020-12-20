<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function getAllUsersData () {
    	$users = Users::select('id', 'name')->where('active', '=', 'TRUE')->get();
    	return $users->toArray();
    }
}
