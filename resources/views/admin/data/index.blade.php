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
                            <a href="{{route('doc.create')}}" class="btn btn-primary btn-sm">Tambah Data</a>                                                            
                            <a href="{{route('export')}}" class="btn btn-danger btn-sm">Export</a>                           
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#import">Import</button>                   
                        </div>
                    </div>          
                    <form action="{{route('filter')}}" method="get">
                        <div class="row py-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <select class="form-control select-field" name="year">
                                        <option value="2023" {{isset($year) && $year == '2023' ? 'selected' : null}}>2023</option>
                                        <option value="2022" {{isset($year) && $year == '2022' ? 'selected' : null}} >2022</option>
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
                        <th scope="col">Tanggal</th>                        
                        <th scope="col">Nama</th>                          
                        <th scope="col">No. Registrasi</th>                                     
                        <th scope="col">No. Dokumen</th>                                     
                        <th scope="col">Nama Bangunan</th>                                        
                        <th scope="col">Action</th>            
                        </tr>
                    </thead>
                    <tbody>                        
                        @foreach($da as $row)       
                            <tr>
                            <th scope="row">{{$loop->iteration}}</th>                   
                                <td>{{$row->tanggal}}</td> 
                                <td>{{$row->nama}}</td>                                         
                                <td>{{$row->noreg}}</td>                                                  
                                <td>{{$row->nodoc}}</td>                                                  
                                <td>{{$row->data2}}</td>                      
                                <td>

                                @if(Auth()->user()->role == 'admin')
                                <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('doc.destroy', $row->id) }}" method="POST">
                                    <a href="{{ route('doc.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$row->id}}">Detail</button>
                                </form>
                                @else
                                    @if(Auth()->user()->id == $row->users_id)                                
                                    <a href="{{ route('doc.edit', $row->id) }}" class="btn btn-sm btn-primary">EDIT</a>                                                                                                            
                                    @endif
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#myModal{{$row->id}}">Detail</button>                                
                                @endif

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
                    <label>PILIH FILE</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">                
                <button type="submit" class="btn btn-success">Import</button>
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
                {{-- <div class="col-3 my-auto">{!! QrCode::generate(route('data',['id'=>md5($row->id)])); !!} </div> --}}
                <div class="text-center small" class="col-3 my-auto">{!! QrCode::generate(route('data',['reg'=>$row->noreg, 'doc'=>$row->nodoc])); !!} </div>
                <p></p>
                <div class="col-auto">
                <div class="row">
                        <div class="col-3">Nama</div>
                        <div class="col-8">: {{$row->nama}}</div>
                        <div class="col-3">Alamat</div>
                        <div class="col-8">: {{$row->alamat}}</div>
                        <div class="col-3">No. Registrasi</div>
                        <div class="col-8">: {{$row->noreg}}</div>
                        <div class="col-3">No. Dokumen</div>
                        <div class="col-8">: {{$row->nodoc}}</div>
                        <div class="col-3">Nama Bangunan</div>
                        <div class="col-8">: {{$row->data2}}</div>
                        <div class="col-3">Lokasi Bangunan</div>
                        <div class="col-8">: {{$row->catatan}}</div>
                        <div class="col-3">Catatan/Status</div>
                        <div class="col-8">: {{$row->status}}</div>
                        @if($row->dokumen)
                        <div class="col-3">Dokumen</div>
                        <div class="col-8">: <a href="{{ asset('assets/doc/'.$row->dokumen) }}" class="btn btn-danger" target="_blank">Lihat Dokumen</a></div>
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