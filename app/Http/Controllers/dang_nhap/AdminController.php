<?php

namespace App\Http\Controllers\dang_nhap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    
    public function showLoginForm()
    {
        return view('admin.login');
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role == 'admin') {
                session(['admin_logged_in' => true]);
//
                return redirect('admin/welcome');
            }
            if($user->role == 'user') {
                session(['user_logged_in' => true]);
                return redirect('user/welcome');
            }
        }
        return back()->withErrors([
            'email' => 'Bạn nhập sai email hoặc mật khẩu.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin/login');
    }

    public function welcome()
    {
        $user = Auth::user();
        if($user->role == 'admin') {
            return view('admin.dashboard.admin');
        } elseif ($user->role == 'user') {
            return view('admin.dashboard.user');
        }
    }


    public function pages_admin($group, $page)
    {
        
        $validGroups = [
            'user' => [
                'index', 'create', 'edit', 
            ],
   
            'sukien' => [
                'index', 'create', 'edit', 
            ],
            'quytrinhquydinh' => [
                'index', 'create', 'edit', 
            ],
            'vanbanbieumau' => [
                'index', 'create', 'edit', 
            ],
            'kehoach' => [
                'index', 'create', 'edit', 
            ],
            'congtacphapche' => [
                'index', 'create', 'edit', 
            ],
            'CongTacTiepCongDan' => [
                'index', 'create', 'edit', 
            ],
            'CongTacTuyenTruyenPhoBienPhapLuat' => [
                'index', 'create', 'edit', 
            ],
            'thongbao' => [
                'index', 'create', 'edit', 
            ],
            'shttquytrinh' => [
                'index', 'create', 'edit', 
            ],
            'shttvanbanbieumau' => [
                'index', 'create', 'edit', 
            ],
            'shttkehoachcongvan' => [
                'index', 'create', 'edit', 
            ],
            'vanbanthanhtra' => [
                'index', 'create', 'edit',  
            ],
            'vanbansohuutritue' => [
                'index', 'create', 'edit', 
            ],
            'vanbanphapche' => [
                'index', 'create', 'edit', 
            ],
            'vanbankhac' => [
                'index',
            ],
            'dhqgvanbanthanhtra' => [
                'index',
            ],
            'dhqgvanbankhac' => [
                'index',
            ],
            'dhqgvanbansohuutritue' => [
                'index',
            ],
            'dhqgvanbanphapche' => [
                'index',
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
        return view('admin.' . $group . '.' . $page);
    }        

    public function pages_user($group, $page)
    {
        
        $validGroups = [   
            'sukien' => [
                'index', 'create', 'edit', 
            ],
            'quytrinhquydinh' => [
                'index',
            ],
            'vanbanbieumau' => [
                'index',
            ],
            'kehoach' => [
                'index',
            ],
            'congtacphapche' => [
                'index',
            ],
            'CongTacTiepCongDan' => [
                'index',
            ],
            'CongTacTuyenTruyenPhoBienPhapLuat' => [
                'index',
            ],
            'thongbao' => [
                'index',
            ],
            'shttquytrinh' => [
                'index',
            ],
            'shttvanbanbieumau' => [
                'index',
            ],
            'shttkehoachcongvan' => [
                'index',
            ],
            'vanbanthanhtra' => [
                'index',
            ],
            'vanbansohuutritue' => [
                'index',
            ],
            'vanbanphapche' => [
                'index',
            ],
            'vanbankhac' => [
                'index',
            ],
            'dhqgvanbanthanhtra' => [
                'index',
            ],
            'dhqgvanbankhac' => [
                'index',
            ],
            'dhqgvanbansohuutritue' => [
                'index',
            ],
            'dhqgvanbanphapche' => [
                'index',
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
        return view('user.' . $group . '.' . $page);



}

}