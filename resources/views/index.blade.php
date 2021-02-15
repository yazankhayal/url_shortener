@extends("layouts.app")

@section("content")

    <main class="main">
        <main class="container">

            @if($items )
                @include("layouts.msg")

                <form method="POST" action="{{ route('url.post') }}"
                      class="row">
                    @csrf

                    <div class="col-5 mb-2">
                        <div class="form-group">
                            <label for="url" class="sr-only">URL</label>
                            <input type="text" name="url" class="form-control" value="{{old('url')}}" id="url"
                                   placeholder="Long URL (required)">
                        </div>
                    </div>

                    <div class="col-5 mb-2">
                        <div class="form-group">
                            <label for="desc" class="sr-only">Short URL Keyword (optional)</label>
                            <input type="text" name="desc" class="form-control" id="desc"
                                   placeholder="Short URL Keyword (optional)">
                        </div>
                    </div>

                    <div class="col-1 mb-2">
                        <div class="form-group">
                            <label for="private">
                                <input type="checkbox" name="desc" class="" id="desc" placeholder="Private?">
                                Private
                            </label>
                        </div>
                    </div>

                    <div class="col-1 mb-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Shorten</button>
                        </div>
                    </div>

                </form>

                <div class="list-group">
                    <h2>Recent links</h2>
                    @foreach($items as $item)
                        <a href="{{route('url_view',['code'=>$item->code])}}" target="_blank"
                           class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{env('APP_URL').'/'.$item->code}}</h5>
                                <small>{{$item->updated_at->diffForHumans()}}</small>
                            </div>
                            <p class="mb-1">{{$item->desc}}</p>
                            <span class="badge badge-primary badge-pill">View {{$item->URLViewCount->count()}}</span>
                        </a>
                    @endforeach
                </div>

                @else

                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You must log in or create an account in order to be able to shorten the links</p>
                    <hr>
                    <p class="mb-0">Now you can get the short links</p>
                </div>

            @endif

        </main>
    </main>

@endsection
