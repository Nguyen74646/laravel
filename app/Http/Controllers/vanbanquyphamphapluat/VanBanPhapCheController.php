<?php   
namespace App\Http\Controllers\vanbanquyphamphapluat; // Đường dẫn namespace của controller

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\vanbanquyphamphapluat\VanBanPhapChe; // Import model vanbanphapcheModel



class VanBanPhapCheController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $thongbao = VanBanPhapChe::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-quy-pham-phap-luat.van-ban-phap-che', compact('thongbao'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = VanBanPhapChe::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = VanBanPhapChe::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-quy-pham-phap-luat.show-vanbanphapche', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $nguyen = VanBanPhapChe::all(); // Lấy tất cả dữ liệu
        return view('admin.vanbanphapche.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.vanbanphapche.create');
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
    
        $vanbanphapche = new VanBanPhapChe();
        $vanbanphapche->title = $request->title;
        $vanbanphapche->description = $request->description;
        $vanbanphapche->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbanphapche->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbanphapche->file = 'storage/file/' . $fileName;
        }
    
        $vanbanphapche->save();
    
        return redirect()->route('admin.vanbanphapche.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $vanbanphapche = VanBanPhapChe::findOrFail($id);
        return view('admin.vanbanphapche.edit', compact('vanbanphapche'));
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

        $vanbanphapche = VanBanPhapChe::findOrFail($id);
        $vanbanphapche->title = $request->title;
        $vanbanphapche->description = $request->description;
        $vanbanphapche->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($vanbanphapche->image && file_exists(public_path($vanbanphapche->image))) {
                unlink(public_path($vanbanphapche->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbanphapche->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($vanbanphapche->file && file_exists(public_path($vanbanphapche->file))) {
                unlink(public_path($vanbanphapche->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbanphapche->file = 'storage/file/' . $fileName;
        }

        $vanbanphapche->save();


        return redirect()->route('admin.vanbanphapche.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $vanbanphapche = VanBanPhapChe::findOrFail($id);

        if ($vanbanphapche->image && file_exists(public_path($vanbanphapche->image))) {
            unlink(public_path($vanbanphapche->image));
        }

        if ($vanbanphapche->file && file_exists(public_path($vanbanphapche->file))) {
            unlink(public_path($vanbanphapche->file));
        }

        $vanbanphapche->delete();

        return redirect()->route('admin.vanbanphapche.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}