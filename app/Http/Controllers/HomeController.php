<?php

namespace App\Http\Controllers;

use App\Models\phapche\CongTacPhapChe;
use App\Models\phapche\CongTacTiepCongDan;
use App\Models\phapche\CongTacTuyenTruyenPhoBienPhapLuat;
use App\Models\vanbanDHQG\DHQGVanBanKhac;
use App\Models\vanbanquyphamphapluat\VanBanKhac;
use App\Models\vanbanquyphamphapluat\VanBanPhapChe;
use App\Models\vanbanquyphamphapluat\VanBanSoHuuTriTue;
use Illuminate\Http\Request;
Use App\Models\tintuc\Sukien;
use App\Models\thanhtra\VanBanBieuMauModel;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $tin_moi_nhat = Sukien::orderBy('created_at', 'desc')->paginate(3);
        $tin_moi_nhat = CongTacPhapChe::orderBy('created_at', 'desc')->paginate(3);
        $tin_moi_nhat = CongTacTiepCongDan::orderBy('created_at', 'desc')->paginate(3);
        $tin_moi_nhat = CongTacTuyenTruyenPhoBienPhapLuat::orderBy('created_at', 'desc')->paginate(3);
        $tin_moi_nhat = Sukien::orderBy('created_at', 'desc')->paginate(3);
        $van_ban_moi = VanBanBieuMauModel::orderBy('created_at', 'desc')->paginate(3); // bạn cần thêm model này
        $van_ban_moi = VanBanKhac::orderBy('created_at', 'desc')->paginate(3); // bạn cần thêm model này
        $van_ban_moi = VanBanSoHuuTriTue::orderBy('created_at', 'desc')->paginate(3); // bạn cần thêm model này
        $van_ban_moi = VanBanPhapChe::orderBy('created_at', 'desc')->paginate(3); // bạn cần thêm model này
        $van_ban_moi = DHQGVanBanKhac::orderBy('created_at', 'desc')->paginate(3); // bạn cần thêm model này
        if ($request->ajax()) {
            $type = $request->get('type');
        
            if ($type == 'tin') {
                $tin_moi_nhat = Sukien::orderBy('created_at', 'desc')->paginate(3);
                return view('trang-chu.layout.tin_moi_nhat', compact('tin_moi_nhat'))->render();
            } elseif ($type == 'vanban') {
                $van_ban_moi = VanBanBieuMauModel::orderBy('created_at', 'desc')->paginate(3);
                return view('trang-chu.layout.van-ban-moi', compact('van_ban_moi'))->render();
            }
        }
        
    
        return view('hello', compact('tin_moi_nhat', 'van_ban_moi'));
    }
    

    public function pages($group, $page)
    {
        
        $validGroups = [
            'gioi-thieu' => [
                'chuc-nang-nhiem-vu',
                'co-cau-to-chuc',
            ],
            'tin-tuc' => [
                'su-kien',
                'thong-bao',
            ],
            'thanh-tra' => [
                'quy-trinh-quy-dinh',
                'van-ban-bieu-mau',
                'ke-hoach',
            ],
            'phap-che' => [
                'cong-tac-phap-che',
                'cong-tac-tiep-cong-dan',
                'cong-tac-tuyen-truyen-pho-bien-phap-luat',
            ],
            'so-huu-tri-tue' => [
                'shtt-quy-trinh-quy-dinh',
                'shtt-van-ban-bieu-mau',
                'shtt-ke-hoach-cong-van',
            ],
            'van-ban-quy-pham-phap-luat' => [
                'van-ban-thanh-tra',
                'van-ban-phap-che',
                'van-ban-so-huu-tri-tue',
                'van-ban-khac',
            ],
            'van-ban-dhqg' => [
                'dhqg-van-ban-thanh-tra',
                'dhqg-van-ban-phap-che',
                'dhqg-van-ban-so-huu-tri-tue',
                'dhqg-van-ban-khac',
            ],
        ];
        
        // Kiểm tra group có hợp lệ hay không
        if (!array_key_exists($group, $validGroups)) {
            return abort(404);
        }
        
        // Lấy danh sách pages trong group
        $pagesGroup = $validGroups[$group];
        
        // Kiểm tra page có nằm trong group không
        if (!in_array($page, $pagesGroup)) {
            return abort(404);
        }
        
        // Nếu hợp lệ thì return view
        return view('trang-chu.' . $group . '.' . $page);
    }        
 
}
