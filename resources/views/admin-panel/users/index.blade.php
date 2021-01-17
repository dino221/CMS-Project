@extends('layouts.admin')

@section('title') Registered Roles  @endsection

@section('content') 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Registrirani korisnici</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                @hasrole('admin')
                    <a class="btn btn-primary" href="{{route('admin.users.create')}}">Novi korisnik</a>
                @endhasrole
                <div class="table-responsive">
                    <table class="table">
                    <thead class=" text-primary">
                        <th>
                        ID
                        </th>
                        <th>
                        Ime
                        </th>
                        <th>
                        Telefon
                        </th>
                        <th>
                        Email
                        </th>
                        <th>
                        Tip korisnika
                        </th>
                        @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                        <th>
                        Uredi
                        </th>
                        @endif
                        @hasrole('admin')
                        <th >
                        Obriši
                        </th>
                        @endhasrole
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>
                                    <div class="d-flex align-center ">
                                        <img class="img-fluid mr-2" src="/uploads/avatars/{{ $user->avatar }}" style="width:32px; height:32px; border-radius:50%">
                                        <span>{{$user->name}}</span>
                                    </div>
                                </td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ implode (', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                @if(Auth::user()->hasAnyRole('admin') || Auth::user()->hasAnyRole('editor'))
                                <td><a class="btn btn-primary" href="{{route('admin.users.edit', $user->id)}}">Uredi korisnika</a></td>
                                @endif
                                @hasrole('admin')
                                <td >
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <button class="btn btn-light" type="submit">Obriši korisnika</button>
                                    </form>
                                </td>
                                @endhasrole
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{$users->links()}}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts') 

@endsection