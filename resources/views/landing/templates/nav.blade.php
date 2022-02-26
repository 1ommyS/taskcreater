<div class="container-fluid mw-block">
  <nav class="navbar navbar-expand-xl navbar-light">
    <div class="container-fluid navbar-cont">
      <a class="navbar-brand" href="/"><img src="{{ asset("public/img/landing/logo.png") }}" class="logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">главное</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#courses">курсы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#reviews">отзывы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/#questions">вопросы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route("landing.blog") }}">блог</a>
          </li>
        </ul>
      </div>
    </div>
    <div style="display: inline-block;" class="second-navbar container-fluid">
      <button class="button-link nav-link " data-bs-toggle="modal" data-bs-target="#exampleModal"><img
          src="{{asset("public/img/landing/contact.png")}}" class="icon">связаться
      </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal"
           aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h2 class="modal-title" id="exampleModal"><img src="{{asset("public/img/landing/contact.png")}}"
                                                             width="35"> Связаться</h2>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <hr class="modal-line">
              <b>Вконтакте: </b><br><a href="http://vk.com/itpark32">http://vk.com/itpark32</a><br><br>
              <b>Instagram: </b><br><a href="http://instagram.com/itpark32">http://instagram.com/itpark32</a><br><br>
              <b>YouTube: </b><br><a href="http://youtube.com/channel/UC7I0U-xaj3ZRdmXHxfJHHKw">http://youtube.com/channel/UC7I0U-xaj3ZRdmXHxfJHHKw</a><br><br>
              <b>Телефон: </b> <a href="tel:89532819045" class="tel">+7 953 281 90 45</a>
            </div>
          </div>
        </div>
      </div>

      <a href="{{ route("login") }}" class="nav-link login-btn btn">
        <img src="{{asset("public/img/landing/user.png")}}" class="icon"> войти
      </a>
    </div>

  </nav>
</div>