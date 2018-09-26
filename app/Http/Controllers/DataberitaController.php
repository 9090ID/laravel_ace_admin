<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Berita;
use App\Sub_kategori;
use \Validator, \Input, \Redirect, \Session;
use Illuminate\Http\Request;
 use Illuminate\Support\Str;
class DataberitaController extends Controller {
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
        $data = Berita::paginate(6);
        return view('admin.databerita.index')->with('data', $data);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         $list=Sub_kategori::select('nama_sub_kategori')->get();
         return view('admin.databerita.create')->with('list',$list);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
          'judul_berita' => 'required',
          'isi_berita' => 'required',
          'link_berita' => 'required',
          'tanggal_upload' => 'required|date',
          'kategori' => 'required',
          'pengupload' => 'required',
          'status' => 'required',
                  ]);

        $berita = new Berita;
        $berita->judul_berita = $request->judul_berita;
        $berita->isi_berita = $request->isi_berita;
        $berita->link_berita = $request->link_berita;
        $berita->slug = Str::slug($request->get('judul_berita'));
        $berita->tanggal_upload = $request->tanggal_upload;
        
        $berita->kategori = $request->kategori;
        $berita->pengupload = $request->pengupload;
        $berita->status = $request->status;
        $berita->save();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully added data"
        ]);
        return redirect()->route('databerita.index');
    }
 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
    $list=Sub_kategori::select('nama_sub_kategori')->get();
    return view('admin.databerita.edit', ['berita' => Berita::findOrFail($id)])->with('list',$list);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $judul_berita = $request->input('judul_berita');
        $isi_berita = $request->input('isi_berita');
        $slug = Str::slug($request->get('judul_berita'));
        $link_berita = $request->input('link_berita');
        $tanggal_upload = $request->input('tanggal_upload');
        $kategori = $request->input('kategori');
        $pengupload = $request->input('pengupload');
        $status = $request->input('status');
        //$password = $request->input('password');
        //$hash_password = Hash::make($password);
        Berita::where('id', $id)->update([
            'judul_berita' => $judul_berita,
            'isi_berita' => $isi_berita,
            'slug'=>$slug,
            'link_berita' => $link_berita,
            'tanggal_upload' => $tanggal_upload,
            'kategori' => $kategori,
            'pengupload' => $pengupload,
            'status' => $status
        ]);
         Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully Update data"
        ]);
        return redirect()->route('databerita.index');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $d = Berita::findOrFail($id);
        $d->delete();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully deleted data"
        ]);
        return redirect()->route('databerita.index');
    }
 
}