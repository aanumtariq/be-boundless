 <aside class="sidebar">
     <div class="scrollbar-inner">
         <div class="user">
             <div class="user__info" data-toggle="dropdown">
                 {{-- <img class="user__img" src="{{ asset('admin/demo/img/profile-pics/8.jpg') }}" alt=""> --}}
                 <img class="user__img" src="{{ asset('images/logo.png') }}" alt="">
                 <div>
                     <div class="user__name">{{ admin()->name }}</div>
                     <div class="user__email">{{ admin()->email }}</div>
                 </div>
             </div>

             <div class="dropdown-menu">
                 <a class="dropdown-item" href="javascript:void(0)"
                     onclick="$('#modal-changepassword').modal('toggle')">Change Password</a>
                 <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
             </div>
         </div>

        <ul class="navigation">
            <li class="navigation__{{ request()->is('admin/panel') ? 'active' : '' }}">
                <a href="{{ url('admin/panel') }}"><i class="zmdi zmdi-equalizer "></i>
                     Dashboard
                </a>
            </li>
            <li class="navigation__{{ request()->is('admin/config') ? 'active' : '' }}">
                <a href="{{ route('admin.config') }}"><i class="zmdi zmdi-settings zmdi-hc-fw"></i>
                     Config
                </a>
            </li>           
            <li class="{{ request()->is('admin/quries') ? 'navigation__active' : '' }}">
                <a href="\admin\quries"><i class="zmdi zmdi-quote zmdi-hc-fw"></i>
                    Contact Quries
                </a>
            </li>
            <li class="navigation__{{(request()->is('admin/packages'))?'active':''}}">
                <a href="\admin\packages"><i class="zmdi zmdi-map zmdi-hc-fw"></i>
                    Manage Packages
                </a>
            </li> 
            <li class="navigation__{{ request()->is('admin/Reservations') ? 'active' : '' }}">
                <a href="\admin\Reservations"><i class="zmdi zmdi-local-shipping zmdi-hc-fw"></i>
                    Reservations
                </a>
            </li>
            <li class="{{ request()->is('admin/FAQs') ? 'navigation__active' : '' }}">
                <a href="\admin\FAQs"><i class="zmdi zmdi-quote zmdi-hc-fw"></i>
                    Manage FAQ
                </a>
            </li>
            <li class="{{ request()->is('admin/manage-about') ? 'navigation__active' : '' }}">
                <a href="\admin\manage-about"><i class="zmdi zmdi-quote "></i>
                    Manage About
                </a>
            </li>
            <li class="navigation__{{ request()->is('admin/blogs') ? 'active' : '' }}">
                <a href="\admin\blogs"><i class="zmdi zmdi-blogger zmdi-hc-fw"></i>
                    Articals
                </a>
            </li>                        
            <li class="{{ request()->is('admin/studio') ? 'navigation__active' : '' }}">
                <a href="\admin\studio"><i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i>
                    Gallery Images
                </a>
            </li>                            
        </ul>
     </div>
 </aside>
 <div class="modal fade" id="modal-changepassword" tabindex="-1">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title pull-left">Change Password</h5>
             </div>
             <div class="modal-body">
                 <form class="row" method="POST" action="{{ route('admin.changepassword') }}">
                     @csrf
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="password" name="change_password" class="form-control"
                                 placeholder="New Password">
                             <i class="form-group__bar"></i>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="password" name="change_confirm_password" class="form-control"
                                 placeholder="Confirm Password">
                             <i class="form-group__bar"></i>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="form-group">
                             <input type="submit" class="btn btn-success" value="Confirm">
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
