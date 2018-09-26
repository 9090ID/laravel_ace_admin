<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Iklanvideo;
use \Validator, \Input, \Redirect, \Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class IklanvideoController extends Controller {
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
        $data = Iklanvideo::paginate(6);
        return view('admin.datavideo.index')->with('data', $data);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
            return view('admin.datavideo.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
          'judul_video' => 'required',
          'status' => 'required',
          'foto_iklan' => 'image|mimes:mp4,mov,ogg,3gp,avi,wmv|max:1000',
             ]);
            if($request->hasFile('video')){
            // Get filename with the extension
            $filenameWithExt = $request->file('video')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('video')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('video')->storeAs('public/video', $fileNameToStore);
        } else {
            $fileNameToStore = 'novideo.mp4';
        }

        $ivideo = new Iklanvideo;
        $ivideo->judul_video = $request->judul_video;
        $ivideo->status = $request->status;
        $ivideo->video = $fileNameToStore;
        $ivideo->save();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully added data"
        ]);
        return redirect()->route('datavideo.index');
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
    return view('admin.iklan.edit', ['iklan' => Iklan::findOrFail($id)]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $judul_iklan = $request->input('judul_iklan');
        $deskripsi_iklan = $request->input('deskripsi_iklan');
        $pemesan_iklan = $request->input('pemesan_iklan');
        $link_iklan = $request->input('link_iklan');
        $lokasi = $request->input('lokasi');
        $tanggal_upload = $request->input('tanggal_upload');
        $tanggal_expired = $request->input('tanggal_expired');
        $pengupload = $request->input('pengupload');
        $status = $request->input('status');
       

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
        }

        //$password = $request->input('password');
        //$hash_password = Hash::make($password);
        Iklan::where('id', $id)->update([
            'judul_iklan' => $judul_iklan,
            'deskripsi_iklan' => $deskripsi_iklan,
            'pemesan_iklan' => $pemesan_iklan,
            'link_iklan' => $link_iklan,
            'lokasi' => $lokasi,
            'tanggal_upload' => $tanggal_upload,
            'tanggal_expired' => $tanggal_expired,
            'pengupload' => $pengupload,
            'status' => $status
        ]);
         if($request->hasFile('foto_iklan')){
            $iklan->foto_iklan = $fileNameToStore;
        }
         Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully Update data"
        ]);
        return redirect()->route('iklan.index');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $d = Iklan::findOrFail($id);
        if($d->foto_iklan !== 'noimage.jpg'){
            //Delete image
            Storage::delete('public/image'.$d->foto_iklan);
        }
        $d->delete();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully deleted data"
        ]);
        return redirect()->route('iklan.index');
    }
 
}