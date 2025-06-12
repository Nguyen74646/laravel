<?php

namespace App\Http\Controllers\sohuutritue;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\sohuutritue\ShttKeHoachCongVan;
use App\Models\tintuc\Sukien;
use Illuminate\Support\Facades\Auth;
class ShttKeHoachCongVanController extends Controller
{
    //
    public function index()
    {
        $shttkehoachcongvan = ShttKeHoachCongVan::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.shttkehoachcongvan.index', compact('shttkehoachcongvan'));
    }
    public function create()
    {
        return view('admin.shttkehoachcongvan.create');
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
    
        $shttkehoachcongvan = new ShttKeHoachCongVan();
        $shttkehoachcongvan->title = $request->title;
        $shttkehoachcongvan->description = $request->description;
        $shttkehoachcongvan->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $shttkehoachcongvan->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $shttkehoachcongvan->file = 'storage/file/' . $fileName;
        }
    
        $shttkehoachcongvan->save();
    
        return redirect()->route('admin.shttkehoachcongvan.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $shttkehoachcongvan = ShttKeHoachCongVan::findOrFail($id);
        return view('admin.shttkehoachcongvan.edit', compact('shttkehoachcongvan'));
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

        $shttkehoachcongvan = ShttKeHoachCongVan::findOrFail($id);
        $shttkehoachcongvan->title = $request->title;
        $shttkehoachcongvan->description = $request->description;
        $shttkehoachcongvan->content = $request->content;
                // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($shttkehoachcongvan->image && file_exists(public_path($shttkehoachcongvan->image))) {
                unlink(public_path($shttkehoachcongvan->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $shttkehoachcongvan->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($shttkehoachcongvan->file && file_exists(public_path($shttkehoachcongvan->file))) {
                unlink(public_path($shttkehoachcongvan->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $shttkehoachcongvan->file = 'storage/file/' . $fileName;
        }

        $shttkehoachcongvan->save();


        return redirect()->route('admin.shttkehoachcongvan.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $shttkehoachcongvan = ShttKeHoachCongVan::findOrFail($id);

        if ($shttkehoachcongvan->image && file_exists(public_path($shttkehoachcongvan->image))) {
            unlink(public_path($shttkehoachcongvan->image));
        }

        if ($shttkehoachcongvan->file && file_exists(public_path($shttkehoachcongvan->file))) {
            unlink(public_path($shttkehoachcongvan->file));
        }

        $shttkehoachcongvan->delete();

        return redirect()->route('admin.shttkehoachcongvan.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = ShttKeHoachCongVan::all();
        // Trả về view với dữ liệu
        return view('trang-chu.so-huu-tri-tue.shtt-ke-hoach-cong-van', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = ShttKeHoachCongVan::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = ShttKeHoachCongVan::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.so-huu-tri-tue.show-shttkehoachcongvan', compact('hoso','tin_moi_nhat')); 
    }
}
