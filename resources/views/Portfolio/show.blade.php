@extends('layouts/app')
@section('head')
<link href="{{asset('css/show_portfolio.css')}}" rel='stylesheet'>
@endsection
@section('content')
<h3 text='Portfólio'></h3>

<div class="jumbotron " id='jumbotron'>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Portfólio
                </h3>
                <p>
                    <a href='{{$portfolio->link}}'>{{$portfolio->link}}</a>
                </p>
                @can('editPortfolioCheck', $portfolio)
                <div class='col-md-12' id='editar'>
                    <form action="{{route('portfolios.edit',['portfolio' => $portfolio->id])}}" method="GET"> 
                    <button type="submit" class="btn btn-secondary" >Editar Portfólio</button>
                    </form>
                </div>
                @endcan
        </div>
            </div>
        </div>
    </div>
</div>
@endsection