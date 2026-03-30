<nav id="sidebar" class="d-md-block d-none">
    <div class="p-4 text-center">
        <h4><i class="fas fa-book-reader me-2"></i> LibAdmin</h4>
        <hr>
    </div>
    <ul class="nav flex-column mt-2">
        <li class="nav-item"><a href="{{ route('admin.index') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="fas fa-home me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('buku.index') }}" class="nav-link {{ request()->is('admin/buku*') ? 'active' : '' }}"><i class="fas fa-book me-2"></i> Data Buku</a></li>
        <li class="nav-item"><a href="{{ route('penulis.index') }}" class="nav-link {{ request()->is('admin/penulis*') ? 'active' : '' }}"><i class="fas fa-book me-2"></i> Data Penulis</a></li>
        <li class="nav-item"><a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('admin/kategori*') ? 'active' : '' }}"><i class="fas fa-book me-2"></i> Data Kategori</a></li>
        <li class="nav-item"><a href="{{ route('anggota.index') }}" class="nav-link"><i class="fas fa-users me-2"></i> Anggota</a></li>
        <li class="nav-item"><a href="{{ route('peminjaman.index') }}" class="nav-link"><i class="fas fa-exchange-alt me-2"></i> Transaksi</a></li>
        <li class="nav-item mt-5"><a href="{{ route('logout') }}" class="nav-link text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
    </ul>
</nav>