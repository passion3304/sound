


@foreach($posts as $post)
    <h2><a href="{{ action('BlogController@show',$post->id) }}">{{ $post->title }}</a></h2>

    <div class="row">
        <div class="col-md-3">
            <a href="{{ action('BlogController@show',$post->id) }}">
                @if($post->thumbnail)
                    <img src="/uploads/thumbnail/{{ $post->thumbnail->name}}"
                         class="img-responsive img-thumbnail">
                @else
                    <img src="http://placehold.it/150x100/EEEEEE" class="img-responsive img-thumbnail">
                @endif
            </a>
        </div>
        <div class="col-md-9">
            {!! str_limit($post->description,100) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 ">
            <button class="btn btn-default mTop10"><a
                        href="{{ action('BlogController@show',$post->id) }}">More</a></button>
        </div>
    </div>

    <hr>
@endforeach
    