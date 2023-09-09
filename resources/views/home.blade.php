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
    <div class="row py-3">
        <div class="card card-body py-3">
            <p class="text-left h5">Informasi Dokumen</p>            
            <div class="row">            
                <div class="col-3">Nama Pemohon</div>
                <div class="col-8">: {{($header) ? $header[2] : null}}</div>
                <div class="col-3">Alamat Pemohon</div>
                <div class="col-8">: {{($row->desa) ? $row->desa->nama : null}}, {{($row->desa) ? $row->desa->kecamatan->nama : null}}, {{($header) ? $header[4] : null}}</div>
                <div class="col-3">No. Registrasi</div>
                <div class="col-8">: {{$row->noreg}}</div>
                <div class="col-3">No. Dokumen</div>
                <div class="col-8">: No. {{$row->nomor}}</div>
                <div class="col-3">Nama Bangunan</div>
                <div class="col-8">: {{($header) ? $header[5] : null}}</div>
                <div class="col-3">Lokasi Bangunan</div>
                <div class="col-8">: {{($header) ? $header[7] : null}}</div>
                <div class="col-3">Catatan/Status</div>
                <div class="col-8">: {{$row->status}}</div>
                @if($row->dokumen && $row->tipe == 'doc')
                <div class="col-3">Dokumen</div>
                <div class="col-8">: <a href="{{ asset('assets/doc/'.$row->dokumen) }}" class="btn btn-danger btn-sm" target="_blank">Lihat Dokumen</a></div>
                @elseif($row->tipe == 'field')
                <div class="col-3">Dokumen</div>
                <div class="col-8">: <a href="{{ route('dok', ['formulir'=>$row->id]) }}" target="_blank" class="btn btn-sm btn-dark">Lihat Dokumen</a></div>
                @endif
                <div class="col-3">Verifikator</div>
                <div class="col-8">: {{$row->users->name}}</div>   
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