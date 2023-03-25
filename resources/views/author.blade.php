@extends('layouts.default')
@section('content')
  <div class="container py-5" id="">
    @if($errors->any())
      <div class="alert alert-info">{{$errors->first()}}</div>
    @endif
    <h4>Author lists</h4>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Birthday</th>
          <th scope="col">Gender</th>
          <th scope="col">Place Of Birth</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($authors as $author)
          <tr>
            <th scope="row">{{ $author['id'] }}</th>
            <td>{{ $author['first_name'] }}</td>
            <td>{{ $author['last_name'] }}</td>
            <td>{{ $author['birthday'] }}</td>
            <td>{{ $author['gender'] }}</td>
            <td>{{ $author['place_of_birth'] }} </td>
            <td>
              <a href="{{ route('author.books', $author['id']) }}"
                class="btn btn-sm btn-info"
                title="View author book">
                  <i class="fa fa-report">View Books</i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop



