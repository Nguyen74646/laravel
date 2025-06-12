<?php

namespace App\Http\Controllers;

use App\Models\phapche\CongTacTuyenTruyenPhoBienPhapLuat;
use App\Models\thanhtra\Quytrinhquydinh;
use App\Models\tintuc\Sukien;
use App\Models\vanbanDHQG\DHQGVanBanKhac;
use App\Models\vanbanquyphamphapluat\VanBanSoHuuTriTue;
use Illuminate\Http\Request;
use MongoDB\BSON\Regex;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $regex = new Regex($query, 'i'); // Tìm kiếm không phân biệt hoa thường
            $results = collect(); // Khởi tạo collection trống để gộp kết quả

            // Tìm trong các model khác nhau
            $results = $results->merge(
                Sukien::where('title', $regex)
                    ->orWhere('description', $regex)
                    ->orWhere('content', $regex)
                    ->get()
            );

            $results = $results->merge(
                CongTacTuyenTruyenPhoBienPhapLuat::where('title', $regex)
                    ->orWhere('description', $regex)
                    ->orWhere('content', $regex)
                    ->get()
            );

            $results = $results->merge(
                DHQGVanBanKhac::where('title', $regex)
                    ->orWhere('description', $regex)
                    ->orWhere('content', $regex)
                    ->get()
            );

            $results = $results->merge(
                Quytrinhquydinh::where('title', $regex)
                    ->orWhere('description', $regex)
                    ->orWhere('content', $regex)
                    ->get()
            );

            $results = $results->merge(
                VanBanSoHuuTriTue::where('title', $regex)
                    ->orWhere('description', $regex)
                    ->orWhere('content', $regex)
                    ->get()
            );

        } else {
            $results = collect(); // Không có từ khóa thì trả về rỗng
        }

        return view('trang-chu.tim-kiem.ket-qua', compact('results', 'query'));
    }
}
