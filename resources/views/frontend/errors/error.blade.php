@extends('layouts.home')

@section('css')

@endsection

@section('content')
<!-- ============================ User Dashboard ================================== -->
<section class="error-wrap mt-5">
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-lg-6 col-md-10">
                <div class="text-center">
                    
                    <img src="{{ asset('assets/resido/img/404.png') }}" class="img-fluid" alt="">
                    <p>Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper</p>
                    <a class="btn btn-theme" href="{{ route('home') }}">Back To Home</a>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!-- ============================ User Dashboard End ================================== -->
@endsection

@section('js')

@endsection