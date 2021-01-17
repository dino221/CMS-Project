@extends('layouts.admin')

@section('title') Kreirajte novu ulogu @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form  action="{{route('admin.roles.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="card-header p-0 mb-3">Stvorite novu ulogu</h3>
                                <div class="form-group">
                                    <label for="name">Naziv uloge</label>
                                    <input type="text" name="name" placeholder="Unesite naziv nove uloge" class="form-control"id="name">
                                </div>
                                <button class="btn btn-primary" type="submit">POTVRDI</button>
                                <a href="{{route('admin.roles.index')}}" class="btn btn-light" type="submit">POVRATAK</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
