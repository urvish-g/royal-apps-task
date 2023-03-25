@extends('layouts.default')
@section('content')
  <div class="container py-5" id="">
    @if($errors->any())
      <div class="alert alert-info">{{$errors->first()}}</div>
    @endif

    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="">Author Details</h5>
        <div>
          @if(empty($details['books']))
            <a href="{{ route('auhtor.delete', $details['id']) }}" class="btn btn-sm btn-danger" title="Delete Author">
              <i class="fa fa-report">Delete Author</i>
            </a>
          @endif
        </div>
      </div>
      <div class="card-body">
        <h5 class="card-title"><b>Name : </b> {{ $details['first_name'] }} - {{ $details['last_name'] }}</h5>
        <p class="card-text"><b>Biography : </b>{{ $details['biography'] }}</p>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
      <h4 class="mt-4">Author Book lists</h4>
      <a href="{{ route('create.book') }}" class="btn btn-sm btn-success" title="View author book">
          <i class="fa fa-report">Create Book</i>
      </a>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ISBN</th>
          <th scope="col">Title</th>
          <th scope="col">Release Date</th>
          <th scope="col">Description</th>
          <th scope="col">Format</th>
          <th scope="col">Number of pages</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($details['books'] as $book)
          <tr>
            <th scope="row">{{ $book['id'] }}</th>
            <td>{{ $book['isbn'] }}</td>
            <td>{{ $book['title'] }}</td>
            <td>{{ $book['release_date'] }}</td>
            <td>{{ $book['description'] }}</td>
            <td>{{ $book['format'] }}</td>
            <td>{{ $book['number_of_pages'] }}</td>
            <td>
              <a href="{{ url('/book/' . $details['id'] . '/' . $book['id']) }}" class="btn btn-sm btn-success" title="View author book">
                <i class="fa fa-report">Delete</i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop
@push('after-scripts')
<script type="text/javascript">
</script>
@endpush



