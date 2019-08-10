<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;

/**
 * 文章管理
 * Class PostController
 * @author Qasim <15750783791@163.com>
 * @date 2019-05-24
 * @package App\Http\Controllers\Admin
 */
class PostController extends BaseController
{

    /**
     * 文章首页
     */
    public function index()
    {

        return view('admin.post.list');

    }



    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function lists(Request $request)
    {

        try{

            $obj = Post::with(['tags', 'user'])->orderBy('id', 'desc');

            //文章标题检索
            if($title = $request->input('title')){

                $obj = $obj->where('title', $title);

            }

            //文章发布状态检索
            if(($status = $request->input('status')) !== null){

                $obj = $obj->where('status', $status);

            }

            $posts = $obj->paginate(10);

        }catch (Exception $exception){

            return $this->json(0, '获取数据失败', [], $exception->getMessage());

        }

        return $this->json(1, '获取数据成功', $posts);

    }

    /**
     * 添加文章页面
     */
    public function add()
    {

        return view('admin.post.add');

    }


    /**
     * 保存文章
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {

        if(empty($request->isJson())){

            return $this->json(0, '没有接收到json参数');

        }
        //参数验证
        try{

            $this->validate($request, [
                'title' => 'required|string|min:10|max:100',
                'description' => 'required|string|min:10|max:255',
                'content' => 'required|string|min:10',
                'image' => 'required|string',
                'status' => 'required|in:0,1'
            ]);

            //接收字段
            $fields = json_decode($request->getContent(), true);

            $content        = $fields['content'];
            $description    = $fields['description'];
            $image          = $fields['image'];
            $status         = $fields['status'];
            $title          = $fields['title'];
            $adminUserId = Auth::guard('admin')->id();
            //执行逻辑
            $post = Post::firstOrCreate(compact('content', 'description', 'image', 'status', 'title', 'adminUserId'));

        }catch (ValidationException $exception){

            return $this->json(0, '数据验证不通过', [], array_values($exception->errors())[0][0]);

        }catch (Exception $exception){

            return $this->json(0, '数据添加失败', [], $exception->getMessage());

        }

        //返回数据
        if($post->wasRecentlyCreated){

            return $this->json(1, '数据添加成功');

        }

        return $this->json(0, '数据添加失败');

    }

    /**
     * 上传图片
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request)
    {

        $result = $this->uploadImage($request);

        return $this->json($result['status'], $result['message'], ['url' => $result['url']]);

    }

}
