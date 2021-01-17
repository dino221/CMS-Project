@extends('layouts.admin')

@section('title') Kreirajte novu stranicu @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form enctype="multipart/form-data"  action="{{route('admin.pages.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="row justify-content-between">
                            <div class="col-md-6">
                                <h3 class="card-header p-0 mb-3">Kreirajte novu web stranicu</h3>

                                <div class="form-group">
                                    <label for="name">Naziv stranice</label>
                                    <input type="text" required name="title" placeholder="Unesite naziv nove stranice" class="form-control" id="name">
                                </div>

                                <div class="form-group">
                                    <label for="slug">Slug/Link</label>
                                    <input type="text" disabled name="slug"  class="form-control"id="slug">
                                </div>

                                <div class="form-group">
                                    <label for="subtitle">Podnaslov</label>
                                    <textarea type="text" rows="3" name="subtitle" placeholder="Unesite podnaslov" class="form-control"id="subtitle"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Sadržaj/Text</label>
                                    <textarea type="text" rows="6" name="content" placeholder="Unesite sadržaj" class="form-control"id="content"></textarea>
                                </div>

                                <button class="btn btn-primary" type="submit">POTVRDI</button>
                                <a href="{{route('admin.pages.index')}}" class="btn btn-light" type="submit">POVRATAK</a>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-center flex-wrap">
                                    <strong class="d-block mb-3 w-100">Naslovna fotografija</strong>
                                    <img id="upload-image" class=" img-fluid mb-3" src="/uploads/covers/blank.jpg">
                                    <div class="d-block">
                                        <div class="custom-file">
                                            <input name="cover" type="file" class="custom-file-input" id="coverUpload">
                                            <label id="coverUpload-label" class="custom-file-label"  for="customFile">Izaberite sliku</label>
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
        $("#upload-image").src(fileName);
    });

</script>
@endsection
