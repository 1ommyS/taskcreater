@extends("layouts.layout")
@section("title") О нас @endsection
@section("content")

  <header>
    @include('landing.templates.nav')
  </header>
  <section class="main-content">
    <section class="promo">
      <div class="container-fluid header-starter-content starter">
        <div class="row body-vector mw-block">
          <div class="col-12 promo-header text-center">
            <h1 class="piar-header">
              <p>Школа программирования</p>
              <p>для школьников от 13 лет</p>
              <p>и для взрослых от 18 лет</p>
            </h1>
          </div>
        </div>
        <div class="row mw-block">
          <div class="col-lg-6 col-sm-6 col-sm-12 col-12 promo-list ">
            <div class="mb-5">
              <p><h4 class="mb-4 promo-text">Школьникам даем<br>профессию программиста<br> до поступления в
                                             вуз</h4></p>
              <p><h4 class="promo-text">Взрослых трудоустраиваем<br> в IT компании</h4></p>
              <div class="promo-desktop">
                <!-- Тут вставляются курсы -->
                <h1 class="mt-5 text-left co">Сейчас идет<br>набор на курсы:</h1>
                <div class="promo-item text-left">
                  <img src="{{ asset("public/img/landing/web_light_blue.png") }}" alt="">
                  <div class="promo-item-text">
                    <label style="color: #61CFD6">HTML и CSS</label>
                    <label style="color: #fff">Верстка сайтов</label>
                  </div>
                </div>
                <div class="promo-item mt-4 text-left">
                  <img src="{{ asset("public/img/landing/web_more_image.png") }}" alt="">
                  <div class="promo-item-text">
                    <label style="color: #FFDA7A">PHP + MySQL</label>
                    <label style="color: #fff">Серверное<br>программирование</label>
                  </div>
                </div>
                <div class="promo-item mt-4 text-left">
                  <img src="{{ asset("public/img/landing/java.png") }}" alt="">
                  <div class="promo-item-text">
                    <label style="color: #FFB156">Java</label>
                    <label style="color: #fff">Обучение<br>с трудостройством</label>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6 col-sm-6 col-sm-12 col-12 mt-3 header-subtitle text-center">
            <h2 class="park-important">Самое важное об IT-ПАРК за 3 минуты!</h2>
            <iframe class="video-about-park mx-auto" src="https://www.youtube.com/embed/WKdDlPntAZw"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>

            <div class="promo-mobile pt-5 text-left">
              <!-- Тут вставляются курсы тоже -->
              <h1 class="mt-5 text-left co">Сейчас идет набор на курсы:</h1>
              <div class="promo-item text-left">
                <img src="{{ asset("public/img/landing/web_light_blue.png") }}" alt="">
                <div class="promo-item-text">
                  <label style="color: #61CFD6">HTML и CSS</label>
                  <label style="color: #fff">Верстка сайтов</label>
                </div>
              </div>
              <div class="promo-item mt-4 text-left">
                <img src="{{ asset("public/img/landing/web_more_image.png") }}" alt="">
                <div class="promo-item-text">
                  <label style="color: #FFDA7A">PHP + MySQL</label>
                  <label style="color: #fff">Серверное<br>программирование</label>
                </div>
              </div>
              <div class="promo-item mt-4 text-left">
                <img src="{{ asset("public/img/landing/java.png") }}" alt="">
                <div class="promo-item-text">
                  <label style="color: #FFB156">Java</label>
                  <label style="color: #fff">Обучение<br>с трудостройством</label>
                </div>
              </div>
            </div>

            <h1 class="promo-text first-lesson_announce ">Первое занятие
              <span
                style="color:#FD9207 !important;font-weight: 900;">бесплатно!</span></h1>
            <a href="#" class="btn btn-reg">Записаться на бесплатное занятие</a>
          </div>
        </div>
        <div class="row mw-block">
          <div class="cont">
            <div class="col-12">
              <h1
                class="title_second_screen ml-3 "
              >
                Курсы для школьников
              </h1>
            </div>
            <h1 class="age">13+</h1>
          </div>
        </div>
        <div class="row cards  cards-1 mw-block" style="" id="courses">
          <div class="html_css mt-5">
            <div class="title">
              <div class="row mt-5">
                <div class="col-6 card-image">
                  <img class="html_css-image"
                       src="{{ asset("public/img/landing/html_css.png") }}" alt="">
                </div>
                <div class="col-5 card-content">
                  <h1 class="stack web">HTML и CSS</h1>
                  <p class="web_more_information">Верстка сайтов</p>
                  <hr class="delimiter">

                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Научитесь верстать вместе <br> с нами лендинги,
                                             сайт-визитки <br> и
                                             корпоративные сайты.
                </p>
              </div>
              <div class="button">
                <a class="btn more-information" href="{{  route("landing.more.web") }}">Подробнее</a>
              </div>
            </div>

          </div>
          <div class="js mt-5">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image" src="{{ asset("public/img/landing/js.png") }}"
                       alt="">
                </div>
                <div class="col-6 card-content">
                  <h1 class="stack web">Javascript</h1>
                  <p class="web_more_information">Браузерное программирование</p>
                  <hr class="delimiter">

                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Научитесь вместе с нами "оживлять" ваши сайты,
                                             делать сложную
                                             анимацию,
                                             взаимодействовать с сервером
                </p>
              </div>
              <div class="button">
                <a href="{{ route("landing.more.js") }}"
                   class="btn more-information">Подробнее</a>
              </div>
            </div>

          </div>
          <div class="php mt-5">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image" src="{{ asset("public/img/landing/php.png") }}"
                       alt="">
                </div>
                <div class="col-6 card-content">
                  <h1 class="stack web">PHP и MYSQL</h1>
                  <p class="web_more_information">Серверное программирование</p>
                  <hr class="delimiter">
                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Создавайте свои интернет-<br>магазины и веб-сервисы
                  <br> вместе с нами!
                </p>
              </div>
              <div class="button">
                <a href="{{ route("landing.more.php") }}"
                   class="btn more-information">Подробнее</a>
              </div>
            </div>

          </div>
          <div class="react mt-5">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image"
                       src="{{ asset("public/img/landing/react.png") }}" alt="">
                </div>
                <div class="col-6 card-content">
                  <h3 class="stack web">React и Laravel</h3>
                  <p class="web_more_information">Фреймворки</p>
                  <hr class="delimiter">
                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Хотите программировать как <br> профессионал? Тогда
                                             этот курс для вас!
                  <br>
                </p>
              </div>
              <div class="button">
                <a href="{{ route("landing.more.react") }}" class="btn more-information">Подробнее</a>
              </div>
            </div>

          </div>
          <div class="mt-5 net">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image" src="{{ asset("public/img/landing/net.png") }}"
                       alt="">
                </div>
                <div class="col-6 card-content">
                  <h1 class="stack web">.NET C#</h1>
                  <p class="special_web_more_information">Разработка программ для бизнеса</p>
                  <hr class="delimiter">
                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">
                  Всегда было интересно, что происходит <br> при переводе денег с карты на
                  карту? <br> Станьте
                  разработчиком серьёзных программ для бизнеса!
                </p>
              </div>
              <div class="button">
                <a href="{{ route("landing.more.net") }}"
                   class="btn more-information">Подробнее</a>
              </div>
            </div>

          </div>
          <div class="mt-5 unity">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image"
                       src="{{ asset("public/img/landing/unity.png") }}" alt="">
                </div>
                <div class="col-6 card-content">
                  <h3 class="stack web">UNITY 3D</h3>
                  <p class="web_more_information">Разработка игр</p>
                  <hr class="delimiter">
                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Хотите доказать всем, что на играх <br> можно
                                             заработать? Станьте
                                             разработчиком игр вместе с нами!
                  <br>
                </p>
              </div>
              <div class="button">
                <a href="{{route("landing.more.unity")}}"
                   class="btn more-information">Подробнее</a>
              </div>
            </div>

          </div>
        </div>

      </div>
      <div class="learning_plan container-fluid">
        <div class="plan-content row mw-block steps-head">
          <h1 class="bold-title">План обучения</h1>
          <div class="row student_path-image">
            <div class="col-2">
            </div>
            <div class="col-6">
              <div class="first-step">
                <h2 class="medium-title">1. Начальный уровень</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Освоение базы программирования.</p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Участие и победы в конкурсах, олимпиадах, <br>
                                         соревнованиях по
                                         программированию,<br> небольшие проекты для личных целей.</p>
              </div>
              <div class="second-step">
                <h2 class="medium-title">2. Средний уровень</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Введение в промышленное программирование.</p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Большие проекты для личных целей, заработок <br> “карманных
                                         дел” с помощью
                                         разработки <br> лабораторных, курсовых проектов, <br>дипломов на заказ.</p>
              </div>
              <div class="third-step">
                <h2 class="medium-title">3.Углубленный уровень</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Углубление в промышленное программирование. </p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Участие в разработке крупных коммерческих проектов,<br>
                                         объединение в команды
                                         с
                                         другими <br> разработчиками для создания своих проектов.</p>
              </div>
              <div class="second-step">
                <h2 class="medium-title">4. Уровень по завершению обучения</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Оттачивание полученных навыков, самообразование,
                                         образование в ВУЗе. </p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Коммерческая разработка, участие в стартапах.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="starter container-fluid">
        <div class="row mw-block">
          <div class="cont">
            <div class="col-12">
              <h1
                class="title_second_screen"
              >
                Курсы для взрослых
              </h1>
              <h2 class="adult_subtitle">С трудоустройством</h2>
            </div>
            <h1 class="age_adult">18+</h1>
          </div>
        </div>
        <div class="row cards cards-2 mw-block ">
          <div class="web_adult mt-5">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image"
                       src="{{ asset("public/img/landing/html-css_image.png") }}" alt="">
                </div>
                <div class="col-6 card-content">
                  <h1 class="stack web">WEB</h1>
                  <p class="web_more_information">Браузерное
                                                  программирование</p>
                  <hr class="delimiter">
                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Научитесь вместе с нами "оживлять" ваши сайты,
                                             делать сложную
                                             анимацию,
                                             взаимодействовать с сервером
                </p>
              </div>
              <div class="button">
                <a class="btn more-information" href="{{  route("landing.more.web_adult") }}">Подробнее</a>
              </div>
            </div>

          </div>
          <div class="java mt-5">
            <div class="title">
              <div class="row mt-5">
                <div class="col-5 card-image">
                  <img class="html_css-image" src="{{ asset("public/img/landing/java.png") }}"
                       alt="">
                </div>
                <div class="col-6 card-content">
                  <h1 class="stack web">JAVA</h1>
                  <p class="web_more_information">Программирование</p>
                  <hr class="delimiter">
                </div>
              </div>
              <div class="content mt-1">
                <p class="stack_description">Идеальный вариант для тех, кто хочет <br> легко и
                                             быстро войти в IT
                                             !<br>
                                             С трудоустройством мы поможем!

                </p>
              </div>
              <div class="button">
                <a href="{{ route("landing.more.java") }}"
                   class="btn more-information">Подробнее</a>
              </div>
            </div>

          </div>
        </div>

      </div>
      <div class="learning_plan container-fluid" style="padding-bottom: 2rem !important">
        <div class="plan-content row mw-block steps-head">
          <h1 class="bold-title">План обучения</h1>
          <div class="row student_adult_path_image">
            <div class="col-2">
            </div>
            <div class="col-6">
              <div class="first-step">
                <h2 class="medium-title">1. Начальный уровень</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Освоение базы программирования.</p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Участие и победы в конкурсах, олимпиадах, <br>
                                         соревнованиях по
                                         программированию,<br> небольшие проекты для личных целей.</p>
              </div>
              <div class="second-step">
                <h2 class="medium-title">2. Средний уровень</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Введение в промышленное программирование.</p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Большие проекты для личных целей, заработок <br> “карманных
                                         дел” с помощью
                                         разработки <br> лабораторных, курсовых проектов, <br>дипломов на заказ.</p>
              </div>
              <div class="third-step">
                <h2 class="medium-title">3.Углубленный уровень</h2>
                <h4 class="small-title">Основная деятельность:</h4>
                <p class="small-content">Углубление в промышленное программирование. </p>
                <h4 class="small-title">Применение знаний:</h4>
                <p class="small-content">Участие в разработке крупных коммерческих проектов,<br>
                                         объединение в команды
                                         с
                                         другими <br> разработчиками для создания своих проектов.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="starter container-fluid">
        <div class="row cont mw-block">
          <div class="benefit__title-block">
            <h1
              class="benefits__title"
            >
              Наши преимущества:
            </h1>
          </div>
        </div>
        <div class="row mw-block">
          <div class="benefit__content">
            <div class="benefit_column">
              <p class="benefit__content-text">Если ученик не смог прийти на занятие - мы вышлем
                                               ему видеозапись
                                               урока</p>
              <p class="benefit__content-text"> Если у кого-то возник вопрос посреди ночи - мы
                                                поможем, в крайнем
                                                случае, помогут другие ученики</p>
              <p class="benefit__content-text">У нас действует система рейтинга, поэтому актив на
                                               занятиях или же
                                               выполнение ДЗ очень даже
                                               приветствуется и поощряется</p>
              <p class="benefit__content-text">80% практики и 20% теории - наша главная формула
                                               для успешного
                                               занятия</p>
              <p class="benefit__content-text"> Делать ДЗ выгоднее, чем не делать его :)</p>
            </div>
            <div class="benefit_column">
              <img class="student_image" src="{{ asset("public/img/landing/student_image.png") }}"
                   alt="">
            </div>
            <div class="benefit_column">
              <p class="benefit__content-text">Занятия ведут преподаватели практики, которые
                                               работают в IT-компаниях
                                               или занимаются фрилансом</p>

              <p class="benefit__content-text">Наши ученики являются победителями конкурсов и
                                               олимпиад!</p>

              <p class="benefit__content-text">Обучение идёт с нуля (даже если не математический
                                               склад ума)</p>

              <p class="benefit__content-text">Преподаватели полнейшие энтузиасты - им нравится
                                               преподавать, а
                                               ученикам нравится обучаться у этих
                                               людей- пожалуй одно из главных преимуществ нашей школы :).</p>

            </div>
          </div>
        </div>
      </div>

      </div>
      </div>
      <div class="learning_plan container-fluid" style="padding-bottom: 2rem !important">
        <div class="plan-content row mw-block teacher-head">
          <h1 class="bold-title">Наши преподаватели</h1>
        </div>
        <div class="row mw-block">
          <div class="teacher-cards">
            <div class="teacher-card">
              <div class="teacher-card-header">
                <div class="card-header-content">
                  <h2 class="teacher-name">Сергей, 28 лет</h2>
                  <h4 class="teacher-specialisation">веб разработчик, фрилансер, преподаватель
                    <br>
                                                     направления веб разработки в IT-ПАРКе
                  </h4>
                </div>


              </div>
              <div class="teacher-card-content">
                <div class="card-content-text"><p>
                    Привет. Меня зовут Сергей Тимофеев. И я фанат Веба. В настоящее время
                    являюсь действующим
                    преподавателем <b>в школе программирования ИТ-Парк</b>. Моя аудитория -
                    это и взрослые, и дети.
                  </p>
                  <p>
                    Стаж моей преподавательской деятельности в этом направлении 4 года.
                    В сфере програм-
                    мирования
                    я уже
                    <b>около 10 лет</b>. За это время успел опробовать и поработать по
                    различным <br>
                    направлениям
                    ит-сферы: <br><b>разработка прикладных программ, разработка экспертных
                                     систем, разработка сайтов
                      <br> и веб-сервисов, системное администрирование, разработка модулей
                                     на 1С под нужды
                                     бизнеса.</b>
                  </p>
                  <p>
                    Стек технологий, которыми я владею, использую в разработке и обучаю:
                    <b>HTML,CSS,JS,PHP
                       +
                       фреймворки</b>
                  </p>
                </div>
              </div>
              <img class="teacher-image" src="{{ asset("public/img/landing/teacher_image.png") }}"
                   alt="">

            </div>
          </div>
          <div class="teacher-cards">
            <div class="reverse-teacher-card text-right">
              <div class="teacher-card-header">
                <div class="reverse-card-header-content">
                  <h2 class="teacher-name">Сергей, 28 лет</h2>
                  <h4 class="teacher-specialisation">веб разработчик, фрилансер, преподаватель
                    <br>
                                                     направления веб разработки в IT-ПАРКе
                  </h4>
                </div>
              </div>
              <div class="teacher-card-content">
                <div class="reverse-card-content-text"><p>
                    Привет. Меня зовут Сергей Тимофеев. И я фанат Веба. В настоящее
                    время являюсь действующим

                    преподавателем <b>в школе программирования ИТ-Парк</b>. Моя
                    аудитория - это и взрослые, и
                    дети.
                  </p>
                  <p>
                    Стаж моей преподавательской деятельности <br> в этом направлении 4 года.
                    В сфере програм-
                    мирования я уже <b>около 10 лет</b>. За это время успел опробовать и
                    поработать по различным
                    направлениям
                    ит-сферы: <b>разработка прикладных программ,разработка
                                 экспертных систем, разработка
                                 сайтов
                                 и веб-сервисов, системное администрирование,
                                 разработка модулей на 1С под нужды
                                 бизнеса.</b>
                  </p>
                  <p>
                    Стек технологий, которыми я владею, использую в разработке и обучаю:
                    <b>HTML,CSS,JS,PHP
                       +
                       фреймворки</b>
                  </p>
                </div>
              </div>
              <img class="reverse-teacher-image"
                   src="{{ asset("public/img/landing/reverse_teacher_image.png") }}"
                   alt="">

            </div>
          </div>

          <div class="teacher-cards">
            <div class="teacher-card">
              <div class="teacher-card-header">
                <div class="card-header-content">
                  <h2 class="teacher-name">Сергей, 28 лет</h2>
                  <h4 class="teacher-specialisation">веб разработчик, фрилансер, преподаватель
                    <br>
                                                     направления веб разработки в IT-ПАРКе
                  </h4>
                </div>


              </div>
              <div class="teacher-card-content">
                <div class="card-content-text"><p>
                    Привет. Меня зовут Сергей Тимофеев. И я фанат Веба. В настоящее время
                    являюсь действующим
                    преподавателем <b>в школе программирования ИТ-Парк</b>. Моя аудитория -
                    это и взрослые, и дети.
                  </p>
                  <p>
                    Стаж моей преподавательской деятельности в этом направлении 4 года.
                    В сфере програм-
                    мирования
                    я уже
                    <b>около 10 лет</b>. За это время успел опробовать и поработать по
                    различным <br>
                    направлениям
                    ит-сферы: <br><b>разработка прикладных программ, разработка экспертных
                                     систем, разработка сайтов
                      <br> и веб-сервисов, системное администрирование, разработка модулей
                                     на 1С под нужды
                                     бизнеса.</b>
                  </p>
                  <p>
                    Стек технологий, которыми я владею, использую в разработке и обучаю:
                    <b>HTML,CSS,JS,PHP
                       +
                       фреймворки</b>
                  </p>
                </div>
              </div>
              <img class="teacher-image" src="{{ asset("public/img/landing/teacher_image.png") }}"
                   alt="">

            </div>
          </div>
          <div class="teacher-cards">
            <div class="reverse-teacher-card text-right">
              <div class="teacher-card-header">
                <div class="reverse-card-header-content">
                  <h2 class="teacher-name">Сергей, 28 лет</h2>
                  <h4 class="teacher-specialisation">веб разработчик, фрилансер, преподаватель
                    <br>
                                                     направления веб разработки в IT-ПАРКе
                  </h4>
                </div>
              </div>
              <div class="teacher-card-content">
                <div class="reverse-card-content-text"><p>
                    Привет. Меня зовут Сергей Тимофеев. И я фанат Веба. В настоящее
                    время являюсь действующим

                    преподавателем <b>в школе программирования ИТ-Парк</b>. Моя
                    аудитория - это и взрослые, и
                    дети.
                  </p>
                  <p>
                    Стаж моей преподавательской деятельности <br> в этом направлении 4 года.
                    В сфере програм-
                    мирования я уже <b>около 10 лет</b>. За это время успел опробовать и
                    поработать по различным
                    направлениям
                    ит-сферы: <b>разработка прикладных программ,разработка
                                 экспертных систем, разработка
                                 сайтов
                                 и веб-сервисов, системное администрирование,
                                 разработка модулей на 1С под нужды
                                 бизнеса.</b>
                  </p>
                  <p>
                    Стек технологий, которыми я владею, использую в разработке и обучаю:
                    <b>HTML,CSS,JS,PHP
                       +
                       фреймворки</b>
                  </p>
                </div>
              </div>
              <img class="reverse-teacher-image"
                   src="{{ asset("public/img/landing/reverse_teacher_image.png") }}"
                   alt="">

            </div>
          </div>
          <div class="teacher-cards">
            <div class="teacher-card">
              <div class="teacher-card-header">
                <div class="card-header-content">
                  <h2 class="teacher-name">Сергей, 28 лет</h2>
                  <h4 class="teacher-specialisation">веб разработчик, фрилансер, преподаватель
                    <br>
                                                     направления веб разработки в IT-ПАРКе
                  </h4>
                </div>


              </div>
              <div class="teacher-card-content">
                <div class="card-content-text"><p>
                    Привет. Меня зовут Сергей Тимофеев. И я фанат Веба. В настоящее время
                    являюсь действующим
                    преподавателем <b>в школе программирования ИТ-Парк</b>. Моя аудитория -
                    это и взрослые, и дети.
                  </p>
                  <p>
                    Стаж моей преподавательской деятельности в этом направлении 4 года.
                    В сфере програм-
                    мирования
                    я уже
                    <b>около 10 лет</b>. За это время успел опробовать и поработать по
                    различным <br>
                    направлениям
                    ит-сферы: <br><b>разработка прикладных программ, разработка экспертных
                                     систем, разработка сайтов
                      <br> и веб-сервисов, системное администрирование, разработка модулей
                                     на 1С под нужды
                                     бизнеса.</b>
                  </p>
                  <p>
                    Стек технологий, которыми я владею, использую в разработке и обучаю:
                    <b>HTML,CSS,JS,PHP
                       +
                       фреймворки</b>
                  </p>
                </div>
              </div>
              <img class="teacher-image" src="{{ asset("public/img/landing/teacher_image.png") }}"
                   alt="">

            </div>
          </div>
        </div>
      </div>
      <div class="starter container-fluid">
        <div class="row cont mw-block">
          <div class="examples__title-block">
            <h1
              class="examples__title"
            >
              Примеры работ <br> наших учеников:
            </h1>
          </div>
          <div class="row mw-block">
            <div class="examples_content">
              <div class="example_column">
                <h2 class="example__project-title">{{ $examples[$exampleFId]->title }}</h2>
                <h4 class="example__project-subtitle">Создан нашими учениками</h4>
                <div class="project__preview">
                  <iframe class="video" src="{{ $examples[$exampleFId]->imageUri }}" title="YouTube video player"
                          frameborder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowfullscreen></iframe>
                </div>
                <div class="project-description">
                  <p>{{ $examples[$exampleFId]->description }}</p>
                </div>
              </div>
              <div class="example_column">
                <h2 class="example__project-title">{{ $examples[$exampleSId]->title }}</h2>
                <h4 class="example__project-subtitle">Cоздан нашими учениками</h4>
                <div class="project__preview">
                  <iframe class="video" src="{{ $examples[$exampleSId]->imageUri }}" title="YouTube video player"
                          frameborder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                          allowfullscreen></iframe>
                </div>
                <div class="project-description">
                  <p>{{ $examples[$exampleSId]->description }}</p>
                </div>
              </div>
            </div>
            <div class="invitation">
              Хотите научиться создавать такие же и более крутые сайты? <a href="#"
                                                                           class="invitation-link">Присоединяйтесь!</a>
            </div>
            <div class="free-lesson-button">
              <a href="#" class="btn btn-reg">Записаться на бесплатное занятие</a>

            </div>
          </div>
        </div>
      </div>
      <div id="reviews" class="learning_plan container-fluid" style="padding-bottom: 2rem !important">
        <div class="plan-content row mw-block reviews-head">
          <h1 class="bold-title">Отзывы</h1>
        </div>
        <div class="row mw-block">
          <!--  -->
          <div id="carouselExampleControls" class="carousel slide carousel1" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="item-wrap">
                  <div class="review">
                    <div class="review-head">
                      <div class="cont"><h3>{{ $reviews[$firstId]->name }}</h3><br><a
                          href="{{ $reviews[$firstId]->vkUri }}">{{ $reviews[$firstId]->vkUri }}</a>
                      </div>
                    </div>
                    <p>{{ $reviews[$firstId]->description }}
                    </p>
                  </div>
                  <div class="review review-second">
                    <div class="review-head">
                      <div class="cont"><h3>{{ $reviews[$secondId]->name }}</h3><br><a
                          href="{{ $reviews[$secondId]->vkUri }}">{{ $reviews[$secondId]->vkUri }}</a>
                      </div>
                    </div>
                    <p>{{ $reviews[$secondId]->description }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="carousel-item ">
                <div class="item-wrap">
                  <div class="review">
                    <div class="review-head">
                      <div class="cont"><h3>{{ $reviews[$thirdId]->name }}</h3><br><a
                          href="{{ $reviews[$thirdId]->vkUri }}">{{ $reviews[$thirdId]->vkUri }}</a>
                      </div>
                    </div>
                    <p>{{ $reviews[$thirdId]->description }}
                    </p>
                  </div>
                  <div class="review review-second">
                    <div class="review-head">


                      <div class="cont"><h3>{{ $reviews[$fourthId]->name }}</h3><br><a
                          href="{{ $reviews[$fourthId]->vkUri }}">{{ $reviews[$fourthId]->vkUri }}</a>
                      </div>
                    </div>
                    <p>{{ $reviews[$fourthId]->description }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
              <span style="color:#4A3D9A;"><</span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
              <span style="color:#4A3D9A; ">></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <!-- adaptive carousel -->
          <div id="carouselExampleControls1" class="carousel slide carousel2" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="review">
                  <div class="review-head">
                    <div class="cont"><h3>{{ $reviews[$firstId]->name }}</h3><br><a
                        href="{{ $reviews[$firstId]->vkUri }}">{{ $reviews[$firstId]->vkUri }}</a>
                    </div>
                  </div>
                  <p>{{$reviews[$firstId]->description}}
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="review">
                  <div class="review-head">


                    <div class="cont"><h3>{{ $reviews[$secondId]->name }}</h3><br><a
                        href="{{ $reviews[$secondId]->vkUri }}">{{ $reviews[$secondId]->vkUri }}</a>
                    </div>
                  </div>
                  <p>{{ $reviews[$secondId]->description }}
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="review">
                  <div class="review-head">

                    <div class="cont"><h3>{{ $reviews[$thirdId]->name }}</h3><br><a
                        href="{{ $reviews[$thirdId]->vkUri }}">{{ $reviews[$thirdId]->vkUri }}</a>
                    </div>
                  </div>
                  <p>{{ $reviews[$thirdId]->description }}
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="review">
                  <div class="review-head">

                    <div class="cont"><h3>{{ $reviews[$fourthId]->name }}</h3><br><a
                        href="{{ $reviews[$fourthId]->vkUri }}">{{ $reviews[$fourthId]->vkUri }}</a>
                    </div>
                  </div>
                  <p>{{ $reviews[$fourthId]->description }}
                  </p>
                </div>

              </div>

            </div>
            <button class="carousel-control-prev" type="button"
                    data-bs-target="#carouselExampleControls1"
                    data-bs-slide="prev">
              <span style="color:#4A3D9A; "><</span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button"
                    data-bs-target="#carouselExampleControls1"
                    data-bs-slide="next">
              <span style="color:#4A3D9A;">></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <!--  -->
        </div>
      </div>
      <div class="starter container-fluid" id="questions">
        <div class="row examples__title-block mw-block">
          <h1
            class="examples__title"
          >Вопросы и ответы (текст):
          </h1>
        </div>
        <div class="row mw-block accordion-wrap">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false"
                        aria-controls="collapseTwo">
                  Есть ли офлайн занятия?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse"
                   aria-labelledby="headingTwo"
                   data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid aspernatur
                  laudantium inventore
                  praesentium nemo nihil blanditiis eius tempora facilis, recusandae soluta
                  dolorum mollitia
                  provident architecto sit! Fuga deserunt odit magni?
                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample4">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseFour" aria-expanded="false"
                        aria-controls="collapseFour">
                  Что я получу в итоге и будет ли сертификат по окончании курсов ?
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse"
                   aria-labelledby="headingFour"
                   data-bs-parent="#accordionExample4">
                <div class="accordion-body">
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus
                  doloremque incidunt neque
                  porro veritatis. Debitis dignissimos dolore, dolores harum incidunt magnam
                  officiis, provident,
                  quaerat quis quos rerum sunt voluptas voluptatem. Adipisci amet dicta
                  excepturi possimus quam quas
                  quis voluptates? Sint?
                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample2">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false"
                        aria-controls="collapseThree">
                  Сколько вы уже существуете?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse"
                   aria-labelledby="headingThree"
                   data-bs-parent="#accordionExample2">
                <div class="accordion-body">
                  Мы занимаемся обучением уже больше 8-ми лет. За это время мы успешно обучили
                  и выпустили свыше 500
                  студентов. Разработкой занимаемся больше 12 лет. К текущему моменту на нашем
                  счету свыше 1000
                  успешно реализованных мелких и крупных проектов.

                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample5">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseFive" aria-expanded="false"
                        aria-controls="collapseFive">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseFive" class="accordion-collapse collapse"
                   aria-labelledby="headingFive"
                   data-bs-parent="#accordionExample5">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>
          {{------------------------}}
          <div class="accordion" id="accordionExample6">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseSix" aria-expanded="false"
                        aria-controls="collapseSix">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseSix" class="accordion-collapse collapse"
                   aria-labelledby="headingSix"
                   data-bs-parent="#accordionExample6">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample7">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseSeven" aria-expanded="false"
                        aria-controls="collapseSeven">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseSeven" class="accordion-collapse collapse"
                   aria-labelledby="headingSeven"
                   data-bs-parent="#accordionExample7">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample8">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseEight" aria-expanded="false"
                        aria-controls="collapseEight">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseEight" class="accordion-collapse collapse"
                   aria-labelledby="headingFive"
                   data-bs-parent="#accordionExample8">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample9">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseNine" aria-expanded="false"
                        aria-controls="collapseNine">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseNine" class="accordion-collapse collapse"
                   aria-labelledby="headingNine"
                   data-bs-parent="#accordionExample9">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample10">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseTen" aria-expanded="false"
                        aria-controls="collapseTen">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseTen" class="accordion-collapse collapse"
                   aria-labelledby="headingTen"
                   data-bs-parent="#accordionExample10">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>
          <div class="accordion" id="accordionExample11">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingEleven">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseEleven" aria-expanded="false"
                        aria-controls="collapseEleven">
                  Способ оплаты?
                </button>
              </h2>
              <div id="collapseEleven" class="accordion-collapse collapse"
                   aria-labelledby="headingEleven"
                   data-bs-parent="#accordionExample11">
                <div class="accordion-body">
                  Для оплаты занятий с помощью банковской карты на странице личного Для оплаты
                  занятий с помощью
                  банковской карты на странице личного кабинета необходимо нажать кнопку
                  Пополнить баланс. Оплата
                  происходит через ПАО СБЕРБАНК с использованием банковских карт следующих
                  платежных систем:
                  <br>
                  <b>МИР;</b> <br>
                  <b>VISA International;</b> <br>
                  <b>Mastercard WorldWide;</b> <br>
                  Для оплаты (ввода реквизитов Вашей карты) Вы будете перенаправлены на
                  платежный шлюз ПАО СБЕРБАНК.
                  Соединение с платежным шлюзом и передача информации осуществляется в
                  защищенном режиме с
                  использованием протокола шифрования SSL. В случае если Ваш банк поддерживает
                  технологию
                  безопасного проведения интернет-платежей Verified By Visa, MasterCard
                  SecureCode, MIR Accept,
                  J-Secure для проведения платежа также может потребоваться ввод специального
                  пароля. Настоящий сайт
                  поддерживает 256-битное шифрование. Конфиденциальность сообщаемой
                  персональной информации
                  обеспечивается ПАО СБЕРБАНК. Введенная информация не будет предоставлена
                  третьим лицам за
                  исключением случаев, предусмотренных законодательством РФ. Проведение
                  платежей по банковским
                  картам осуществляется в строгом соответствии с требованиями платежных систем
                  МИР, Visa Int.,
                  MasterCard Europe Sprl, JCB.

                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row mw-block">
          <h3 class="mt-3 mb-3 examples__title question-video question-video-mobile">Вопросы и ответы (видео):</h3>
          <div class="video-resp">
            <iframe src="https://www.youtube.com/embed/RdDq_J6W7BI" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </section>
  </section>
  <footer>
    <div class="starter starter-footer container-fluid">
      <div class="row mw-block row-pad">
        <div class="feedback mt-4">
          <form method="POST">
            @csrf
            <div class="row">
              <div class="feedback-left col-md-6 col-12">
                <h2>Обратная связь</h2>
                <span class="span-question">Остались вопросы?<br><span
                    style="color: #FD9207 !important;">Напиши нам!</span></span><br>

                <button type="submit" class="btn-question btn-question-desktop" id="submit_button">Задать вопрос
                </button>
              </div>
              <div class="feedback-right col-md-6 col-12 text-left">
                <input type="email" placeholder="E-mail" required name="email" id="emailField"><br>
                <input type="text" placeholder="ФИО" required name="name" id="nameField"><br>
                <label>Ваш вопрос</label><br>
                <textarea name="question" required id="questionField"></textarea>
                <div class="d-flex">
                  <button type="submit" class="btn-question btn-question-mobile">Задать вопрос</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row mw-block">
        <div class="contacts col-12 mt-5 mb-5">
          <div class="row">
            <div class="col-sm-6"><b>Время работы:</b> пн-вск с 9:00 до 22:00<br><br>
              <b>Телефон:</b> +7 (953) 281-90-45<br><br>
              <b>Мы в соцсетях:</b>
              <div class="icons">
                <a href="#"><img src="{{ asset("public/img/landing/vk.png") }}" alt=""></a>
                <a href="#"><img src="{{ asset("public/img/landing/instagram.png") }}" alt=""></a>
                <a href="#"><img src="{{ asset("public/img/landing/youtube.png") }}" alt=""></a>
              </div>
            </div>
            <div class="col-sm-6 col-12 info-org">
              <b>ИП</b> Смыслов Алексей Михайлович<br>
              <b>ОГРНИП:</b> 318325600036243 <br><br>

              <b>ИНН:</b> 325502986267 <br>
              <b>Дата присвоения ОГРНИП:</b> 06.07.2018</br><br>

              <b>e-mail: </b>a.m.smyslov@yandex.ru
              <br>
                        © IT-ПАРК, 2021
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    const element = document.querySelector("#submit_button");
    element.addEventListener("click", e => {
      e.preventDefault();
      const email = document.querySelector("#emailField").value;
      const name = document.querySelector("#nameField").value;
      const question = document.querySelector("#questionField").value;
      fetch('/', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'url': '/payment',
          "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
        body: JSON.stringify({email, name, question})
      })
      alert("Сообщение успешно отправлено!")
    })
  </script>
@endsection
