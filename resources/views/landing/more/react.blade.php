@extends("layouts.layout")
@section("title") React и Laravel @endsection
@section("content")

  <header>
    @include('landing.templates.nav')
  </header>
  <section>
    <section class="starter sect">
      <div class="container-fluid mw-block">
        <div class="row body-vector container-fluid">
          <div class="body-line"></div>
          <div class="row mt-5 marker">
            <img class="more_information_image" src="{{ asset("public/img/landing/react_more.png") }}" alt="">
            <div class="title-content">
              <h1 class="stack_title">React и Laravel</h1>
              <h2 class="stack_subtitle">Фреймворки</h2>
            </div>
          </div>
          <div class="information-text">
            <h1> Хотите программировать как профессионал? Тогда
                 этот курс для вас!
            </h1>
          </div>
          <p class="lesson-time mt-5">
            Занятия проходят 2 раза в неделю по 2 часа в онлайн формате через <b>Discord</b>.
            <br>
            <span class="time_description">(Удобное для всех учеников расписание согласовывается отдельно с каждой группой)</span>
          </p>

        </div>
      </div>
      <div class="format more">
        <div class="container-fluid mw-block">
          <div class="row marker body-vector container-fluid">
            <h1 class="format_lessons_title" style="padding-top: 1rem !important;">Формат занятий:</h1>
            <div style="padding-bottom: 1rem !important" class="row format-space-between">
              <div class="col-lg-4">
                <p class="information-lessons">
                  Каждый урок записываем на видео <br> и присылаем ученику <br> видеозапись урока <br>
                  Поддерживаем учеников 24/7 <br> через беседу <b>ВКонтакте</b>
                </p>
              </div>
              <div class="col-1"></div>
              <div class="col-lg-4">
                <p class="information-lessons">
                  Занимаемся небольшими <br> группами по 10-15 человек, <br> чтобы уделить максимум внимания <br>
                  каждому
                  из наших учеников.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="information container-fluid mw-block">
        <div class="row body-vector container-fluid">
          <div class="body-line"></div>
          <h1 class="learning-time">Срок обучения:</h1>
          <h2 class="month_amount">3-4 месяца</h2>
          <div class="mt-4">
            <h1 class="learning-time">Программа обучения:</h1>
            <div class="mt-2">
              <a class="programm-link"
                 href="https://docs.google.com/document/d/1eWKL_yeCR6Rs8uCmkW9wqZUZreO5EfaUS5Hxv63JR4">
                Перейти
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="format-medium more">
        <div class="container-fluid mw-block">
          <div class="information body-vector marker row container-fluid">
            <h1 class="format_lessons_title" style="padding-top: 15px;">Стоимость занятий: </h1>
            <div class="row format-space-between">
              <div class="col-lg-4">
                <p class="information-lessons">
                  <b>550р./занятие</b> - если ученик, пришёл без <br> выполненного домашнего задания
                </p>
              </div>
              <div class="col-1"></div>
              <div class="col-lg-4">
                <p class="information-lessons">
                  <b>500р./занятие</b> - домашнее задание <br> было выполнено.
                </p>
              </div>
              <div class="homework-bonus_information mt-2">
                <p>
                <h2 class="homework-bonus">Домашние задания делать выгодно :)</h2>
                </p>
                <p style="margin-top: 2rem !important;">
                <h2 class="homework-bonus-bold">При единовременной оплате за несколько занятий есть бонусы!</h2>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid mw-block" style="padding-bottom: 50px">
        <div class="body-vector row container-fluid">
          <div class="order-button">
            <h1 class="promo-text first-lesson_announce ">Первое занятие
              <span
                style="color:#FD9207 !important;font-weight: 900;">бесплатно!</span></h1>
            <a href="#" class="btn btn-reg">Записаться на бесплатное занятие</a>
          </div>
        </div>
      </div>

    </section>
  </section>
  <!-- <footer></footer> -->
@endsection
