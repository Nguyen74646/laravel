<?php   
namespace App\Http\Controllers\vanbanquyphamphapluat;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\vanbanquyphamphapluat\VanBanSoHuuTriTue; // Import model vanbansohuutritueModel



class  VanBanSoHuuTriTueController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $thongbao = VanBanSoHuuTriTue::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-quy-pham-phap-luat.van-ban-so-huu-tri-tue', compact('thongbao'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = VanBanSoHuuTriTue::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = VanBanSoHuuTriTue::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-quy-pham-phap-luat.show-vanbansohuutritue', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $nguyen = VanBanSoHuuTriTue::all(); // Lấy tất cả dữ liệu
        return view('admin.vanbansohuutritue.index', compact('nguyen'));
    }
    public function create()
    {
        return view('admin.vanbansohuutritue.create');
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
    
        $vanbansohuutritue = new VanBanSoHuuTriTue();
        $vanbansohuutritue->title = $request->title;
        $vanbansohuutritue->description = $request->description;
        $vanbansohuutritue->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbansohuutritue->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbansohuutritue->file = 'storage/file/' . $fileName;
        }
    
        $vanbansohuutritue->save();
    
        return redirect()->route('admin.vanbansohuutritue.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $vanbansohuutritue = VanBanSoHuuTriTue::findOrFail($id);
        return view('admin.vanbansohuutritue.edit', compact('vanbansohuutritue'));
    }   
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|max:20480', // 5MB
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB
        ]);

        $vanbansohuutritue = VanBanSoHuuTriTue::findOrFail($id);
        $vanbansohuutritue->title = $request->title;
        $vanbansohuutritue->description = $request->description;
        $vanbansohuutritue->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($vanbansohuutritue->image && file_exists(public_path($vanbansohuutritue->image))) {
                unlink(public_path($vanbansohuutritue->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $vanbansohuutritue->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($vanbansohuutritue->file && file_exists(public_path($vanbansohuutritue->file))) {
                unlink(public_path($vanbansohuutritue->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $vanbansohuutritue->file = 'storage/file/' . $fileName;
        }

        $vanbansohuutritue->save();


        return redirect()->route('admin.vanbansohuutritue.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $vanbansohuutritue = VanBanSoHuuTriTue::findOrFail($id);

        if ($vanbansohuutritue->image && file_exists(public_path($vanbansohuutritue->image))) {
            unlink(public_path($vanbansohuutritue->image));
        }

        if ($vanbansohuutritue->file && file_exists(public_path($vanbansohuutritue->file))) {
            unlink(public_path($vanbansohuutritue->file));
        }

        $vanbansohuutritue->delete();

        return redirect()->route('admin.vanbansohuutritue.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}