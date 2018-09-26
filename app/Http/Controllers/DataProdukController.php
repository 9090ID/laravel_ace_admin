<?php namespace App\Http\Controllers;
 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Produk;
use \Validator, \Input, \Redirect, \Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class DataProdukController extends Controller {
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
        $data = Produk::paginate(6);
        return view('admin.dataproduk.index')->with('data', $data);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
            return view('admin.dataproduk.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
          'nm_kuliner' => 'required',
          'jam_buka' => 'required',
          'jam_tutup' => 'required',
          'lokasi' => 'required',
          'telepon' => 'required',
          'alamat_maps' => 'required',
          'ket' => 'required',
          'status' => 'required',
          'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000',
             ]);
            if($request->hasFile('gambar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('gambar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('gambar')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $produk = new Produk;
        $produk->nm_kuliner = $request->nm_kuliner;
        $produk->jam_buka = $request->jam_buka;
        $produk->jam_tutup = $request->jam_tutup;
        $produk->lokasi = $request->lokasi;
        $produk->telepon = $request->telepon;
        $produk->alamat_maps = $request->alamat_maps;
        $produk->ket = $request->ket;
        $produk->status = $request->status;
        $produk->gambar = $fileNameToStore;
        $produk->save();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully added data"
        ]);
        return redirect()->route('dataproduk.index');
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
    return view('admin.dataproduk.edit', ['produk' => Produk::findOrFail($id)]);
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $nm_kuliner = $request->input('nm_kuliner');
        $jam_buka = $request->input('jam_buka');
        $jam_tutup = $request->input('jam_tutup');
        $lokasi = $request->input('lokasi');
        $telepon = $request->input('telepon');
        $alamat_maps = $request->input('alamat_maps');
        $ket = $request->input('ket');
        $status = $request->input('status');
       

          if($request->hasFile('gambar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('gambar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('gambar')->storeAs('public/image', $fileNameToStore);
        }

        //$password = $request->input('password');
        //$hash_password = Hash::make($password);
        Produk::where('id', $id)->update([
            'nm_kuliner' => $nm_kuliner,
            'jam_buka' => $jam_buka,
            'jam_tutup' => $jam_tutup,
            'lokasi' => $lokasi,
            'telepon' => $telepon,
            'alamat_maps' => $alamat_maps,
            'ket' => $ket,
            'status' => $status
        ]);
         if($request->hasFile('gambar')){
            $produk->gambar = $fileNameToStore;
        }
         Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully Update data"
        ]);
        return redirect()->route('dataproduk.index');
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $d = Produk::findOrFail($id);
        if($d->gambar !== 'noimage.jpg'){
            //Delete image
            Storage::delete('public/image'.$d->gambar);
        }
        $d->delete();
        Session::flash("flash_notification", [
            "level"   => "success",
            "message" => "Successfully deleted data"
        ]);
        return redirect()->route('dataproduk.index');
    }
 
}