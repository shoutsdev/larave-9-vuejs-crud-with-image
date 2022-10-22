<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'users' => User::latest()->paginate(10)
        ], 200);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        DB::beginTransaction();

        $data = $request->all();

        if ($request->image) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/users', $image_new_name);
            $data['image'] = 'uploads/users/' . $image_new_name;
        }

        $data['password'] = bcrypt($request->password);
        User::create($data);
        DB::commit();
        return response()->json(['success' => 'User Created Successfully'], 201);

    }


    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::find($request->id);

        $data = $request->all();

        if ($request->image) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/users', $image_new_name);
            $data['image'] = 'uploads/users/' . $image_new_name;
        }

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return response()->json(['success' => 'User Updated Successfully'], 200);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        User::destroy($id);

        return response()->json([
            'success' => 'User Removed Successfully',
        ]);
    }

}
