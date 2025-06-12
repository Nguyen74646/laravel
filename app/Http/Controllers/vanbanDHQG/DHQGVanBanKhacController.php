<?php   
namespace App\Http\Controllers\vanbanDHQG;

use App\Http\Controllers\Controller;
use App\Models\vanbanDHQG\DHQGvanbankhac;
use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;


class DHQGvanbankhacController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $thongbao = DHQGvanbankhac::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-dhqg.dhqg-van-ban-khac', compact('thongbao'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = DHQGvanbankhac::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = DHQGvanbankhac::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-dhqg.show-dhqgvanbankhac', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $dhqgvanbankhac = DHQGvanbankhac::all(); // Lấy tất cả dữ         // Trả về view với dữ liệu
        return view('admin.dhqgvanbankhac.index', compact('dhqgvanbankhac'));
    }
    public function create()
    {
        return view('admin.dhqgvanbankhac.create');
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
    
        $dhqgvanbankhac = new DHQGvanbankhac();
        $dhqgvanbankhac->title = $request->title;
        $dhqgvanbankhac->description = $request->description;
        $dhqgvanbankhac->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbankhac->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbankhac->file = 'storage/file/' . $fileName;
        }
    
        $dhqgvanbankhac->save();
    
        return redirect()->route('admin.dhqgvanbankhac.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $dhqgvanbankhac = DHQGvanbankhac::findOrFail($id);
        return view('admin.dhqgvanbankhac.edit', compact('dhqgvanbankhac'));
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

        $dhqgvanbankhac = DHQGvanbankhac::findOrFail($id);
        $dhqgvanbankhac->title = $request->title;
        $dhqgvanbankhac->description = $request->description;
        $dhqgvanbankhac->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($dhqgvanbankhac->image && file_exists(public_path($dhqgvanbankhac->image))) {
                unlink(public_path($dhqgvanbankhac->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbankhac->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($dhqgvanbankhac->file && file_exists(public_path($dhqgvanbankhac->file))) {
                unlink(public_path($dhqgvanbankhac->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbankhac->file = 'storage/file/' . $fileName;
        }

        $dhqgvanbankhac->save();


        return redirect()->route('admin.dhqgvanbankhac.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $dhqgvanbankhac = DHQGvanbankhac::findOrFail($id);

        if ($dhqgvanbankhac->image && file_exists(public_path($dhqgvanbankhac->image))) {
            unlink(public_path($dhqgvanbankhac->image));
        }

        if ($dhqgvanbankhac->file && file_exists(public_path($dhqgvanbankhac->file))) {
            unlink(public_path($dhqgvanbankhac->file));
        }

        $dhqgvanbankhac->delete();

        return redirect()->route('admin.dhqgvanbankhac.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}