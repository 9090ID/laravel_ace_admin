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
                                    Data Iklan
                                </small>
                            </h1>
                        </div><!-- /.page-header -->

@if (session()->has('flash_notification.message'))
<div class="row">
<div class="col-sm-12">
    <div class="alert alert-{{ session()->get('flash_notification.level') }}">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {!! session()->get('flash_notification.message') !!}
    </div>
  </div>
</div>
@endif
                       
          
              
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="{{route('iklan.create')}}"  style="text-decoration: none;"> <i class="fa fa-plus"></i> Tambah Data</a>
            <table class="table table-hover">
            <thead>
            <tr>
                <th>Judul Iklan</th>
                <th>Penguload Iklan</th>
                <th>Pemesan Iklan</th>
                <th>Tanggal Iklan</th>
                <th>Tanggal Expired  Iklan</th>
                <th>Lokasi Iklan</th>
                <th>Foto</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{ $d->judul_iklan }}</td>
                    <td>{{ $d->pengupload }}</td>
                    <td>{{ $d->pemesan_iklan }}</td>
                    <td>{{ $d->tanggal_upload }}</td>
                    <td>{{ $d->tanggal_expired }}</td>
                    <td>{{ $d->lokasi }}</td>
                    
                    <td><img src="/storage/image/{{$d->foto_iklan}}" class="thumbnail" height="70" width="70"></div></td>

                    <td>{{ $d->status }}</td> 
                                       <td width="25"><a href="{{ route('iklan.edit', $d->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i>Edit </a> </td>
                       <td><form action="{{ route('iklan.destroy', $d->id) }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="delete">
                        <input class="btn btn-danger btn-sm" type="submit" name="name" value="delete">
                    </form> 
</td>
                </tr>
            @endforeach
            </tbody>
        </table>
{{ $data->links() }}


                                    </div>
                                    
                                </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

@endsection
