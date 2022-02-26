<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <span class="navbar-brand ">С возвращением, <br> {{ Auth::user() ->name}}</span>
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
    <div class="navbar-nav">

      <li class="nav-item dropdown">
        <a
          class="nav-link  nav-item"
          href="/profile"
          id="site"
          role="button"
          aria-expanded="false"
        >
          Студенты
        </a>
      </li>
      <li class="nav-item dropdown">
        <a
          class="nav-link  nav-item"
          href="/profile/teachers"
          id="site"
          role="button"
          aria-expanded="false"
        >
          Преподаватели
        </a>
      </li>

      <a href="/logout" class="nav-item nav-link" tabindex="-1">Выйти из аккаунта</a>
    </div>
  </div>
</nav>
