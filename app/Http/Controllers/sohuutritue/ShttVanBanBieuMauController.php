<?php

namespace App\Http\Controllers\sohuutritue;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\sohuutritue\Shttvanbanbieumau;
use App\Models\tintuc\Sukien;

use Illuminate\Support\Facades\Auth;
class ShttVanBanBieuMauController extends Controller
{
    //
    public function index()
    {
        $shttvanbanbieumau = Shttvanbanbieumau::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.shttvanbanbieumau.index', compact('shttvanbanbieumau'));
    }
    public function create()
    {
        return view('admin.shttvanbanbieumau.create');
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
    
        $shttvanbanbieumau = new Shttvanbanbieumau();
        $shttvanbanbieumau->title = $request->title;
        $shttvanbanbieumau->description = $request->description; 
        $shttvanbanbieumau->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $shttvanbanbieumau->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $shttvanbanbieumau->file = 'storage/file/' . $fileName;
        }
    
        $shttvanbanbieumau->save();
    
        return redirect()->route('admin.shttvanbanbieumau.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $shttvanbanbieumau = Shttvanbanbieumau::findOrFail($id);
        return view('admin.shttvanbanbieumau.edit', compact('shttvanbanbieumau'));
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

        $shttvanbanbieumau = Shttvanbanbieumau::findOrFail($id);
        $shttvanbanbieumau->title = $request->title;
        $shttvanbanbieumau->description = $request->description;
        $shttvanbanbieumau->content = $request->content;
        
                // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($shttvanbanbieumau->image && file_exists(public_path($shttvanbanbieumau->image))) {
                unlink(public_path($shttvanbanbieumau->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $shttvanbanbieumau->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($shttvanbanbieumau->file && file_exists(public_path($shttvanbanbieumau->file))) {
                unlink(public_path($shttvanbanbieumau->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $shttvanbanbieumau->file = 'storage/file/' . $fileName;
        }

        $shttvanbanbieumau->save();


        return redirect()->route('admin.shttvanbanbieumau.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $shttvanbanbieumau = Shttvanbanbieumau::findOrFail($id);

        if ($shttvanbanbieumau->image && file_exists(public_path($shttvanbanbieumau->image))) {
            unlink(public_path($shttvanbanbieumau->image));
        }

        if ($shttvanbanbieumau->file && file_exists(public_path($shttvanbanbieumau->file))) {
            unlink(public_path($shttvanbanbieumau->file));
        }

        $shttvanbanbieumau->delete();

        return redirect()->route('admin.shttvanbanbieumau.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = Shttvanbanbieumau::all();
        // Trả về view với dữ liệu
        return view('trang-chu.so-huu-tri-tue.shtt-van-ban-bieu-mau', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = Shttvanbanbieumau::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = Shttvanbanbieumau::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.so-huu-tri-tue.show-shttvanbanbieumau', compact('hoso','tin_moi_nhat')); 
    }
    
}
