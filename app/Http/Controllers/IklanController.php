<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Iklan;
use \Validator, \Input, \Redirect, \Session;
use Illuminate\Http\Request;
 
class IklanController extends Controller {
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
        $data = Iklan::paginate(6);
        return view('admin.iklan.index')->with('data', $data);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
            return view('admin.iklan.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
          'judul_iklan' => 'required',
          'deskripsi_iklan' => 'required',
          'pemesan_iklan' => 'required',
          'link_iklan' => 'required',
          'lokasi' => 'required',
          'tanggal_upload' => 'required|date',
          'tanggal_expired' => 'required|date',
          'pengupload' => 'required',
          'status' => 'required',
          'foto_iklan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          
                  ]);
            if($request->hasFile('foto_iklan')){
            // Get filename with the extension
            $filenameWithExt = $request->file('foto_iklan')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('foto_iklan')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('foto_iklan')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $iklan = new Iklan;
        $iklan->judul_iklan = $request->judul_iklan;
        $iklan->deskripsi_iklan = $request->deskripsi_iklan;
        $iklan->pemesan_iklan = $request->pemesan_iklan;
        $iklan->link_iklan = $request->link_iklan;
        $iklan->lokasi = $request->lokasi;
        $iklan->tanggal_upload = $request->tanggal_upload;
        $iklan->tanggal_expired = $request->tanggal_expired;
        $iklan->pengupload = $request->pengupload;
        $iklan->status = $request->status;
        $iklan->foto_iklan = $fileNameToStore;
        $iklan->save();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully added data"
        ]);
        return redirect()->route('iklan.index');
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