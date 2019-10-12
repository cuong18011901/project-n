
<div class="head-panel d-flex pt-2 pb-2">
    @if (Route::has('login'))
        <div class="col-6 top-links" style="color: #477bc3;">
            <a href="/">mxh</a>
        </div>
        <div class="col-6 top-links" style="color: #477bc3; text-align: right">
        @auth
           <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
            <a href="{{ url('/home') }}">Home</a>
            <a href="{{ route('profile.index', Auth::user()->profile->id) }}">Profile</a>
            <a href="#" onclick="event.preventDefault; document.getElementById('logout-form').submit()">Logout</a>
            <form action="{{ route('logout') }}" id="logout-form" style="display: none;" method="post">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
        </div>
    @endif
</div>
