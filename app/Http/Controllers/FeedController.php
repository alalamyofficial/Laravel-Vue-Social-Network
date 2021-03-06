<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Post;

class FeedController extends Controller
{
    public function feed()
    {
        $friends = Auth::user()->friends();

        $feed = array();

        foreach($friends as $friend):
                foreach($friend->posts as $post):
                    array_push($feed, $post);
                endforeach;
        endforeach;

        foreach(Auth::user()->posts as $post):
            array_push($feed, $post);
        endforeach;

        usort($feed, function($p1, $p2){
            return $p1->id < $p2->id;
        });

        return $feed;
    }
}
