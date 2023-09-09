@extends('layout.base')
@section('main')
<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">  
                <div class="card-body">
                    <div class="d-flex justify-content-between py-3">
                        <div class="p-2">
                            <h5 class="card-title">{{$data}}</h5>
                        </div>
                        <div class="p-2">
                            <a href="{{route('formulir.create')}}" class="btn btn-primary btn-sm">Tambah Data</a>   
                            <a href="{{route('export')}}" class="btn btn-danger btn-sm">Export</a>                           
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#import">Import</button>                                                                                     
                        </div>
                    </div>                   
                    <form action="{{route('filter')}}" method="get">
                        <div class="row py-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-control select-field" name="year">
                                        @for ($i = 0; $i < 5; $i++)                                            
                                            <option value="{{2023-$i}}" {{isset($year) && $year == $i ? 'selected' : null}}>{{2023-$i}}</option>
                                        @endfor                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-dark">Filter</button>
                            </div>
                        </div>
                    </form>  
                    <table class="table dt-responsive nowrap" id="tabel">
                    <thead>
                        <tr>
                        <th scope="col">No.</th>                        
                        <th scope="col">Nomor Dokumen</th>        
                        <th scope="col">Nomor Registrasi</th>                                                                                                                 
                        <th scope="col">Tanggal</th>            
                        <th scope="col">Action</th>            
                        </tr>
                    </thead>
                    <tbody>                        
                        @foreach($da as $row)       
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>                   
                                <td>{{$row->nomor}}</td>                                                                                                                                                        
                                <td>{{$row->noreg}}</td>                                                                                                                                                        
                                <td>{{$row->tanggal}}</td>
                                <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('formulir.destroy', $row->id) }}" method="POST">                                            
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>    
                                            <button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#myModal{{$row->id}}"><i class="bi bi-eye"></i></button>                                                                                        
                                            <a href="{{ route('formulir.edit', $row->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                        </form>

                                </td>                  
                            </tr>          
                        @endforeach                                                           
                    </tbody>
                    </table>
                </div>
            </div>
        </div>     
    </div> 
</section>


<div class="modal fade" id="import">
    <div class="modal-dialog">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Import Data</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>Pilih File</label>
                    <input type="file" name="file" class="form-control" required accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                </div>       
            </div>
            <div class="modal-footer justify-content-between">  
                <a class="btn btn-primary btn-sm float-start" href="{{asset('assets/doc.xlsx')}}">Sample</a>              
                <button type="submit" class="btn btn-sm btn-success">Import</button>
            </div>
        </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>

@foreach($da as $row)       
@php
$items = json_decode($row->items);
$header = $items->header;
@endphp
<div class="modal fade" id="myModal{{$row->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Data</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">                                
                <div class="col-auto">
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
                        <div class="col-8">: <a href="{{ route('formulir.show', $row->id) }}" target="_blank" class="btn btn-sm btn-dark">Lihat Dokumen</a></div>
                        @endif
                        <div class="col-3">Verifikator</div>
                        <div class="col-8">: {{$row->users->name}}</div>             
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>
@endforeach

@endsection