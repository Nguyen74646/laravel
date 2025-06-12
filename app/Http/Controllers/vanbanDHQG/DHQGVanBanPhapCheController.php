<?php   
namespace App\Http\Controllers\vanbanDHQG; // Đường dẫn namespace của controller

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\vanbanDHQG\DHQGvanbanphapche; // Import model dhqgvanbanphapcheModel



class DHQGvanbanphapcheController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $thongbao = DHQGvanbanphapche::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-dhqg.dhqg-van-ban-phap-che', compact('thongbao'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = DHQGvanbanphapche::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = DHQGvanbanphapche::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-dhqg.show-dhqgvanbanphapche', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $dhqgvanbanphapche = DHQGvanbanphapche::all(); // Lấy tất cả dữ liệu
        return view('admin.dhqgvanbanphapche.index', compact('dhqgvanbanphapche'));
    }
    public function create()
    {
        return view('admin.dhqgvanbanphapche.create');
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
    
        $dhqgvanbanphapche = new DHQGvanbanphapche();
        $dhqgvanbanphapche->title = $request->title;
        $dhqgvanbanphapche->description = $request->description;
        $dhqgvanbanphapche->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbanphapche->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbanphapche->file = 'storage/file/' . $fileName;
        }
    
        $dhqgvanbanphapche->save();
    
        return redirect()->route('admin.dhqgvanbanphapche.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $dhqgvanbanphapche = DHQGvanbanphapche::findOrFail($id);
        return view('admin.dhqgvanbanphapche.edit', compact('dhqgvanbanphapche'));
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

        $dhqgvanbanphapche = DHQGvanbanphapche::findOrFail($id);
        $dhqgvanbanphapche->title = $request->title;
        $dhqgvanbanphapche->description = $request->description;
        $dhqgvanbanphapche->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($dhqgvanbanphapche->image && file_exists(public_path($dhqgvanbanphapche->image))) {
                unlink(public_path($dhqgvanbanphapche->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbanphapche->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($dhqgvanbanphapche->file && file_exists(public_path($dhqgvanbanphapche->file))) {
                unlink(public_path($dhqgvanbanphapche->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbanphapche->file = 'storage/file/' . $fileName;
        }

        $dhqgvanbanphapche->save();


        return redirect()->route('admin.dhqgvanbanphapche.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $dhqgvanbanphapche = DHQGvanbanphapche::findOrFail($id);

        if ($dhqgvanbanphapche->image && file_exists(public_path($dhqgvanbanphapche->image))) {
            unlink(public_path($dhqgvanbanphapche->image));
        }

        if ($dhqgvanbanphapche->file && file_exists(public_path($dhqgvanbanphapche->file))) {
            unlink(public_path($dhqgvanbanphapche->file));
        }

        $dhqgvanbanphapche->delete();

        return redirect()->route('admin.dhqgvanbanphapche.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}