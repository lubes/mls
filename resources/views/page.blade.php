@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    <div class="db-content-inner p-0 p-md-5">
      @include('partials.content-page')
    </div>
  @endwhile
@endsection
