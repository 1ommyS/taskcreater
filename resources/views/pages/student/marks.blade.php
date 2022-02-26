@extends('layouts.spec')

@section('title')Профиль ученика @endsection

@section('content')

  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <style>

        .progress-wrap {
            margin: 100px;
            width: 1000px;
            display: flex;
        }

        .progress-block {
            height: 50px;
            display: flex;
            border: 1px solid darkgray;
            box-shadow: 0 0 4px darkgray;
            margin-right: 4px;
        }

        .progress-block:after, .progress-block:before {
            position: absolute;
            top: -70%;
        }

        .progress-begginer {
            width: 15%;
            position: relative;
        }

        .progress-block:before {
            position: absolute;
            top: -70%;
        }

        .progress-block:after {
            position: absolute;
            top: -70%;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .progress-begginer:before {
            content: 'BG';
            left: -4%;
        }

        .progress-begginer:after {
            content: 'BG+ (75)';
        }

        .progress-junior {
            width: 20%;
            position: relative;
        }

        .progress-junior:before {
            content: 'JD (150)';
            left: -4%;
        }

        .progress-junior:after {
            content: 'JD+ (250)';
        }

        .progress-middle {
            width: 25%;
            position: relative;
        }

        .progress-middle:before {
            content: 'MD (350)';
            left: -4%;
        }

        .progress-middle:after {
            content: 'MD+ (475)';
        }

        .progress-senior {
            width: 30%;
            position: relative;
        }

        .progress-senior:before {
            content: 'SD (600)';
            left: -4%;
        }

        .progress-senior:after {
            content: 'SD+ (750)';
        }

        .progress-team-lead {
            width: 10%;
            position: relative;
        }

        .progress-team-lead:before {
            content: 'TL (900)';
            left: -10%;
        }
    </style>

    <div class="container-fluid">
      <span class="navbar-brand">С возвращением, <br> {{ Auth::user()->login }} </span>
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
      <input type="hidden" id="e_id" value="{{$id}}">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="/profile/" aria-current="page">Мои группы</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profile/rating">Рейтинг всех учеников</a>
          </li>
          @if (Auth::user()->role_id == 2)
            <li class="nav-item">
              <a class="nav-link" href="/profile/wages" aria-current="page">Зарплата</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" href="/profile/settings">Персональные данные</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://vk.com/1ommy" tabindex="-1" target="_blank">Сообщить о
                                                                                          проблеме
                                                                                          разработчику</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/logout" tabindex="-1">Выйти из аккаунта</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-2 table-responsive" style="padding:10px; display: block !important;">
    <div class="dashboard text-center">
      <div class="m-2">
        <a onclick="history.back()" class="btn-sm btn-data"
           style="color:white;border:1px solid #eee;padding-left:20px;padding-right:20px"> <i
            style="cursor: pointer" class="fa fa-arrow-left"
            aria-hidden="true"></i>Назад</a></div>
      <form method="POST" class="form">
        @csrf
        <div class="form-control">
          <label for="start">С какого дня: </label>
          <input type="date" id="start"
                 value="{{ isset($start) ? \Carbon\Carbon::parse($start)->format("Y-m-d") : date("Y-m-d") }}"
                 name="day_start"
                 style="width:150px">
        </div>
        <br>
        <div class="form-control">
          <label for="finish">По какой день: </label>
          <input type="date" id="finish" value="{{ isset($finish) ? $finish : date("Y-m-d") }}"
                 name="day_finish"
                 style="width:150px">
        </div>
        <div class="form__submit">
          <button type="submit" class="btn btn-data text-center mt-2">Получить данные</button>
        </div>
        @if(session("message"))
          <h1>{{session("message")}}</h1>
        @endif
        @if(Auth::user()->role_id != 1)
          <div class="mt-2">
            <a id="clear" href="{{$id}}/clear" class="text-center btn btn-data">Удалить все данные об
                                                                                активности учеников</a>
          </div>
        @endif
      </form>
    </div>
    <script>
      const element = document.querySelector("#clear");
      element.addEventListener("click", (e) => {
        e.preventDefault();
        if (confirm("Вы точно хотите удалить данные об активности учеников?")) {
          fetch("/profile/marks/{{$id}}/clear");
          window.location.reload();
        }
      })
    </script>
    <div class="accordion" id="accordionExample">
      <div class="accordion-item ">
        <h2 class="accordion-header" id="headingFour">
          <button
            class="accordion-button collapsed"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#collapseFour"
            aria-expanded="false"
            aria-controls="collapseFour"
          >
            Личные достижения каждого ученика
          </button>
        </h2>
        <div
          id="collapseFour"
          class="accordion-collapse collapse"
          aria-labelledby="headingFour"
          data-mdb-parent="#accordionExample"
        >
          <div class="accordion-body">
            @if (empty($achievements['names']))
              <h2>Данных нет</h2>
            @else
              @foreach ($achievements["names"] as $k => $name)
                <div class="accordion accordion-flush text-center" id="accordionFlushExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-heading{{($k+10)}}">
                      <button
                        class="accordion-button collapsed"
                        type="button"
                        id="collapseBlock{{$k}}"
                        data-mdb-toggle="collapse"
                        data-mdb-target="#flush-collapse{{($k+10)}}"
                        aria-expanded="false"
                        aria-controls="flush-collapse{{($k+10)}}"
                      >
                        {{$name}}
                      </button>
                    </h2>
                    <div
                      id="flush-collapse{{($k+10) ?? 1505}}"
                      class="accordion-collapse collapse"
                      aria-labelledby="flush-heading{{($k+10) ?? 1505}}"
                      data-mdb-parent="#accordionFlushExample"
                    >
                      <div class="accordion-body">
                        <div class="alert alert-success">
                          <h1>Легенда</h1>
                          <div style="text-align:left">
                            <p style="font-size: 16px;">Beginner (BG) - начинающий программист hello world - наше
                                                        всё</p>
                            <p style="font-size: 16px;">Beginner+ (BG+) - знает циклы массивы и условия способен писать
                                                        простые игрушки и алгоритмы</p>
                            <p style="font-size: 16px;">Junior developer (JD) - понимает классы, средние по сложности
                                                        алгоритмы, умеет работать с GUI</p>
                            <p style="font-size: 16px;">Junior developer+ (JD+) - понимает сложную архитектуру классов,
                                                        умеет создавать сложные GUI</p>
                            <p style="font-size: 16px;">Middle developer (MD) - знает и понимает способы хранения данных
                                                        в
                                                        базу данных или её аналоги + включает в себя все остальные
                                                        уровни</p>
                            <p style="font-size: 16px;">Middle developer+ (MD+) - знает и понимает способы разделения
                                                        приложения/сайта на front и back, умеет создавать обе части
                                                        приложения/сайта</p>
                            <p style="font-size: 16px;">Senior developer (SD) - знает и понимает предыдущие уровни
                                                        учиться
                                                        работать на фреймворках</p>
                            <p style="font-size: 16px;">Senior developer+ (SD+) - на хорошем уровне владеет выбранным
                                                        фреймворком, знает и понимает сложные алгоритмы и архитектуру
                                                        приложения/сайта</p>
                            <p style="font-size: 16px;">Team Lead (TL) - способен писать высококачественный код со
                                                        сложной
                                                        архитектурой с использованием фреймворков, а так же ставить
                                                        задачи
                                                        себе и другим, вести процесс разработки сложного
                                                        приложения/сайта</p>
                          </div>
                        </div>
                        <div>
                          @if ($achievements["progress"][$k] >= 0 && $achievements["progress"][$k] <75)
                            <h1>BEGINNER
                                DEV
                                ({{$achievements["progress"][$k]}})</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 75 && $achievements["progress"][$k] < 150)
                            <h1>BEGINNER+ DEVELOPER
                                ({{$achievements["progress"][$k]}})</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 150 && $achievements["progress"][$k] < 250)
                            <h1 style="font-size: 50px ; font-weight: bold;">JUNIOR
                                                                             DEV
                                                                             ({{$achievements["progress"][$k]}}
                                                                             )</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 250 && $achievements["progress"][$k] < 350)
                            <h1>JUNIOR+ DEVELOPER
                                ({{$achievements["progress"][$k]}})</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 350 && $achievements["progress"][$k] < 475)
                            <h1 style="font-size: 50px ; font-weight: bold;">MIDDLE
                                                                             DEV
                                                                             ({{$achievements["progress"][$k]}}
                                                                             )</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 475 && $achievements["progress"][$k] < 600)
                            <h1 style="font-size: 50px ; font-weight: bold;">MIDDLE+ DEV.

                                                                             ({{$achievements["progress"][$k]}}
                                                                             )</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 600 && $achievements["progress"][$k] < 750)
                            <h1 style="font-size: 50px ; font-weight: bold;">SENIOR
                                                                             DEV
                                                                             ({{$achievements["progress"][$k]}}
                                                                             )</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 750 && $achievements["progress"][$k] < 900)
                            <h1 style="font-size: 50px ; font-weight: bold;">SENIOR+ DEV.

                                                                             ({{$achievements["progress"][$k]}}
                                                                             )</h1>
                          @endif
                          @if ($achievements["progress"][$k] >= 900)
                            <h1 style="font-size: 50px ; font-weight: bold;">TEAM LEAD

                                                                             ({{$achievements["progress"][$k]}}
                                                                             )</h1>
                          @endif
                        </div>
                        <div class="progress-wrap"
                             data-progress="{{$achievements["progress"][$k]}}">
                          <div class="progress-block progress-begginer">
                          </div>
                          <div class="progress-block progress-junior">
                          </div>
                          <div class="progress-block progress-middle">
                          </div>
                          <div class="progress-block progress-senior">
                          </div>
                          <div class="progress-block progress-team-lead">
                          </div>
                        </div>
                        <hr>
                        <script>
                          document.querySelector("#collapseFour").addEventListener('click', e => {
                            if (e.target.closest('.accordion-flush')) {
                              var accordionItem = e.target.closest('.accordion-item');
                              if (e.target.closest('.accordion-button') && !accordionItem.querySelector(".show") && accordionItem.querySelector(".progress-wrap")) {
                                var maxProgress = 0;
                                var progressWrap = accordionItem.querySelector('.progress-wrap');
                                console.log("Progress wrap: ", progressWrap)
                                var progress = progressWrap.dataset.progress;
                                var progressBlocks = progressWrap.querySelectorAll(".progress-block");
                                progressBlocks.forEach(block => {
                                  maxProgress = maxProgress + block.offsetWidth;
                                });

                                progress = progress / 1000 * (maxProgress);
                                var index = 0;

                                for (let i = progressBlocks.length - 1; i >= 0; i--) {
                                  if (maxProgress <= progress) {
                                    index = i + 1;
                                    break;
                                  } else {
                                    maxProgress = maxProgress - progressBlocks[i].offsetWidth;
                                  }
                                }
                                for (let i = 0; i < index; i++) {
                                  progressBlocks[i].style.background = `linear-gradient(to right, #57B956  33.33% , #ECAC48 33.33% , #ECAC48 66.66% , #DA5045 66.66%)`;
                                }
                                if (index !== progressBlocks.length) {
                                  let point = (progress - maxProgress) / (progressBlocks[index].offsetWidth) * 100;
                                  let strokeStyle;
                                  if (point < 33.3333) {
                                    strokeStyle = `#57B956 ${point}%, transparent ${point}%`;
                                  } else if (point < 66.6666) {
                                    strokeStyle = `#57B956 33.33%, #ECAC48 33.33%, #ECAC48 ${point}%,transparent ${point}%`;
                                  } else {
                                    strokeStyle = `#57B956 33.33%, #ECAC48 33.33%, #ECAC48 66.66% , #DA5045 66.66%, #DA5045 ${point}%, transparent ${point}%`;
                                  }
                                  progressBlocks[index].style.background = `linear-gradient(to right, ${strokeStyle})`;
                                }
                              }
                            }
                          })
                        </script>
                        <div class="row text-center ">
                          @if (empty($achives[$k]))
                            <h2>Данных нет</h2>
                          @else
                            @foreach ($achives[$k] as $achive)
                              <div class=" text-center col-sm-3 m-2">
                                <div class="card text-center">
                                  <div class="card-header">
                                    <img

                                      src="https://i.imgur.com/YQEvANz.png"
                                      style="width:128px ; height: 128px "
                                      class="card-img-top"
                                      alt="#"
                                    />
                                  </div>
                                  <div class="card-body">
                                    <h5 class="card-title">{{$achive[0]}}</h5>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button
            class="accordion-button collapsed"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#collapseTwo"
            aria-expanded="false"
            aria-controls="collapseTwo"
          >
            Суммарная активность на уроках за весь период.
          </button>
        </h2>
        <div
          id="collapseTwo"
          class="accordion-collapse collapse"
          aria-labelledby="headingTwo"
          data-mdb-parent="#accordionExample"
        >
          <div class="accordion-body">
            <canvas id="canvas2" style="display:block;width: 400px; height: 400px"></canvas>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button
            class="accordion-button collapsed"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#collapseThree"
            aria-expanded="false"
            aria-controls="collapseThree"
          >
            Суммарная активность на уроках к определенному моменту.
          </button>
        </h2>
        <div
          id="collapseThree"
          class="accordion-collapse collapse"
          aria-labelledby="headingThree"
          data-mdb-parent="#accordionExample"
        >
          <div class="accordion-body">
            <canvas id="canvas3" style="display:block;width: 400px; height: 400px"></canvas>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button"
            type="button"
            data-mdb-toggle="collapse"
            data-mdb-target="#collapseOne"
            aria-expanded="true"
            aria-controls="collapseOne"
          >
            Активность на конкретном уроке.
          </button>
        </h2>
        <div
          id="collapseOne"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-mdb-parent="#accordionExample"
        >
          <div class="accordion-body">
            <canvas id="canvas" style="display:block;width: 400px; height: 400px"></canvas>
          </div>
        </div>
      </div>


    </div>

    <script>
      async function createChart(url = "api/{{$id}}", options = {}) {
        const response = await fetch(url, options);
        const result = await response.json();

        document.querySelector("#finish").value = result["finish"];
        const marks = result["marks"];
        const marks2 = result["marks2"];
        const sumMarks = result["summary_marks"];
        const marksInfo = [];
        const marksInfo2 = [];

        function generateColor() {
          return `rgba(${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))},1)`
        }

        function generateColorForbar() {
          return `rgb(${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))},${Math.round(Math.random() * (255))})`
        }

        for (const key in marks) {
          marksInfo.push({
            data: marks[key].marks,
            label: marks[key].name,
            type: "line",
            borderColor: generateColor(),
            borderWidth: 4,
            fill: false,

          });
        }
        for (const key in marks2) {
          marksInfo2.push({
            data: marks2[key].marks,
            label: marks2[key].name,
            type: "line",
            borderColor: generateColor(),
            borderWidth: 4,
            fill: false
          });
        }
        const canvas = document.getElementById("canvas").getContext("2d");
        const canvas2 = document.getElementById("canvas2").getContext("2d");
        const canvas3 = document.getElementById("canvas3").getContext("2d");
        const chart = new Chart(canvas, {
          type: 'line',
          data: {
            labels: result.dates,
            datasets: [...marksInfo]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            },
            hover: true
          }
        })
        const chart4 = new Chart(canvas3, {
          type: 'line',
          data: {
            labels: result.dates,
            datasets: [...marksInfo2]
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            },
            hover: true
          }
        })
        const labels = sumMarks.map(el => `${el.name}: ${el.sum}`);

        let d2 = [];
        for (const key in sumMarks) {

          let data = Array(labels.length).fill(0);
          data[labels.indexOf(`${sumMarks[key].name}: ${sumMarks[key].sum}`)] = sumMarks[key].sum;
          d2.push({
            label: `Активность на уроке: ${sumMarks[key].name}`,
            data: data,
            backgroundColor: sumMarks.map(el => generateColorForbar()),
          })
        }

        console.log(d2);
        const chart2 = new Chart(canvas2, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: d2
          },
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            },
            hover: true
          }
        })

      }

      createChart();

      document.querySelector("form").addEventListener("submit", e => {
        e.preventDefault();
        createChart("api/{{$id}}", {
          method: "POST",
          body: JSON.stringify({
            start: document.querySelector("#start").value,
            finish: document.querySelector("#finish").value,
          })
        })
      })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
            integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
            integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
            crossorigin="anonymous"></script>


@endsection

