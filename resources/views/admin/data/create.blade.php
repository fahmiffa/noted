@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($doc)
                        <form action="{{route('doc.update', $doc->id)}}" method="post" enctype="multipart/form-data">                    
                        @method('PATCH')   
                    @else                        
                        <form action="{{route('doc.store')}}" method="post" enctype="multipart/form-data">                                            
                    @endisset


                        @csrf           
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">nama</label>
                            <div class="col-sm-6">
                            <input type="text" name="nama" value="{{ isset($doc) ? $doc->nama : null}}"  class="form-control">
                            @error('nama')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>      
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-6">
                            <input type="date" name="tanggal" value="{{ isset($doc) ? $doc->tanggal : null}}"  class="form-control">
                            @error('tanggal')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>      
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-6">
                            <select name="district" class="form-control select-field" id="dis">
                                @foreach($dis as $row)
                                <option value="{{$row->id}}"  {{ isset($doc) && ($doc->desa->kecamatan->id == $row->id) ? 'selected' : null }}   >{{$row->nama}}</option>
                                @endforeach
                            </select>
                            @error('district')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>  
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Desa</label>
                            <div class="col-sm-6">
                            <select name="village" class="form-control select-field" id="vil">   
                                @isset($doc)
                                <option value="{{$doc->desa->id}}">{{$doc->desa->nama}}</option>
                                @endif                                        
                            </select>
                            @error('village')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>  
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-6">
                            <textarea name="alamat" class="form-control">{{ isset($doc) ? $doc->alamat : null}}</textarea>
                            @error('alamat')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No Registrasi</label>
                            <div class="col-sm-6">
                            <input type="text" name="noreg" value="{{ isset($doc) ? $doc->noreg : null}}"  class="form-control">
                            @error('noreg')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No Doc</label>
                            <div class="col-sm-6">
                            <input type="text" name="nodoc" value="{{ isset($doc) ? $doc->nodoc : null}}"  class="form-control">
                            @error('nodoc')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Data 2</label>
                            <div class="col-sm-6">
                            <input type="text" name="data2" value="{{ isset($doc) ? $doc->data2 : null}}"  class="form-control">
                            @error('data2')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-6">
                            <textarea name="catatan" class="form-control">{{ isset($doc) ? $doc->catatan : null}}</textarea>
                            @error('catatan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>    
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-6">
                            <input type="text" name="status" value="{{ isset($doc) ? $doc->status : null}}"  class="form-control">
                            @error('status')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>   
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Upload FIles</label>
                            <div class="col-sm-6">
                            <input class="form-control" type="file" name="file" accept="application/pdf">       
                            @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror                     
                            </div>
                        </div>                                                                  
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('doc.index')}}">Back</a>                 
                        </div>
                    </form>
                </div>
            </div>                  
        </div>                 
    </div>    
</section>

@push('js')
<script>
    $( '.select-field' ).select2( {
    theme: 'bootstrap-5'
} );

$('#dis').on('change',function(e){
    e.preventDefault();    
    $('#vil').empty();
    $.ajax({
        type:'POST',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"{{ route('village') }}",
        data:{id:$(this).val()},
        success:function(data){
            console.log(data);
            $.each(data, function(key, value) {
                $('#vil').append('<option value="' + key + '">' + value + '</option>');
            });
        }
    });
});
</script>
@endpush

@endsection