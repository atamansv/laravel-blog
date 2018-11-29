@extends('layouts.app')

@section('content')
    <div class="container">

        @include('frontend._search')

        <div class="row">

            <div class="col-md-12">
                @forelse ($posts as $post)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $post->title }} - <small>by {{ $post->user->name }}</small>

                            <span class="pull-right">
                                {{ $post->created_at->toDayDateTimeString() }}
                            </span>
                        </div>

                        <div class="panel-body">
                            <div>
                                <p>
                                    <span>{{ mb_substr($post->body, 0, 50) }}</span><span class="transition-opacity collapse-inline collapse" id="collapsePost{{ $post->id }}">{{ mb_substr($post->body, 50) }}</span>
                                    <button class="btn btn-xs btn-link" type="button" data-toggle="collapse" data-target="#collapsePost{{ $post->id }}"
                                            aria-expanded="false" aria-controls="collapseExample">...</button>
                                </p>
                            </div>
                            <p>
                                Tags:
                                @forelse ($post->tags as $tag)
                                    <span class="label label-default">{{ $tag->name }}</span>
                                @empty
                                    <span class="label label-danger">No tag found.</span>
                                @endforelse
                                Category:
                                <span class="label label-success">{{ $post->category->name }}</span>
                                <span class="label label-info">{{ $post->comments_count }} comments</span>
                            </p>
                            <p class="pull-right">
                                <a href="{{ url("/posts/{$post->id}") }}" class="btn btn-sm btn-link">Reed more</a>
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="panel panel-default">
                        <div class="panel-heading">Not Found!!</div>

                        <div class="panel-body">
                            <p>Sorry! No post found.</p>
                        </div>
                    </div>
                @endforelse

                <div align="center">
                    {!! $posts->appends(['search' => request()->get('search')])->links() !!}
                </div>

            </div>

        </div>
    </div>
@endsection
