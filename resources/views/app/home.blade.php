@extends('layouts.app')

@section('content')
<main id="main" data-aos="fade-up">
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Home - Dashboard</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Dashboard</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <section class="inner-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            You are logged in!
                            <div class="d-block mt-2">
                                <a href="/admin-panel"><strong>Admin Panel</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection


