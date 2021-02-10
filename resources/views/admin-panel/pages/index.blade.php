@extends('layouts.admin')

@section('title') Web Stranice  @endsection

@section('content') 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Pregled Web Stranica</h4>
                    @if (session('status'))
                        <div class="alert alert-success" page="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                @hasrole('admin')
                
                    <a class="btn btn-primary" href="{{route('admin.pages.create')}}">Nova stranica</a>
            
                @endhasrole
                <div class="table-responsive">
                    <table class="table">
                    <thead class=" text-primary">
                        <th>Naziv stranice</th>
                        @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                        <th>Uredi</th>
                        @endif
                        @hasrole('admin')
                        <th >Obriši</th>
                        @endhasrole
                        @hasrole('admin')
                        <th>Linkovi</th>
                        @endhasrole

                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>
                                    <div class="d-flex align-center ">
                                        <span>{{$page->title}}</span>
                                    </div>
                                </td>

                                    @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                                        <td><a class="btn btn-primary" href="{{route('admin.pages.edit', $page->id)}}">Uredi stranicu</a></td>
                                    @else
                                        <td></td>
                                    @endif

                                    @hasrole('admin')
                                    <td >
                                        <form action="{{ route('admin.pages.destroy', $page->id) }}" method="post">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <button class="btn btn-light" type="submit">Obriši stranicu</button>
                                            
                                        </form>
                                    </td>
                                    @endhasrole
                                    @hasrole('admin')
                                    <td>
                                    <div class>
                
                                    <ol class="nav-item">
                                        <a alt="home" title="links" target="_blank" class="nav-link" href="{{route('app.inner', [str_slug($page->slug), $page->id])}}">
                                            <i class="now-ui-icons business_globe"></i>
                                            <p>
                                                <span class="d-lg-none d-md-block">Homepage</span>
                                            </p>
                                        </a>
                                    </ol>
                                    @endhasrole 
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{$pages->links()}}<br>
                    
                </div>
                </div>
               
            
            </div>
        </div>
    </div>
@endsection

@section('scripts') 

@endsection

