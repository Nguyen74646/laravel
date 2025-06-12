<?php   
namespace App\Http\Controllers\vanbanDHQG;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\vanbanDHQG\DHQGvanbanthanhtra; // Import model VanBanBieuMauModel



class DHQGvanbanthanhtraController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $nguyen = DHQGvanbanthanhtra::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-dhqg.dhqg-van-ban-thanh-tra', compact('nguyen'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = DHQGvanbanthanhtra::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = DHQGvanbanthanhtra::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-dhqg.dhqg-van-ban-thanh-tra', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $dhqgvanbanthanhtra = DHQGvanbanthanhtra::all(); // Lấy tất cả dữ liệu
        return view('admin.dhqgvanbanthanhtra.index', compact('dhqgvanbanthanhtra'));
    }
    public function create()
    {
        return view('admin.dhqgvanbanthanhtra.create');
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
    
        $dhqgvanbanthanhtra = new DHQGvanbanthanhtra();
        $dhqgvanbanthanhtra->title = $request->title;
        $dhqgvanbanthanhtra->description = $request->description;
        $dhqgvanbanthanhtra->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbanthanhtra->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbanthanhtra->file = 'storage/file/' . $fileName;
        }
    
        $dhqgvanbanthanhtra->save();
    
        return redirect()->route('admin.dhqgvanbanthanhtra.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $dhqgvanbanthanhtra = DHQGvanbanthanhtra::findOrFail($id);
        return view('admin.dhqgvanbanthanhtra.edit', compact('dhqgvanbanthanhtra'));
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

        $dhqgvanbanthanhtra = DHQGvanbanthanhtra::findOrFail($id);
        $dhqgvanbanthanhtra->title = $request->title;
        $dhqgvanbanthanhtra->description = $request->description;
        $dhqgvanbanthanhtra->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($dhqgvanbanthanhtra->image && file_exists(public_path($dhqgvanbanthanhtra->image))) {
                unlink(public_path($dhqgvanbanthanhtra->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbanthanhtra->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($dhqgvanbanthanhtra->file && file_exists(public_path($dhqgvanbanthanhtra->file))) {
                unlink(public_path($dhqgvanbanthanhtra->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbanthanhtra->file = 'storage/file/' . $fileName;
        }

        $dhqgvanbanthanhtra->save();


        return redirect()->route('admin.dhqgvanbanthanhtra.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $dhqgvanbanthanhtra = DHQGvanbanthanhtra::findOrFail($id);

        if ($dhqgvanbanthanhtra->image && file_exists(public_path($dhqgvanbanthanhtra->image))) {
            unlink(public_path($dhqgvanbanthanhtra->image));
        }

        if ($dhqgvanbanthanhtra->file && file_exists(public_path($dhqgvanbanthanhtra->file))) {
            unlink(public_path($dhqgvanbanthanhtra->file));
        }

        $dhqgvanbanthanhtra->delete();

        return redirect()->route('admin.dhqgvanbanthanhtra.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}