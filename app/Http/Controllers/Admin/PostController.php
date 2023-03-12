<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\Post\CheckSlugRequest;
use App\Http\Requests\Post\GenerateSlugRequest;
use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

/**
 * @method successResponse(string $slug)
 * @method errorResponse()
 */
class PostController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $data = Post::query()
            ->addSelect('posts.*')
            ->join('users','users.id','posts.user_id')
            ->addSelect('users.name as userName')
            ->paginate();
//        dd($data);
        return view('admin.post.index', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(PostStoreRequest $request)
    {
        $arr = $request->validated();

        Post::create($arr);

        return redirect()->route('admin.posts.index');
    }

        public function edit(Post $post)
    {
//        $data = Post::find($post)->first();
        dd($post);
//        return view('admin.post.edit',[
//            'data'=>$data,
//        ]);
    }

    public function update(Request $request,$id)
    {
        $object  = Post::find($id);
        $object->fill($request->except('_token'));
        $object->save();
        return redirect()->route('admin.posts.index');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->back();
    }

    public function editPostStatus($post)
    {
        Post::find($post)->update(['status'=>'1']);
        return redirect()->back();
    }

}
