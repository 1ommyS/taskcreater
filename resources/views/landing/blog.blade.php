@extends("layouts.layout")
@section("title") О нас @endsection
@section("content")

  <header>
    @include('landing.templates.nav')
  </header>
  <section class="main-content learning_plan">
    <div class="introduction-block container-fluid ">
      <div class="row mw-block  plan-content">
        <div class="introduction-header">
          <h1>IT-PARK блог:</h1>
        </div>
        <div class="introduction-content">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
             incididunt ut labore et dolore magna aliqua. </p>
        </div>
      </div>
    </div>

    <div class=" plan-content">
      <div class="container-fluid">
        <div class="row blog-cards mw-block " style="max-width: 1150px !important;">
          @foreach($posts as $post)
            <div class="card blog">
              <img src="{{ asset("public/file/blog/images/{$post->pathToImage}") }}" class="card-img-top" alt="...">
              <div class="card-body">
                <p
                  class="card-text">{{ strlen($post->title) > 64 ? substr($post->title, 0, 64). "..." : $post->title  }}</p>
                <a href="/blog/{{ $post->id }}" class="btn btn-own">читать</a>

              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
    </div>

  </section>

@endsection
