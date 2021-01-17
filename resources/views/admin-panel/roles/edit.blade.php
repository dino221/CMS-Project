@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{route('admin.roles.update', ['role' => $role->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="card-header p-0 mb-3">Uredite ulogu</h3>
                                <div class="form-group">
                                    <label for="name">Naziv uloge</label>
                                    <input type="text" placeholder="" required name="name" value="{{$role->name}}" class="form-control" id="name">
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
