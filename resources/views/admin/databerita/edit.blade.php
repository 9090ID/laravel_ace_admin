@extends('admin.layouts.template')

@section('content')

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Home</a>
                            </li>
                            <li class="active">Dashboard</li>
                        </ul><!-- /.breadcrumb -->

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
                                <span class="input-icon">
                                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                                </span>
                            </form>
                        </div><!-- /.nav-search -->
                    </div>

                    <div class="page-content">
                        <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                                <i class="ace-icon fa fa-cog bigger-130"></i>
                            </div>

                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <div class="pull-left">
                                            <select id="skin-colorpicker" class="hide">
                                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                            </select>
                                        </div>
                                        <span>&nbsp; Choose Skin</span>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-add-container">
                                            Inside
                                            <b>.container</b>
                                        </label>
                                    </div>
                                </div><!-- /.pull-left -->

                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                    </div>
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->

                        <div class="page-header">
                            <h1>
                                Dashboard
                                <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                    Edit  Berita
                                </small>
                            </h1>
                        </div><!-- /.page-header -->
<!--=========================Isi Konten========================-->
<h3>Form Edit Data Berita</h3><hr>

<div class="container">
        <div class="row">
            <div class="col-md-6">
             
             
                        <form action="{{route('databerita.update' , $berita->id)}}" method="post">
                
                {{ csrf_field() }}
            {{ method_field('PATCH') }}

                             <div class="form-group">
                                <label>Judul Berita</label>
                                <input type="text" name="judul_berita" class="form-control" value="{{$berita->judul_berita}}" > 
                            </div>
                            <div class="form-group">
                                <label>isi Berita</label>
                                <textarea name="isi_berita" class="form-control">{{$berita->isi_berita}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link Video Embed / Channel Youtube</label>
                                <input type="text" name="link_berita" class="form-control" required value="{{$berita->link_berita}}" > 
                            </div>
                            <div class="form-group">
                                <label>Tanggal Upload</label>
                                <input type="date" name="tanggal_upload" class="form-control" required value="{{$berita->tanggal_upload}}"> 
                            </div>
                                 <div class="form-group">
                                <label>Nama Kategori</label>
                                <select name="kategori" class="form-control">
                                    <option>{{$berita->kategori}}</option>
                                    @foreach($list as $list)
                                    <option value="{{$list->nama_sub_kategori}}">{{$list->nama_sub_kategori}}</option>
                                    @endforeach
                                </select>
                               
                            </div>

                            <div class="form-group">
                                <label>Nama Operator Penginput Berita</label>
                                <input type="text" name="pengupload" class="form-control" required value="{{$berita->pengupload}}"> 
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option>{{$berita->status}}</option>
                                    <option value="aktif"> Aktif </option>
                                    <option value="non aktif">Non Aktif </option>
                                </select>
                               </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-sm">Save</button>
                            </div>
                           
                        </form>
                  
           
            </div>
        </div>
    </div>
              
<!--=================================================-->
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

@endsection
