@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-img">
                <img src="{{ asset('img/logo-alcaldia.png') }}" class="img-style">        
            </div>
            <div class="card-img-2">
                <img src="{{ asset('img/samat.png') }}" class="img-style-2">        
            </div>
        </div>      
        <div class="col-md-12">
            <div class="card-custom">
                <div class="card-header text-md-center"><h4>{{ __('Login') }}</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-5 col-form-label text-md-right"><h5><i>{{ __('Usuario') }}</i></h5></label>

                            <div class="form-group col-md-6 mb-3{{$errors->has('username' ? 'is_invalid' : '')}}">
                                <span class="input-group-addon"><i class="icon-user"></i></span>
                                <input type="text" value="{{ old('username') }}" name="username" id="username" class="form-control" placeholder="Usuario">
                                {!! 
                                  $errors->first('username', '<span class="invalid-feedback">:message</span>') 
                                !!} 
                            </div>                            
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-5 col-form-label text-md-right"><h5><i>{{ __('Password') }}</i></h5></label>
                            <div class="form-group col-md-6 mb-4{{$errors->has('password' ? 'is_invalid' : '')}}">
                                <span class="input-group-addon"><i class="icon-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                {!! 
                                    $errors->first('password', '<span class="invalid-feedback">:message</span>') 
                                !!}                 
                            </div>                            
                        </div>                                            

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 text-md-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>                               
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
