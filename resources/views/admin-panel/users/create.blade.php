@extends('layouts.admin')

@section('title') Kreirajte  korisnika @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{route('admin.users.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="card-header p-0 mb-3">Kreirajte novog  korisnika</h3>
                                <div class="form-group">
                                    <label for="name">Ime</label>
                                    <input type="text" required name="name" placeholder="Unesite ime novog korisnika" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Telefon</label>
                                    <input type="text" name="phone"  class="form-control"  id="phone">
                                </div>
        
                                <div class="form-group">
                                    <label for="email"
                                        class=" col-form-label text-md-right">Email</label>
                                    <div class="">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

       
                                <div class="form-group ">
                                    <label for="password" class="col-form-label text-md-right">Lozinka</label>

                                    <div class="">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label for="password-confirm" class=" col-form-label text-md-right">Potvrdite lozinku</label>
                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                
                                <button class="btn btn-primary" type="submit">POTVRDI</button>
                                <a href="{{route('admin.users.index')}}" class="btn btn-light" type="submit">ODBACI</a>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-center flex-wrap">
                                    <strong class="d-block mb-3 w-100">Korisnička slika</strong>
                                    <img class="img-fluid mb-3" src="/uploads/avatars/defaultAvatar.jpg">
                                    <div class="d-block">
                                        <div class="custom-file">
                                            <input name="avatar" type="file" class="custom-file-input" id="avatarUpload">
                                            <label id="avatarUpload-label" class="custom-file-label"  for="customFile">Izaberite sliku - Avatar</label>
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
