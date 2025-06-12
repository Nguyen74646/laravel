<?php

namespace App\Http\Controllers\phapche;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\phapche\CongTacPhapChe;
use App\Models\tintuc\Sukien;
use Illuminate\Support\Facades\Auth;
class CongTacPhapCheController extends Controller
{
    //
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $congtacphapche = CongTacPhapChe::all();
        // Trả về view với dữ liệu
        return view('trang-chu.phap-che.cong-tac-phap-che', compact('congtacphapche'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = CongTacPhapChe::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = CongTacPhapChe::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.phap-che.show-congtacphapche', compact('hoso','tin_moi_nhat')); 
    }   
     public function index()
    {
        $nguyen = CongTacPhapChe::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.congtacphapche.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.congtacphapche.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:20480', // <- sửa 'required' thành 'nullable'
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);
    
        $congtacphapche = new CongTacPhapChe();
        $congtacphapche->title = $request->title;
        $congtacphapche->description = $request->description;
        $congtacphapche->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $congtacphapche->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $congtacphapche->file = 'storage/file/' . $fileName;
        }
    
        $congtacphapche->save();
    
        return redirect()->route('admin.congtacphapche.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $congtacphapche = CongTacPhapChe::findOrFail($id);
        return view('admin.congtacphapche.edit', compact('congtacphapche'));
    }   
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120', // 5MB
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB
        ]);

        $congtacphapche = CongTacPhapChe::findOrFail($id);
        $congtacphapche->title = $request->title;
        $congtacphapche->description = $request->description;
        $congtacphapche->content = $request->content;
                // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($congtacphapche->image && file_exists(public_path($congtacphapche->image))) {
                unlink(public_path($congtacphapche->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $congtacphapche->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($congtacphapche->file && file_exists(public_path($congtacphapche->file))) {
                unlink(public_path($congtacphapche->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $congtacphapche->file = 'storage/file/' . $fileName;
        }

        $congtacphapche->save();


        return redirect()->route('admin.congtacphapche.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $congtacphapche = CongTacPhapChe::findOrFail($id);

        if ($congtacphapche->image && file_exists(public_path($congtacphapche->image))) {
            unlink(public_path($congtacphapche->image));
        }

        if ($congtacphapche->file && file_exists(public_path($congtacphapche->file))) {
            unlink(public_path($congtacphapche->file));
        }

        $congtacphapche->delete();

        return redirect()->route('admin.congtacphapche.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    ////////////////////////////////////////////////////////
    
}
