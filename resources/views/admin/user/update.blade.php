@extends("shared/_layout")

@section('content')
<form action="{{route('user.update')}}" method="POST">
  @csrf
  <div class="form-group">
    <input type="hidden" name="user[id]" value="{{ $user->id }}">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name" value="{{ $user->name }}" disabled>
  </div>
  <div class="form-group">
    <label for="exampleInputCompany">Email</label>
    <input type="email" class="form-control" id="exampleInputCompany" aria-describedby="emailHelp" placeholder="" value="{{ $user->email }}" disabled>
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Role</label>
    <select class="form-control" id="exampleFormControlSelect1" name="user[role_id]">
      @foreach($roles as $role)
      <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection

@section('content-scripts')
@endsection