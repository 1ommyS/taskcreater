<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->name }} </span>
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " href="/profile/mygroups" aria-current="page">Мои группы</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="/profile/" aria-current="page">Новая группа</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
        </li>
      </ul>
    </div>
  </div>
</nav>