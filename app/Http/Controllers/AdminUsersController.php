<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserEditRequest;
use App\Http\Requests\AdminUsersRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view("admin.users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //lists() - to pull out specific data from db. lists() has been change to pluck()
        // all() - is goin to bring collection which we dnt wnt. 
        $roles = Role::pluck('name', 'id')->all(); 
        
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUsersRequest $request)
    {
        //
        // return $request->all(); // for testing

        // User::create($request->all());



        if (trim($request->password) == "") {
            $input = $request->except('password');
        }else {
            $input = $request->all();
            // hashin password field in db
            $input['password'] = bcrypt($request->password);
        }


        if ($file_data = $request->file('photo_id')) {
            # code...
            // return "its workin"; // testing
            $name = time() . $file_data->getClientOriginalName();
            $file_data->move("images", $name);

            // create a photo to db if exist
            $photo = Photo::create(['file'=> $name]);

            // saving photo id insde users table
            $input['photo_id'] = $photo->id;
        }

        // // hashin password field in db
        // $input['password'] = bcrypt($request->password);

        User::create($input);

        session()->flash('session_user_key', 'The user has been created');

        return redirect("/admin/users");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserEditRequest $request, $id)
    {
        // return $request->all(); // for testing form input

        $user = User::findOrFail($id);

        Session()->flash('session_user_key', 'The user has been updated');

        if (trim($request->password) == "") {
            $input = $request->except('password');
        }else {
            $input = $request->all();
            // hashin password field in db
            $input['password'] = bcrypt($request->password);
        }

        if ($file_img = $request->file('photo_id')) {

            $name = time() . $file_img->getClientOriginalName();

            $file_img->move("images", $name);

            $photo = Photo::create(['file'=> $name]);

            $input['photo_id'] = $photo->id;
        }
        

        $user->update($input);

        return redirect("/admin/users");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        // return "deleted";

        $user = User::findOrFail($id);

        unlink(public_path() . $user->photo->file); // deleting files

        $user->delete();

        session()->flash('session_user_key', 'The user has been deleted');

        return redirect("/admin/users");
    }
}
