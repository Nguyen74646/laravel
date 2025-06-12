<?php   
namespace App\Http\Controllers\vanbanquyphamphapluat;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\vanbanquyphamphapluat\VanBanThanhTra; // Import model VanBanBieuMauModel



class VanBanThanhTraController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = VanBanThanhTra::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-quy-pham-phap-luat.van-ban-thanh-tra', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = VanBanThanhTra::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = VanBanThanhTra::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-quy-pham-phap-luat.show-vanbanthanhtra', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $nguyen = VanBanThanhTra::all(); // Lấy tất cả dữ liệu
        return view('admin.vanbanthanhtra.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.vanbanthanhtra.create');
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
    
        $vanbanthanhtra = new VanBanThanhTra();
        $vanbanthanhtra->title = $request->title;
        $vanbanthanhtra->description = $request->description;
        $vanbanthanhtra->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbanthanhtra->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbanthanhtra->file = 'storage/file/' . $fileName;
        }
    
        $vanbanthanhtra->save();
    
        return redirect()->route('admin.vanbanthanhtra.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $vanbanthanhtra = VanBanThanhTra::findOrFail($id);
        return view('admin.vanbanthanhtra.edit', compact('vanbanthanhtra'));
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

        $vanbanthanhtra = VanBanThanhTra::findOrFail($id);
        $vanbanthanhtra->title = $request->title;
        $vanbanthanhtra->description = $request->description;
        $vanbanthanhtra->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($vanbanthanhtra->image && file_exists(public_path($vanbanthanhtra->image))) {
                unlink(public_path($vanbanthanhtra->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbanthanhtra->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($vanbanthanhtra->file && file_exists(public_path($vanbanthanhtra->file))) {
                unlink(public_path($vanbanthanhtra->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbanthanhtra->file = 'storage/file/' . $fileName;
        }

        $vanbanthanhtra->save();


        return redirect()->route('admin.vanbanthanhtra.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $vanbanthanhtra = VanBanThanhTra::findOrFail($id);

        if ($vanbanthanhtra->image && file_exists(public_path($vanbanthanhtra->image))) {
            unlink(public_path($vanbanthanhtra->image));
        }

        if ($vanbanthanhtra->file && file_exists(public_path($vanbanthanhtra->file))) {
            unlink(public_path($vanbanthanhtra->file));
        }

        $vanbanthanhtra->delete();

        return redirect()->route('admin.vanbanthanhtra.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}