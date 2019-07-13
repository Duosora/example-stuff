@extends('layouts.main')
@section('content')
<!-- ========================================== ALL Users Leaderboard PAGE ============================ -->
<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12">
            <h3 class="col-md-12 pb-2">Leaderboard</h3>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Name</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>
            @foreach($Users->sortByDesc('Points') as $User)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td> 
                        <a href="{{ url('users') }}/{{ $User->name }}">
                            <img style="height: 25px;" class="lazy"
                            data-src="{!! asset(Voyager::image( $User->avatar )) !!}" alt="{{ $User->name }}">
                        </a>
                    </td>
                    <td>{{ $User->name }}</td>
                    <td>{{ COUNT($User->Points) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================== ALL Users Leaderboard PAGE ============================ -->
@endsection
