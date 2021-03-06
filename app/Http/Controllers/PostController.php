<?php

namespace App\Http\Controllers;

use App\Common\Helper;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $credentials = [
          "text" => $request->input("text"),
            "flair" => $request->input("flair")
        ];
        $post = Post::create($credentials);
        return Helper::apiResponse(true,  "Successfully created record.", $post);
    }

    public function get(Request $request) {
        $page = $request->query("page");
        $posts = Post::orderBY("created_at", "desc")->paginate(10, ["*"], "page", $page);
        return Helper::apiResponse(true,  "Successfully got records.", $posts);
    }
}
