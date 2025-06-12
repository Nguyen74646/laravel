<?php

namespace App\Http\Controllers\tintuc;

use App\Http\Controllers\Controller;
use App\Models\tintuc\Sukien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class SukienController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $nguyen = Sukien::orderBy('created_at', 'desc')->get();
        return view('admin.sukien.index', compact('nguyen'));
    }


    
    // Hiển thị chi tiết
   /*public function detail($id)
    {
        $hoso = Sukien::findOrFail($id);
        $latestPosts = Sukien::orderBy('created_at', 'desc')->take(5)->get();

        return view('posts.detail', compact('hoso', 'latestPosts'));
    }*/ 

    // Hiển thị form tạo mới
    public function create()
    {
        return view('admin.sukien.create');
    }

    // Lưu dữ liệu mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:20480', // <- sửa 'required' thành 'nullable'
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);
    
        $hoso = new Sukien();
        $hoso->title = $request->title;
        $hoso->description = $request->description;
        $hoso->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $hoso->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $hoso->file = 'storage/file/' . $fileName;
        }
    
        $hoso->save();
    

        return back()->with('success','Hồ sơ đã được lưu thành công!');
    }
    

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $hoso = Sukien::findOrFail($id);
        return view('admin.sukien.edit', compact('hoso'));
    }

    // Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:5120', // 5MB
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB
        ]);

        $hoso = Sukien::findOrFail($id);
        $hoso->title = $request->title;
        $hoso->description = $request->description;
        $hoso->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($hoso->image && file_exists(public_path($hoso->image))) {
                unlink(public_path($hoso->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $hoso->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($hoso->file && file_exists(public_path($hoso->file))) {
                unlink(public_path($hoso->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $hoso->file = 'storage/file/' . $fileName;
        }

        $hoso->save();

        return redirect()->route('admin.sukien.index')->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    // Xóa dữ liệu
    public function destroy($id)
    {
        $hoso = Sukien::findOrFail($id);

        if ($hoso->image && file_exists(public_path($hoso->image))) {
            unlink(public_path($hoso->image));
        }

        if ($hoso->file && file_exists(public_path($hoso->file))) {
            unlink(public_path($hoso->file));
        }

        $hoso->delete();

        return redirect()->route('admin.sukien.index')->with('success', 'Hồ sơ sự kiện và các file liên quan đã được xóa thành công!');
    }
    // Hiển thị danh sách bài viết trên trang chủ
    public function showcard()
    {
        $hosos = Sukien::orderBy('created_at', 'desc')->get();
        return view('trang-chu.tin-tuc.su-kien', compact('hosos'));
    }
    // Hiển thị chi tiết bài viết

    public function show($id)
    {
        $hoso = Sukien::findOrFail($id); // Lấy thông tin chi tiết từ MongoDB

        $Hoso = Sukien::all();
    
        $all_news = collect()->merge($hoso)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        
        // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.tin-tuc.show-Sukien', compact('hoso','tin_moi_nhat')); // Đảm bảo trả về view 'pages.show'
    }
    // Tìm kiếm bài viết
    public function search(Request $request)
    {
        $query = $request->input('query');
        $hosos = Sukien::where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.sukien.index', compact('hosos'));
    }
}
