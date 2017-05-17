<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
use DwSetpoint\Models\Post;
/**
 *
 */
class PostController extends Controller
{

  public function getPost(Post $post)
  {
    return  view('public/pages/news-details',compact('post'));
  }
}
