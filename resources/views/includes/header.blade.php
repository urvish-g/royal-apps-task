<div class="navbar w-100">
   <div class="w-100 navbar-inner d-flex justify-content-between">
        <div>
            @if(Session::has('first_name'))
                <div class="alert alert-info">
                    <p class="m-0">{{ Session::get('first_name')}} {{ Session::get('last_name')}} </p>
                </div>
            @endif
        </div>
        <div class="alert alert-danger">
            <a id="logo" href="/logout">Logout</a>
        </div>
   </div>
</div>