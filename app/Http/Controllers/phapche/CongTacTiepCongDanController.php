<?php

namespace App\Http\Controllers\phapche;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\phapche\CongTacTiepCongDan;
use App\Models\tintuc\Sukien;
use Illuminate\Support\Facades\Auth;
class CongTacTiepCongDanController extends Controller
{
    //
    public function index()
    {
        $nguyen = CongTacTiepCongDan::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.congtactiepcongdan.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.congtactiepcongdan.create');
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
    
        $congtactiepcongdan = new CongTacTiepCongDan();
        $congtactiepcongdan->title = $request->title;
        $congtactiepcongdan->description = $request->description;
        $congtactiepcongdan->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $congtactiepcongdan->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $congtactiepcongdan->file = 'storage/file/' . $fileName;
        }
    
        $congtactiepcongdan->save();
    
        return redirect()->route('admin.congtactiepcongdan.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $congtactiepcongdan = CongTacTiepCongDan::findOrFail($id);
        return view('admin.congtactiepcongdan.edit', compact('congtactiepcongdan'));
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

        $congtactiepcongdan = CongTacTiepCongDan::findOrFail($id);
        $congtactiepcongdan->title = $request->title;
        $congtactiepcongdan->description = $request->description;
        $congtactiepcongdan->content = $request->content;
                // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($congtactiepcongdan->image && file_exists(public_path($congtactiepcongdan->image))) {
                unlink(public_path($congtactiepcongdan->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $congtactiepcongdan->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($congtactiepcongdan->file && file_exists(public_path($congtactiepcongdan->file))) {
                unlink(public_path($congtactiepcongdan->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $congtactiepcongdan->file = 'storage/file/' . $fileName;
        }

        $congtactiepcongdan->save();


        return redirect()->route('admin.congtactiepcongdan.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $CongTacTiepCongDan = CongTacTiepCongDan::findOrFail($id);

        if ($CongTacTiepCongDan->image && file_exists(public_path($CongTacTiepCongDan->image))) {
            unlink(public_path($CongTacTiepCongDan->image));
        }

        if ($CongTacTiepCongDan->file && file_exists(public_path($CongTacTiepCongDan->file))) {
            unlink(public_path($CongTacTiepCongDan->file));
        }

        $CongTacTiepCongDan->delete();

        return redirect()->route('admin.congtactiepcongdan.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }

    // hàm trang chủ hiển htij 
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = CongTacTiepCongDan::all();
        // Trả về view với dữ liệu
        return view('trang-chu.phap-che.cong-tac-tiep-cong-dan', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = CongTacTiepCongDan::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = CongTacTiepCongDan::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.phap-che.show-congtactiepcongdan', compact('hoso','tin_moi_nhat')); 
    }
    
}
