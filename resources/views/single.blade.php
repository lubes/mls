@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
  <div class="db-content-inner p-0 p-md-5">
    <article @php post_class() @endphp>
      <div class="entry-content">
        @php the_content() @endphp
      </div>
      @php comments_template('/partials/comments.blade.php') @endphp
    </article>
  </div>
  @endwhile
@endsection
