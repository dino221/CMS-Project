@extends('layouts.app')

@section('title')@if($page->title)Laravel - {!!$page->title!!}@endif{{""}}@endsection

@section('content')

<main id="main" data-aos="fade-up">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2 class="d-block">{{$page->title}}</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{$page->title}}</li>
                </ol>
            </div>
            <h5  class="d-block">{{$page->subtitle}}</h5>


        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
                {{$page->content}}
        </div>
    </section>

</main>

@endsection

@push('scripts')

@endpush
