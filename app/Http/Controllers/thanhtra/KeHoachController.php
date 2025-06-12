<?php   
namespace App\Http\Controllers\thanhtra;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\thanhtra\Kehoach; // Import model VanBanBieuMauModel



class KeHoachController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = Kehoach::all();
        // Trả về view với dữ liệu
        return view('trang-chu.thanh-tra.ke-hoach', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = Kehoach::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = Kehoach::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.thanh-tra.show-kehoach', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $nguyen = Kehoach::all(); // Lấy tất cả dữ liệu
        return view('admin.quytrinhquydinh.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.quytrinhquydinh.create');
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
    
        $quytrinhquydinh = new Kehoach();
        $quytrinhquydinh->title = $request->title;
        $quytrinhquydinh->description = $request->description;
        $quytrinhquydinh->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $quytrinhquydinh->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $quytrinhquydinh->file = 'storage/file/' . $fileName;
        }
    
        $quytrinhquydinh->save();
    
        return redirect()->route('admin.quytrinhquydinh.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $quytrinhquydinh = Kehoach::findOrFail($id);
        return view('admin.quytrinhquydinh.edit', compact('quytrinhquydinh'));
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

        $quytrinhquydinh = Kehoach::findOrFail($id);
        $quytrinhquydinh->title = $request->title;
        $quytrinhquydinh->description = $request->description;
        $quytrinhquydinh->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($quytrinhquydinh->image && file_exists(public_path($quytrinhquydinh->image))) {
                unlink(public_path($quytrinhquydinh->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $quytrinhquydinh->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($quytrinhquydinh->file && file_exists(public_path($quytrinhquydinh->file))) {
                unlink(public_path($quytrinhquydinh->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $quytrinhquydinh->file = 'storage/file/' . $fileName;
        }

        $quytrinhquydinh->save();


        return redirect()->route('admin.quytrinhquydinh.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $quytrinhquydinh = Kehoach::findOrFail($id);

        if ($quytrinhquydinh->image && file_exists(public_path($quytrinhquydinh->image))) {
            unlink(public_path($quytrinhquydinh->image));
        }

        if ($quytrinhquydinh->file && file_exists(public_path($quytrinhquydinh->file))) {
            unlink(public_path($quytrinhquydinh->file));
        }

        $quytrinhquydinh->delete();

        return redirect()->route('admin.quytrinhquydinh.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}