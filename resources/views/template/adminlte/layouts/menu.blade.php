
<li class="nav-item">
  <a href="{{ url('/category') }}" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Category
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ url('/stock') }}" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      Stock
    </p>
  </a>
</li>
<li class="nav-item">
  <a href="{{ url('/product') }}" class="nav-link">
    <i class="nav-icon fas fa-th"></i>
    <p>
      product
    </p>
  </a>
</li>
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
  <i class="nav-icon fas fa-th"></i>
  <p>
    Transaksi
  <i class="right fas fa-angle-left"></i>
  </p>
  </a>
    <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/transaksi-out') }}" class="nav-link ">
        <i class="far fa-circle nav-icon"></i>
        <p>Keluar</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/transaksi-in') }}" class="nav-link ">
        <i class="far fa-circle nav-icon"></i>
        <p>Masuk</p>
      </a>
    </li>
    </ul>
</li>
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
  <i class="nav-icon fas fa-th"></i>
  <p>
    Monitoring
  <i class="right fas fa-angle-left"></i>
  </p>
  </a>
    <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ url('/monitoring-stok') }}" class="nav-link ">
        <i class="far fa-circle nav-icon"></i>
        <p>Stok</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ url('/monitoring-kas') }}" class="nav-link ">
        <i class="far fa-circle nav-icon"></i>
        <p>Kas</p>
      </a>
    </li>
    </ul>
</li>