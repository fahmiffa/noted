@extends('layout.base')
@section('main')

<section class="section">    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title py-3">{{$data}}</h5>

                    @isset($content)
                        <form action="{{route('content.update', $content->id)}}" method="post">                       
                        @method('PATCH')   
                    @else
                    <form action="{{route('content.store')}}" method="post">                   
                    @endisset
                        @csrf                         
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">nama</label>
                            <div class="col-sm-6">
                            <input type="text" name="nama" value="{{ isset($content) ? $content->name : old('nama')}}"  class="form-control">
                            @error('nama')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                                                                                                  
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger" href="{{route('content.index')}}">Back</a>                        
                        </div>
                    </form>
                </div>
            </div>                  
        </div>                 
    </div>    
</section>

@endsection