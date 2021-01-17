@extends('layouts.admin')

@section('title') {{$user->name}} - Uloga korisnika @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{route('admin.users.update', ['user' => $user->id])}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="card-header p-0 mb-3">Uredite registriranog korisnika</h3>
                                <div class="form-group">
                                    <label for="name">Ime</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control"
                                        id="name">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefon</label>
                                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control"
                                        id="phone">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="{{$user->email}}" class="form-control"
                                        id="email">
                                </div>
                                @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                                <h5 class="card-header p-0 mb-2 mt-4">Uloge korisnika</h5>
                                <div class=" form-group">
                                    <div class="table-striped table-responsive">
                                        <table class="table">
                                            <tbody>
                                                @foreach($roles as $role)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <input class="form-check-input" name="roles[]" type="checkbox"  value="{{$role->id}}"
                                                                    {{ $user->hasAnyRole($role->name) ? 'checked' : ' ' }}>
                                                                <span class="form-check-sign"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-left">{{$role->name}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                                <button class="btn btn-primary" type="submit">POTVRDI</button>
                                @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                                <a href="{{route('admin.users.index')}}" class="btn btn-light" type="submit">ODBACI</a>
                                @else 
                                <a href="/admin-panel" class="btn btn-light" type="submit">ODBACI</a>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-center flex-wrap">
                                    <strong class="d-block mb-3 w-100">Korisnička slika</strong>
                                    @if($user->avatar)
                                        <img class="img-fluid mb-3" src="/uploads/avatars/{{ $user->avatar }}">
                                    @endif
                                    <div class="d-block">
                                        <div class="custom-file">
                                            <input name="avatar" accept="image/png, image/jpeg" type="file" class="custom-file-input" id="avatarUpload">
                                            <label id="avatarUpload-label" class="custom-file-label"  for="customFile">Izaberite sliku</label>
                                        </div>
                                    </div>
                                </div>
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
<script>
    $('input[type="file"]').change(function (e) {
        var fileName = e.target.files[0].name;
        $("#avatarUpload-label").text(fileName);
    });

</script>
@endsection
