<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      @if(auth()->user()->role == 'admin')
      <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}"><i class="bi bi-grid"></i><span>Dashboard</span></a></li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class='bx bxs-category'></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
            <li><a class="nav-link" href="{{route('user.index')}}"><i class="bi bi-circle"></i><span>User</span></a></li>
            <li><a class="nav-link" href="{{route('district.index')}}"><i class="bi bi-circle"></i><span>Kecamatan</span></a></li>
            <li><a class="nav-link" href="{{route('village.index')}}"><i class="bi bi-circle"></i><span>Desa</span></a></li>            
        </ul>
      </li>      
      @else      
      <li class="nav-item"><a class="nav-link" href="{{route('user')}}"><i class="bi bi-grid"></i><span>Dashboard</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('value.index')}}"><i class="bi bi-files"></i><span>Data</span></a></li>
      @endif        
      <li><a class="nav-link" href="{{route('formulir.index')}}"><i class="ri-collage-fill"></i><span>Formulir</span></a></li>      
    </ul>

  </aside>
