<?php

namespace App\Http\Controllers\tintuc;

use App\Http\Controllers\Controller;
use App\Models\tintuc\Thongbao;
use App\Models\tintuc\Sukien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class ThongBaoController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $thongbao = Thongbao::orderBy('created_at', 'desc')->get();
        return view('admin.thongbao.index', compact('thongbao'));
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
        return view('admin.thongbao.create');
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
    
        $thongbao = new Thongbao();
        $thongbao->title = $request->title;
        $thongbao->description = $request->description;
        $thongbao->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $thongbao->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $thongbao->file = 'storage/file/' . $fileName;
        }
    
        $thongbao->save();
    
        return redirect()->route('admin.thongbao.index')->with('success', 'Hồ sơ đã được lưu thành công!');
    }
    

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $thongbao = Thongbao::findOrFail($id);
        return view('admin.thongbao.edit', compact('thongbao'));
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

        $thongbao = Thongbao::findOrFail($id);
        $thongbao->title = $request->title;
        $thongbao->description = $request->description;
        $thongbao->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($thongbao->image && file_exists(public_path($thongbao->image))) {
                unlink(public_path($thongbao->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $thongbao->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($thongbao->file && file_exists(public_path($thongbao->file))) {
                unlink(public_path($thongbao->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $thongbao->file = 'storage/file/' . $fileName;
        }

        $thongbao->save();

        return redirect()->route('admin.thongbao.index')->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    // Xóa dữ liệu
    public function destroy($id)
    {
        $thongbao = Thongbao::findOrFail($id);

        if ($thongbao->image && file_exists(public_path($thongbao->image))) {
            unlink(public_path($thongbao->image));
        }

        if ($thongbao->file && file_exists(public_path($thongbao->file))) {
            unlink(public_path($thongbao->file));
        }

        $thongbao->delete();

        return redirect()->route('admin.thongbao.index')->with('success', 'Hồ sơ sự kiện và các file liên quan đã được xóa thành công!');
    }
    // Hiển thị danh sách bài viết trên trang chủ
    public function showM()
    {
        $thongbao = Thongbao::orderBy('created_at', 'desc')->get();
        return view('trang-chu.tin-tuc.thong-bao', compact('thongbao'));
    }
    // Hiển thị chi tiết bài viết
    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = Thongbao::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = Thongbao::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.tin-tuc.show-thongbao', compact('hoso','tin_moi_nhat')); 
    }
    // Tìm kiếm bài viết
    public function search(Request $request)
    {
        $query = $request->input('query');
        $thongbao = Thongbao::where('title', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->orWhere('content', 'LIKE', "%$query%")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.thongbao.index', compact('thongbao'));
    }
}
