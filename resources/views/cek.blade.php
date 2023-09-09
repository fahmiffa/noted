@extends('auth.layout')
@section('main')
<div class="container-fluid fixed-top bg-dark p-2">
    <div class="container">
        <div class="d-flex justify-content-md-between">        
            <div class="p-2" ><a href="{{route('home')}}"><img src="{{asset('assets/img/header1.png')}}"> </a></div>    
        </div>
    </div>
</div>

<div class="container pt-5 mt-5">
    <div class="row py-3">
        <div class="card card-body py-3">
            <p class="text-left h5">Informasi Dokumen</p>            
            <table class="table table-bordered table-sm" style="width:100%">
                <tr>
                    <td>Pemohon</td>
                    <td>:</td>
                    <td>{{($header) ? $header[2] : null}}</td>
                  </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{($header) ? $header[4] : null}}</td>
                  </tr>
                <tr>
                    <td>No. Registrasi</td>
                    <td>:</td>
                    <td>{{$row->noreg}}</td>
                  </tr>
                <tr>
                    <td>No. Dokumen</td>
                    <td>:</td>
                    <td>{{$row->nomor}}</td>
                  </tr>
                <tr>
                    <td>Bangunan</td>
                    <td>:</td>
                    <td>{{($header) ? $header[5] : null}}</td>
                  </tr>
                <tr>
                    <td>Lokasi</td>
                    <td>:</td>
                    <td>{{($header) ? $header[7] : null}}, Desa {{($row->desa) ? $row->desa->nama : null}}, Kecamatan {{($row->desa && $row->desa->kecamatan) ? $row->desa->kecamatan->nama : null}}, Kabupaten Tegal</td>
                  </tr>
                <tr>
                    <td>Catatan/Status</td>
                    <td>:</td>
                    <td>{{$row->status}}</td>
                  </tr>
                <tr>
                    <td>Dokumen</td>
                    <td>:</td>
                    <td>
                       @if($row->dokumen && $row->tipe == 'doc')
                       <a href="{{ asset('assets/doc/'.$row->dokumen) }}" class="btn btn-secondary btn-sm" target="_blank">Lihat Dokumen</a>
                       @else
                       <a href="{{ route('dok', ['formulir'=>$row->id]) }}" target="_blank" class="btn btn-sm btn-dark">Lihat Dokumen</a>
                       @endif
                    </td>
                  </tr>
                <tr>
                    <td>Verifikator</td>
                    <td>:</td>
                    <td>{{$row->users->name}}</td>
                </tr>
          </table>        
        </div>
    </div>
</div>
@endsection