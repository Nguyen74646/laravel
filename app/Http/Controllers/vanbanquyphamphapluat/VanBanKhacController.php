<?php   
namespace App\Http\Controllers\vanbanquyphamphapluat;

use App\Http\Controllers\Controller;
use App\Models\vanbanquyphamphapluat\VanBanKhac;
use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;


class VanBanKhacController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $thongbao = VanBanKhac::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-quy-pham-phap-luat.van-ban-khac', compact('thongbao'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = VanBanKhac::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = VanBanKhac::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-quy-pham-phap-luat.show-vanbankhac', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $nguyen = VanBanKhac::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.vanbankhac.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.vanbankhac.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:20480', // <- sửa 'required' thành 'nullable'
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:20480',
        ]);
    
        $vanbankhac = new VanBanKhac();
        $vanbankhac->title = $request->title;
        $vanbankhac->description = $request->description;
        $vanbankhac->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbankhac->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbankhac->file = 'storage/file/' . $fileName;
        }
    
        $vanbankhac->save();
    
        return redirect()->route('admin.vanbankhac.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $vanbankhac = VanBanKhac::findOrFail($id);
        return view('admin.vanbankhac.edit', compact('vanbankhac'));
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

        $vanbankhac = VanBanKhac::findOrFail($id);
        $vanbankhac->title = $request->title;
        $vanbankhac->description = $request->description;
        $vanbankhac->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($vanbankhac->image && file_exists(public_path($vanbankhac->image))) {
                unlink(public_path($vanbankhac->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbankhac->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($vanbankhac->file && file_exists(public_path($vanbankhac->file))) {
                unlink(public_path($vanbankhac->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbankhac->file = 'storage/file/' . $fileName;
        }

        $vanbankhac->save();


        return redirect()->route('admin.vanbankhac.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $vanbankhac = VanBanKhac::findOrFail($id);

        if ($vanbankhac->image && file_exists(public_path($vanbankhac->image))) {
            unlink(public_path($vanbankhac->image));
        }

        if ($vanbankhac->file && file_exists(public_path($vanbankhac->file))) {
            unlink(public_path($vanbankhac->file));
        }

        $vanbankhac->delete();

        return redirect()->route('admin.vanbankhac.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}