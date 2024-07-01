<nav class="app-header navbar navbar-expand bg-body" wire:poll.keep-alive>
  <div class="container-fluid">
      <ul class="navbar-nav">
          <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
      </ul>
      <ul class="navbar-nav ms-auto">
          <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i class="bi bi-search"></i> </a> </li> <!--end::Navbar Search--> <!--begin::Messages Dropdown Menu-->
          <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">{{auth()->user()->unreadNotifications()->count()}}</span> </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span class="dropdown-item dropdown-header">{{auth()->user()->notifications()->count()}} Notifikasi</span>
                  <div class="dropdown-divider"></div>
                  @foreach (auth()->user()->notifications()->take(5)->get() as $row)
                  <a href="{{url('admin/transaction')}}" class="dropdown-item">
                    Ada pesanan baru #{{$row->data['transaction_id']}}
                    <span class="float-end text-secondary fs-7">{{$row->created_at->diffForHumans()}}</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  @endforeach
                  <a href="{{url('admin/transaction')}}" class="dropdown-item dropdown-footer">
                      See All Notifications
                  </a>
              </div>
          </li>
          <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
      </ul>
  </div>
</nav>
