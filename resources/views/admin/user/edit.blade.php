@extends('layout.base')
@section('main')
<section class="section">    
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title py-3">{{$data}}</h5>
                        
                        @if(Auth()->user()->role =='admin')
                        <form action="{{route('user.update', $user->id)}}" method="post">                               
                            @method('PUT')      
                        @else
                        <form action="{{route('userUpdate', $user->id)}}" method="post">                               
                        @endif
                            @csrf           

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-6">
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" id="inputText">
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>         
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-6">
                                <input type="email" name="email"  value="{{$user->email}}" class="form-control" id="inputText">
                                @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>   

                            @if(Auth()->user()->role =='admin')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Level</label>
                                <div class="col-sm-6">
                                    <select class="form-control select-field"  data-placeholder="Choose one thing" name="level" required>
                                        <option></option>
                                        @php $lev = ['admin','operator']; @endphp
                                        @for($i=0;$i < count($lev); $i++)
                                        <option value="{{$lev[$i]}}" {{($user->level == $lev[$i]) ? 'selected' : null}}>{{$lev[$i]}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-6">
                                <input type="password" name="password" class="form-control" id="inputText">
                                @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            </div>   
                                    
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Update</button>
                            @if(Auth()->user()->role =='admin')
                            <a class="btn btn-danger" href="{{route('user.index')}}">Back</a>
                            @endif
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
</script>
@endpush
@endsection