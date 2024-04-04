@extends("shared/_layout")

@section('content')
<form action="{{route('user.update')}}" method="POST">
  <div class="form-group">
    <input type="hidden" name="user[id]" value="{{ $user->id }}">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="{{$user->name}}" disabled>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Company</label>
    <input type="text" class="company" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="{{$user->company}}" disabled>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Role</label>
    <select class="form-control" id="exampleFormControlSelect1">
      @foreach($roles as $role)
      <option value="{{ $role->id }} name='user[role_id]'">{{ $role->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

@section('content-scripts')
@endsection