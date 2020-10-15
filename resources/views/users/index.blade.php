@extends('layouts.app')


@section('content')



    <div class="card card-default">

        <div class="card-header">
            Users
        </div>

        <div class="card-body">
            
            @if ($users->count() > 0)
            @include('partials.errors')

            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>



                </thead>

                <tbody>
                    @foreach ($users as $user)

                    <tr>

                        <td>
                            {{-- <img src="{{ asset("storage/".$post->image) }}" alt="ds" width="120px" height="60px"> --}}
                            <img width="40px" height="40px" style="border-radius: 50%" src="{{ Gravatar::get($user->email) }}" alt="profilePicture">
                        </td>
                        <td>
                            {{  $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        @if (!$user->isAdmin())
                        <td>


                                <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-success btn-sm float-right">Make Admin</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('users.deleteUser', $user->id) }}" method="POST">
                                    @csrf
                                        <button type="submit" class="btn btn-danger btn-sm float-right">Delete User</button>
                                    </form>


                        </td>
                        @endif
                        <td></td>
                        <td></td>

                    </tr>

                    @endforeach
                </tbody>

            </table>
                @else




               <h3 class="text-center text-muted">No Users Available</h3>



            @endif

        </div>

    </div>

@endsection
