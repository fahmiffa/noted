@extends('auth.layout')
@section('main')
<div class="container-fluid fixed-top bg-dark p-2">
    <div class="container">
        <div class="d-flex justify-content-md-between">        
            <div class="p-2" ><a href="{{route('home')}}"><img src="{{asset('assets/img/header1.png')}}"> </a></div>    
        </div>
    </div>
</div>

<div class="container pt-5">
    <div class="row py-3">
        <div class="card card-body py-3">
            <h5 class="text-center">CEK DOKUMEN VERIFIKASI </h5>
            <hr/>
            <p class="text-left">Masukkan Nomor Registrasi dan Nomor Dokumen</p>
            <form action="{{route('store')}}" method="post">
                @csrf           
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nomor Registrasi PBG/SLF</label>
                            <input type="text" name="reg" value="{{old('reg')}}" class="form-control">
                            @error('reg')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nomor Dokumen Verifikasi</label>
                            <input type="text" name="doc" value="{{old('doc')}}" class="form-control">
                            @error('doc')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm my-3">Check</button>
            </form>
        </div>
    </div>
    @if (session('res'))
        @php 
        $row = session('res'); 
        $items = json_decode($row->items);
        $header = $items->header;
        @endphp
    <div class="row p-3 bg-white">
        <div class="container-fluid">
            <p class="text-left h5">Informasi Dokumen</p>            
            <div class="row g-0 row-cols-2 row-cols-md-2 row-cols-xl-2 justify-content-center">            
                <div class="col-6">Nama Pemohon</div>                
                <div class="col-6">:&nbsp;&nbsp;{{($header) ? $header[2] : null}}</div>
                <div class="col-6">Alamat Pemohon</div>                
                <div class="col-6 d-md-none d-sm-block d-flex">:&nbsp;&nbsp;<p>{{($row->desa) ? $row->desa->nama : null}}, {{($row->desa) ? $row->desa->kecamatan->nama : null}}, {{($header) ? $header[4] : null}}</p></div>
                <div class="col-6 d-none d-md-block">:&nbsp;&nbsp;{{($row->desa) ? $row->desa->nama : null}}, {{($row->desa) ? $row->desa->kecamatan->nama : null}}, {{($header) ? $header[4] : null}}</div>
                <div class="col-6">No. Registrasi</div>
                <div class="col-6">:&nbsp;&nbsp;{{$row->noreg}}</div>
                <div class="col-6">No. Dokumen</div>
                <div class="col-6 d-md-none d-sm-block d-flex">:&nbsp;&nbsp;<p>{{$row->nomor}}</p></div>
                <div class="col-6 d-none d-md-block">:&nbsp;&nbsp;{{$row->nomor}}</div>
                <div class="col-6">Nama Bangunan</div>
                <div class="col-6">:&nbsp;&nbsp;{{($header) ? $header[5] : null}}</div>
                <div class="col-6">Lokasi Bangunan</div>
                <div class="col-6 d-md-none d-sm-block d-flex">:&nbsp;&nbsp;<p>{{($header) ? $header[7] : null}}</p></div>
                <div class="col-6 d-none d-md-block">:&nbsp;&nbsp;{{($header) ? $header[7] : null}}</div>
                <div class="col-6">Catatan/Status</div>
                <div class="col-6">:&nbsp;&nbsp;{{$row->status}}</div>
                @if($row->dokumen && $row->tipe == 'doc')
                <div class="col-6">Dokumen</div>
                <div class="col-6">:&nbsp;&nbsp;<a href="{{ asset('assets/doc/'.$row->dokumen) }}" class="btn btn-danger btn-sm" target="_blank">Lihat Dokumen</a></div>
                @elseif($row->tipe == 'field')
                <div class="col-6">Dokumen</div>
                <div class="col-6">:&nbsp;&nbsp;<a href="{{ route('dok', ['formulir'=>$row->id]) }}" target="_blank" class="btn btn-sm btn-dark">Lihat Dokumen</a></div>
                @endif
                <div class="col-6">Verifikator</div>
                <div class="col-6">:&nbsp;&nbsp;{{$row->users->name}}</div>   
            </div>            
        </div>
    </div>
    @elseif(session('none'))
    <div class="row py-3">
        <div class="card card-body py-3">
            <p class="text-center h5">{{session('none')}}</p>                     
        </div>
    </div>
    @endif
</div>
@endsection