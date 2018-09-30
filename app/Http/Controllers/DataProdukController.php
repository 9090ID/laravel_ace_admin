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
          'lat' => 'required',
          'lon' => 'required',
          'ket' => 'required',
          'status' => 'required',
          'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1000',
             ]);
            if($request->hasFile('gambar')){
            // Get filename with the extension
            $filenameWithExt = $request->file('gambar')->getClientOriginalName();
            // Get just filename
            $filename =  pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('gambar')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
          //  $path = $request->file('gambar')->storeAs('public/image', $fileNameToStore);
           // if(file_put_contents($fileNameToStore, $request->file('gambar'))){

           // }
            $file= $request->file('gambar');
            if ($file->move('produk1/',$fileNameToStore))
            {}
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $produk = new Produk;
        $produk->nm_kuliner = $request->nm_kuliner;
        $produk->jam_buka = $request->jam_buka;
        $produk->jam_tutup = $request->jam_tutup;
        $produk->lokasi = $request->lokasi;
        $produk->telepon = $request->telepon;
        $produk->lat = $request->lat;
        $produk->lon = $request->lon;
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
        $produk = Produk::find($id);
        $produk->nm_kuliner = $request->input('nm_kuliner');
        $produk->jam_buka = $request->input('jam_buka');
        $produk->jam_tutup = $request->input('jam_tutup');
        $produk->lokasi = $request->input('lokasi');
        $produk->telepon = $request->input('telepon');
        $produk->lat = $request->input('lat');
        $produk->lon = $request->input('lon');
        $produk->ket = $request->input('ket');
        $produk->status = $request->input('status');
       
        $file = $request->file('gambar');
         if($file != ""){
            $ext = $file->getClientOriginalExtension();
            $file = rand(10000, 50000) . '.' .$ext;
            // Filename to store
            $fileNameToStore= $file.'_'.time().'.'.$ext;
            // Upload Image
            //$path = $request->file('gambar')->storeAs('public/image', $fileNameToStore);
     $file= $request->file('gambar');
            if ($file->move('produk1/',$fileNameToStore))
            {
                 $produk->gambar =$fileNameToStore;
            }        
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        if($produk->save()){
             Session::flash('flash_message', 'Student information is updated successfully!');
        return redirect()->route('dataproduk.index');
    }
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