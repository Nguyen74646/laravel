<?php   
namespace App\Http\Controllers\thanhtra;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\thanhtra\VanBanBieuMauModel; // Import model VanBanBieuMauModel



class VanBanBieuMauController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = VanBanBieuMauModel::all();
        // Trả về view với dữ liệu
        return view('trang-chu.thanh-tra.van-ban-bieu-mau', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = VanBanBieuMauModel::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = VanBanBieuMauModel::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.thanh-tra.show-bieumau', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $nguyen = VanBanBieuMauModel::all(); // Lấy tất cả dữ liệu
        return view('admin.vanbanbieumau.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.vanbanbieumau.create');
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
    
        $vanbanbieumau = new VanBanBieuMauModel();
        $vanbanbieumau->title = $request->title;
        $vanbanbieumau->description = $request->description;
        $vanbanbieumau->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbanbieumau->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbanbieumau->file = 'storage/file/' . $fileName;
        }
    
        $vanbanbieumau->save();
    
        return redirect()->route('admin.vanbanbieumau.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $vanbanbieumau = VanBanBieuMauModel::findOrFail($id);
        return view('admin.vanbanbieumau.edit', compact('vanbanbieumau'));
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

        $vanbanbieumau = VanBanBieuMauModel::findOrFail($id);
        $vanbanbieumau->title = $request->title;
        $vanbanbieumau->description = $request->description;
        $vanbanbieumau->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($vanbanbieumau->image && file_exists(public_path($vanbanbieumau->image))) {
                unlink(public_path($vanbanbieumau->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbanbieumau->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($vanbanbieumau->file && file_exists(public_path($vanbanbieumau->file))) {
                unlink(public_path($vanbanbieumau->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbanbieumau->file = 'storage/file/' . $fileName;
        }

        $vanbanbieumau->save();


        return redirect()->route('admin.vanbanbieumau.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $vanbanbieumau = VanBanBieuMauModel::findOrFail($id);

        if ($vanbanbieumau->image && file_exists(public_path($vanbanbieumau->image))) {
            unlink(public_path($vanbanbieumau->image));
        }

        if ($vanbanbieumau->file && file_exists(public_path($vanbanbieumau->file))) {
            unlink(public_path($vanbanbieumau->file));
        }

        $vanbanbieumau->delete();

        return redirect()->route('admin.vanbanbieumau.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}