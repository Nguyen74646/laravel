<?php

namespace App\Http\Controllers\phapche;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\phapche\CongTacTuyenTruyenPhoBienPhapLuat;
use App\Models\tintuc\Sukien;

use Illuminate\Support\Facades\Auth;
class CongTacTuyentruyenController extends Controller
{
    //
    public function index()
    {
        $nguyen = CongTacTuyenTruyenPhoBienPhapLuat::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.congtactuyentruyenphobienphapluat.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.congtactuyentruyenphobienphapluat.create');
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
    
        $congtactuyentruyenphobienphapluat = new CongTacTuyenTruyenPhoBienPhapLuat();
        $congtactuyentruyenphobienphapluat->title = $request->title;
        $congtactuyentruyenphobienphapluat->description = $request->description;
        $congtactuyentruyenphobienphapluat->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $congtactuyentruyenphobienphapluat->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $congtactuyentruyenphobienphapluat->file = 'storage/file/' . $fileName;
        }
    
        $congtactuyentruyenphobienphapluat->save();
    
        return redirect()->route('admin.congtactuyentruyenphobienphapluat.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $congtactuyentruyenphobienphapluat = CongTacTuyenTruyenPhoBienPhapLuat::findOrFail($id);
        return view('admin.congtactuyentruyenphobienphapluat.edit', compact('congtactuyentruyenphobienphapluat'));
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

        $congtactuyentruyenphobienphapluat = CongTacTuyenTruyenPhoBienPhapLuat::findOrFail($id);
        $congtactuyentruyenphobienphapluat->title = $request->title;
        $congtactuyentruyenphobienphapluat->description = $request->description;
        $congtactuyentruyenphobienphapluat->content = $request->content;
                // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($congtactuyentruyenphobienphapluat->image && file_exists(public_path($congtactuyentruyenphobienphapluat->image))) {
                unlink(public_path($congtactuyentruyenphobienphapluat->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $congtactuyentruyenphobienphapluat->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($congtactuyentruyenphobienphapluat->file && file_exists(public_path($congtactuyentruyenphobienphapluat->file))) {
                unlink(public_path($congtactuyentruyenphobienphapluat->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $congtactuyentruyenphobienphapluat->file = 'storage/file/' . $fileName;
        }

        $congtactuyentruyenphobienphapluat->save();


        return redirect()->route('admin.congtactuyentruyenphobienphapluat.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $congtactuyentruyenphobienphapluat = CongTacTuyenTruyenPhoBienPhapLuat::findOrFail($id);

        if ($congtactuyentruyenphobienphapluat->image && file_exists(public_path($congtactuyentruyenphobienphapluat->image))) {
            unlink(public_path($congtactuyentruyenphobienphapluat->image));
        }

        if ($congtactuyentruyenphobienphapluat->file && file_exists(public_path($congtactuyentruyenphobienphapluat->file))) {
            unlink(public_path($congtactuyentruyenphobienphapluat->file));
        }

        $congtactuyentruyenphobienphapluat->delete();

        return redirect()->route('admin.congtactuyentruyenphobienphapluat.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $congtactuyentruyenphobienphapluat = CongTacTuyenTruyenPhoBienPhapLuat::all();
        // Trả về view với dữ liệu
        return view('trang-chu.phap-che.cong-tac-tuyen-truyen-pho-bien-phap-luat', compact('congtactuyentruyenphobienphapluat'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = CongTacTuyenTruyenPhoBienPhapLuat::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = CongTacTuyenTruyenPhoBienPhapLuat::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.phap-che.show-congtactuyentruyenphobienphapluat', compact('hoso','tin_moi_nhat')); 
    }
}
