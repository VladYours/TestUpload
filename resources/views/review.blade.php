@extends('layout')

@section('title')
Users Info
@endsection

@section('content')
    <form class="row text-center" method="POST">
        @csrf
        <div class="col">
            <a href="/upload" class="btn btn-secondary">TO UPLOAD</a>
            <button class="btn btn-primary mr-3" id="filter">FILTER</button>
            <button class="btn btn-success" id="export">EXPORT</button>
            <input type="hidden" value="0" name="export" id="checkExp"/>
        </div>
        
    @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
    
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">
              Category
              <select class="form-select"cat name="cat" aria-label="Category select">
                  <option value="all">All</option>
                  @foreach ($categories as $category)
                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                  @endforeach
                </select>
          </th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">
              Gender
              <select class="form-select" name="gender" aria-label="Gender select">
                  <option value="all">All</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
          </th>
          <th scope="col">
              Birth Date
              <div class="input-group">
                  <input type="date" class="form-control" id="bd" name="bd" placeholder="Date of Birth"><br/>
                  <span class="input-group-text">or</span>
                  <input type="number" class="form-control" id="age" name="age" placeholder="Age"><br/>
              </div>
              or <br/>
              <div class="input-group">
                  <span class="input-group-text">From</span> <input type="number" class="form-control" id="from" name="from" placeholder="From Age"> 
                  <span class="input-group-text">To</span> <input type="number" class="form-control" id="to" name="to" placeholder="To Age">
                </div>
          </th>
        </tr>
      </thead>
      <tbody>
          @foreach ($users as $user)
            <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>
                  {{ $user->category }}
              </td>
              <td>
                  {{ $user->fname }}
              </td>
              <td>
                  {{ $user->lname }}
              </td>
              <td>
                  {{ $user->email }}
              </td>
              <td>
                  {{ $user->gender }}
              </td>
              <td>
                  {{ $user->birthdate }}
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
    
    {{ $users->links() }}
    
    
    
    </form>

@endsection

@section('js')
<script>
    let form = document.querySelector('form');
    let filterb = document.querySelector('#filter');
    let exportb = document.querySelector('#export');
    let exportc = document.querySelector('#checkExp');
    exportb.onclick = function () {
        exportc.value = '1';
        form.submit();
    }
    filterb.onclick = function () {
        exportc.value = '0';
        form.submit();
    }
    
</script>
@endsection

