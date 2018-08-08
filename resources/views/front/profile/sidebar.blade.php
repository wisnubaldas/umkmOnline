<div class="col-sm-3">
    <div class="box box-solid">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" 
        src="{{ is_null($user->image) ? $user->nullphoto() : asset('img/user/'.$user->image) }}" 
        alt="User profile picture" style="margin-bottom: 15px">
        <button class="btn bg-orange btn-block gantiPhotoBtn"><b>Ganti Photo</b></button>
      </div>
    </div>
    <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Labels</h3>

          <div class="box-tools">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body no-padding">
          <ul class="nav nav-pills nav-stacked">
            <li class="{{ request()->segment(1) == 'profile' ? 'active' : '' }}">
              <a href="{{ url('profile') }}">
                <i class="fa fa-user"></i> 
                Profil
              </a>
            </li>
            <li class="{{ request()->segment(1) == 'change-password' ? 'active' : '' }}">
              <a href="{{ url('change-password') }}">
                <i class="fa fa-key"></i>
                Ganti Password
              </a>
            </li>
          </ul>
        </div>
    </div>
</div>