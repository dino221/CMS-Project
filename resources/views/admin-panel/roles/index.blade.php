@extends('layouts.admin')

@section('title') Registered Roles  @endsection

@section('content') 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Pregled kreiranih uloga</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                @hasrole('admin')
                    <a class="btn btn-primary" href="{{route('admin.roles.create')}}">Nova uloga</a>
                @endhasrole
                <div class="table-responsive">
                    <table class="table">
                    <thead class=" text-primary">
                        <th>
                        ID
                        </th>
                        <th>
                        Naziv uloge
                        </th>
                        @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                        <th>Uredi</th>
                        @endif
                        @hasrole('admin')
                        <th >Obriši</th>
                        @endhasrole
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>
                                    <div class="d-flex align-center ">
                                        <span>{{$role->name}}</span>
                                    </div>
                                </td>
                                @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                                    <td><a class="btn btn-primary" href="{{route('admin.roles.edit', $role->id)}}">Uredi ulogu</a></td>
                                @endif
                                @hasrole('admin')
                                    <td >
                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                            {{method_field('DELETE')}}
                                            {{csrf_field()}}
                                            <button class="btn btn-light" type="submit">Obriši ulogu</button>
                                        </form>
                                    </td>
                                @endhasrole
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{$roles->links()}}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts') 

@endsection