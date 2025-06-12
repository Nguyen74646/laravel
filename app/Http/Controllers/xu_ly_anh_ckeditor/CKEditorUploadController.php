<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CKEditorUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            // Kiểm tra file hợp lệ (tùy chọn nhưng khuyến khích)
            $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Giới hạn 2MB
            ]);

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            // Tạo tên file duy nhất để tránh trùng lặp
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // Lưu file vào thư mục public/uploads/ckeditor_images/
            // Đảm bảo thư mục này tồn tại và có quyền ghi
            try {
                $request->file('upload')->move(public_path('uploads/ckeditor_images'), $fileNameToStore);
            } catch (\Exception $e) {
                Log::error('CKEditor Upload Error: ' . $e->getMessage());
                // Trả về lỗi cho CKEditor nếu không lưu được file
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $errorMessage = 'Không thể tải ảnh lên. Vui lòng thử lại. Lỗi: ' . $e->getMessage();
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', '$errorMessage');</script>";
                @header('Content-type: text/html; charset=utf-8');
                return $response;
            }


            $url = asset('uploads/ckeditor_images/' . $fileNameToStore);

            // CKEditor yêu cầu một định dạng phản hồi cụ thể
            // Cách phổ biến nhất là trả về một đoạn mã JavaScript gọi hàm callback
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $msg = 'Ảnh đã được tải lên thành công!';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg');</script>";

            @header('Content-type: text/html; charset=utf-8');
            return $response;

        } else {
            // Trường hợp không có file 'upload' được gửi đi
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $errorMessage = 'Không có file nào được chọn để tải lên.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '', '$errorMessage');</script>";
            @header('Content-type: text/html; charset=utf-8');
            return $response;
        }
    }
}