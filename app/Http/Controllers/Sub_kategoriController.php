<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Sub_kategori;
use \Validator, \Input, \Redirect, \Session;
use Illuminate\Http\Request;
 
class Sub_kategoriController extends Controller {
  public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = Sub_kategori::paginate(6);
		return view('admin.subberita.index')->with('data', $data);
	}
 
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		 return view('admin.subberita.create');
	}
 
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		 $this->validate($request, [
          'nama_sub_kategori' => 'required',
          'status' => 'required',
                  ]);
        $sub = new Sub_kategori;
        $sub->nama_sub_kategori = $request->nama_sub_kategori;
        $sub->status = $request->status;
    
        $sub->save();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully added data"
        ]);
        return redirect()->route('subberita.index');
	}
 
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$sub = Sub_kategori::find($id);
        
        return view('admin.subberita.index');
	}
 
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		        return view('admin.subberita.edit', ['sub' => Sub_kategori::findOrFail($id)]);
	}
 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$nama_sub_kategori = $request->input('nama_sub_kategori');
        $status = $request->input('status');
        //$password = $request->input('password');
        //$hash_password = Hash::make($password);
        Sub_kategori::where('id', $id)->update([
            'nama_sub_kategori' => $nama_sub_kategori,
            //'password' => $hash_password,
            'status' => $status
        ]);
        return redirect()->route('subberita.index');
	}
 
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$d = Sub_kategori::findOrFail($id);
        $d->delete();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully deleted data"
        ]);
        return redirect()->route('subberita.index');
	}
 
}