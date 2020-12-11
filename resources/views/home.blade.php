<x-home-master>

@section('content')
    <h1 class="my-4">ALL BLOG POSTS</h1>

    <!-- Blog Post -->
    @foreach($posts as $post)
        <div class="card mb-4">
            <img style="object-fit: cover" class="card-img-top" width="900" height="200" src="{{$post->post_image}}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{$post->title}}</h2>
                <p class="card-text">{{Str::limit($post->body, '50', '.....')}}</p>
                <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                Posted on {{$post->created_at->diffForHumans()}} by
                <a href="#">{{ $post->user->name }}</a>
            </div>
        </div>
        @endforeach

        <!-- Pagination -->
        <div class="pagination justify-content-center mb-4">
            {{ $posts->links() }}
        </div>
{{--        <ul class="pagination justify-content-center mb-4">--}}
{{--            <li class="page-item">--}}
{{--                <a class="page-link" href="#">&larr; Older</a>--}}
{{--            </li>--}}
{{--            <li class="page-item disabled">--}}
{{--                <a class="page-link" href="#">Newer &rarr;</a>--}}
{{--            </li>--}}
{{--        </ul>--}}

    @endsection

</x-home-master>