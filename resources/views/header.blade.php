<a href="{{route('admin.login')}}"> Admin</a>
@if(Auth::check())
<a href="{{route('admin.logout')}}"> logout</a>
 @endif
