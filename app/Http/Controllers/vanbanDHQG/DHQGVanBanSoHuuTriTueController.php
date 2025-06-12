<?php   
namespace App\Http\Controllers\vanbanDHQG;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\tintuc\Sukien;
use App\Models\vanbanDHQG\DHQGvanbansohuutritue; // Import model dhqgvanbansohuutritueModel



class  DHQGvanbansohuutritueController extends Controller
{
    public function showM()
    {
        // Lấy tất cả dữ liệu từ MongoDB collection
        $thongbao = DHQGvanbansohuutritue::all();
        // Trả về view với dữ liệu
        return view('trang-chu.van-ban-dhqg.dhqg-van-ban-so-huu-tri-tue', compact('thongbao'));
    }

    public function show($id)
    {
        // Lấy thông tin chi tiết từ MongoDB
        $hoso = DHQGvanbansohuutritue::findOrFail($id);

        $Hoso = Sukien::all();
        $Quytrinh = DHQGvanbansohuutritue::all();

        $all_news = collect()->merge($Quytrinh)->merge($Hoso);

        $all_news = $all_news->filter(function ($all_news) {
            return isset($all_news->created_at);
        }); 

        $tin_moi_nhat = $all_news->sortByDesc('created_at')->take(5);
        

         // Trả về view chi tiết từ thư mục chitiet_detail
        return view('trang-chu.van-ban-dhqg.show-dhqgvanbansohuutritue', compact('hoso','tin_moi_nhat')); 
    }
    public function index()
    {
        $dhqgvanbansohuutritue = DHQGvanbansohuutritue::all(); // Lấy tất cả dữ liệu
        return view('admin.dhqgvanbansohuutritue.index', compact('dhqgvanbansohuutritue'));
    }
    public function create()
    {
        return view('admin.dhqgvanbansohuutritue.create');
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
    
        $dhqgvanbansohuutritue = new DHQGvanbansohuutritue();
        $dhqgvanbansohuutritue->title = $request->title;
        $dhqgvanbansohuutritue->description = $request->description;
        $dhqgvanbansohuutritue->content = $request->content;
    
        // Upload hình ảnh (nếu có)
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbansohuutritue->image = 'storage/image/' . $imageName;
        }
    
        // Upload file đính kèm (nếu có)
        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbansohuutritue->file = 'storage/file/' . $fileName;
        }
    
        $dhqgvanbansohuutritue->save();
    
        return redirect()->route('admin.dhqgvanbansohuutritue.index')->with('success', 'Quy trình - Quy định đã được tạo thành công!');
    }
    public function edit($id)
    {
        $dhqgvanbansohuutritue = DHQGvanbansohuutritue::findOrFail($id);
        return view('admin.dhqgvanbansohuutritue.edit', compact('dhqgvanbansohuutritue'));
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

        $dhqgvanbansohuutritue = DHQGvanbansohuutritue::findOrFail($id);
        $dhqgvanbansohuutritue->title = $request->title;
        $dhqgvanbansohuutritue->description = $request->description;
        $dhqgvanbansohuutritue->content = $request->content;

        // Cập nhật hình ảnh nếu có
        if ($request->hasFile('image')) {
            if ($dhqgvanbansohuutritue->image && file_exists(public_path($dhqgvanbansohuutritue->image))) {
                unlink(public_path($dhqgvanbansohuutritue->image));
            }
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/image'), $imageName);
            $dhqgvanbansohuutritue->image = 'storage/image/' . $imageName;
        }

        // Cập nhật file đính kèm nếu có
        if ($request->hasFile('file')) {
            if ($dhqgvanbansohuutritue->file && file_exists(public_path($dhqgvanbansohuutritue->file))) {
                unlink(public_path($dhqgvanbansohuutritue->file));
            }
            $fileName = time().'_'.$request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('storage/file'), $fileName);
            $dhqgvanbansohuutritue->file = 'storage/file/' . $fileName;
        }

        $dhqgvanbansohuutritue->save();


        return redirect()->route('admin.dhqgvanbansohuutritue.index')->with('success', 'Quy trình - Quy định đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        $dhqgvanbansohuutritue = DHQGvanbansohuutritue::findOrFail($id);

        if ($dhqgvanbansohuutritue->image && file_exists(public_path($dhqgvanbansohuutritue->image))) {
            unlink(public_path($dhqgvanbansohuutritue->image));
        }

        if ($dhqgvanbansohuutritue->file && file_exists(public_path($dhqgvanbansohuutritue->file))) {
            unlink(public_path($dhqgvanbansohuutritue->file));
        }

        $dhqgvanbansohuutritue->delete();

        return redirect()->route('admin.dhqgvanbansohuutritue.index')->with('success', 'Quy trình - Quy định đã được xóa thành công!');
    }
    
    
}