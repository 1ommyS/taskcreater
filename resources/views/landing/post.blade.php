@extends("layouts.layout")
@section("title") О нас @endsection
@section("content")

  <header>
    @include('landing.templates.nav')
  </header>

  <section class="main-content">
    <section class="promo">
      <div class="learning_plan">
        <div class="container-fluid plan-content">
          <div class="mw-block" style="max-width: 1140px !important;">
            <div style="display:flex;justify-content:center">
              <div class="post-page card post">
                <img src="{{ asset("public/file/blog/images/{$currentPost->pathToImage}") }}"
                     class="card-img card-img-top main-card"
                     alt="...">
                <div class="card-img-overlay">
                  <h1 class="card-title">{{ $currentPost->title }}</h1>
                </div>
                <div class="card-body">
                  <p class="card-text main">{!! $currentPost->description !!}</p>
                </div>
              </div>
            </div>
            <div class="container-fluid">
              <div class="similar_posts_title">
                <h2 class="similar_posts_header">Смотрите также:</h2>
              </div>
              <div class="similar_posts row blog-cards">
                @foreach($posts as $id=>$post)
                  <div class="post-page  card">
                    <img src="{{ asset("public/file/blog/images/{$post['pathToImage']}") }}" class="card-img-top"
                         alt="...">
                    <div class="card-body subblock">
                      <p
                        class="card-text">{{ strlen($post["title"]) > 64? substr($post["title"], 0, 64). "..." : $post["title"]  }}</p>
                      <a href="/blog/{{ $post["id"] }}" class="btn btn-own">читать</a>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </section>
@endsection
