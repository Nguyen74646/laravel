<?php

namespace App\Http\Controllers\sohuutritue;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\sohuutritue\ShttQuyTrinhQuyDinh  ;
use App\Models\tintuc\Sukien;
use Illuminate\Support\Facades\Auth;
class ShttQuyTrinhQuyDinhController extends Controller
{
    //
    public function index()
    {
        $shttquytrinh = ShttQuyTrinhQuyDinh::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.shttquytrinh.index', compact('shttquytrinh'));
    }
    public function create()
    {
        return view('admin.shttquytrinh.create');
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
    
        $shttquytrinh = new ShttQuyTrinhQuyDinh();
        $shttquytrinh->title = $request->title;
        $shttquytrinh->description = $request->description;
        $shttquytrinh->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $shttquytrinh->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $shttquytrinh->file = 'storage/file/' . $fileName;
        }
    
        $shttquytrinh->save();
    
        return redirect()->route('admin.shttquytrinh.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $shttquytrinh = ShttQuyTrinhQuyDinh::findOrFail($id);
        return view('admin.shttquytrinh.edit', compact('shttquytrinh'));
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

        $shttquytrinh = ShttQuyTrinhQuyDinh::findOrFail($id);
        $shttquytrinh->title = $request->title;
        $shttquytrinh->description = $request->description;
        $shttquytrinh->content = $request->content;
                // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($shttquytrinh->image && file_exists(public_path($shttquytrinh->image))) {
                unlink(public_path($shttquytrinh->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $shttquytrinh->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($shttquytrinh->file && file_exists(public_path($shttquytrinh->file))) {
                unlink(public_path($shttquytrinh->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $shttquytrinh->file = 'storage/file/' . $fileName;
        }

        $shttquytrinh->save();

        return redirect()->route('admin.shttquytrinh.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $shttquytrinh = ShttQuyTrinhQuyDinh::findOrFail($id);

        if ($shttquytrinh->image && file_exists(public_path($shttquytrinh->image))) {
            unlink(public_path($shttquytrinh->image));
        }

        if ($shttquytrinh->file && file_exists(public_path($shttquytrinh->file))) {
            unlink(public_path($shttquytrinh->file));
        }

        $shttquytrinh->delete();

        return redirect()->route('admin.shttquytrinh.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = ShttQuyTrinhQuyDinh::all();
        // Trả về view với dữ liệu
        return view('trang-chu.so-huu-tri-tue.shtt-quy-trinh-quy-dinh', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = ShttQuyTrinhQuyDinh::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = ShttQuyTrinhQuyDinh::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.so-huu-tri-tue.show-shttquytrinh', compact('hoso','tin_moi_nhat')); 
    }
}
