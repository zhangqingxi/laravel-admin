<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class CommonController extends Controller
{

    /**
     * @param Request $request
     * @return array
     */
    protected function uploadImage(Request $request)
    {

        if ($request->isMethod('POST')) {


            $file = $request->file('file');

            //判断文件是否上传成功
            if ($file->isValid()){

                $realPath = $file->getRealPath();

                $ext = $file->getClientOriginalExtension();

                if (!in_array($ext, config('filesystems.uploadImageExt'))) {

                    return ['status' => 0, 'message' => '上传的文件格式错误!'];

                }

                $filename = config('filesystems.imagePathFormat').md5($file->getFilename()).'.'.$ext;

                $bool = Storage::disk('public')->put($filename, file_get_contents($realPath));

                //判断是否上传成功
                if($bool){

                    return ['status' => 1, 'message' => '上传成功', 'url' => \Storage::url($filename)];

                }else{

                    return ['status' => 0, 'message' => '上传失败!'];

                }

            }

            return ['status' => 0, 'message' => '上传失败!'];


        }else{

            return ['status' => 0, 'message' => '非法请求!'];

        }

    }

}
