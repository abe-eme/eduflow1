<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'active';
        $user->save();

        return back();
    }

    public function reject($id)
    {
        User::destroy($id);

        return back();
    }
}
