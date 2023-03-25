<!doctype html>
<html>
<head>
  <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
  <body>
    <div class="container py-5" id="">
      @if($errors->any())
        <div class="alert alert-info">{{$errors->first()}}</div>
      @endif
      <h4>Create new book</h4>
      <form method="post" action="{{ url('/book/create/process') }}">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
        </div>
        <div class="form-group">
          <label for="release_date">Release date</label>
          <input type="date" class="form-control" name="release_date" id="release_date" placeholder="Date" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" class="form-control" name="description" id="description" placeholder="Description" required>
        </div>
        <div class="form-group">
          <label for="isbn">ISBN</label>
          <input type="text" class="form-control" name="isbn" id="isbn" placeholder="isbn" required>
        </div>
        <div class="form-group">
          <label for="format">Format</label>
          <input type="text" class="form-control" name="format" id="format" placeholder="format" required>
        </div>
        <div class="form-group">
          <label for="page">Number Of Page</label>
          <input type="number" class="form-control" name="page" id="page" placeholder="number of page" required>
        </div>
        <label for="author">Select Author</label>
        <div class="input-group mb-3">
          <select class="custom-select" id="author" name="author">
            <option selected>Open this select author</option>
            @foreach($authors as $author)
              <option value="{{ $author['id'] }}">{{ $author['first_name'] }} - {{ $author['last_name'] }} </option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>