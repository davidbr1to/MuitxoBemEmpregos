@extends('layouts/app')
@section('head')
@endsection
@section('content')


<div class="jumbotron " id='jumbotron'>
    <div>
        <form action="{{route('portfolios.store', $candidato->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for='link' class="col-md-3 col-form-label">Link</label>
                <div class="col-md-6">
                    <input type='text' class="form-control @error('link') is-invalid @enderror" placeholder = "Digite o link do seu Portfólio" name='link' id='link'/>    
                    @error('link')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-1">
                <button type='submit' class="btn btn-primary" >Finalizar</button>
            </div>
        </form>
    </div>
</div>
    @endsection