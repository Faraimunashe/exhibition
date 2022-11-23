<x-guest-layout>
    <div class="pagetitle" style="" id="space">
        <h1>Notices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Notices</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard" id="space">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Recent Notices</h5>
                        <div class="list-group">
                            @foreach ($notices as $notice)
                                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$notice->topic}}</h5>
                                        <small>{{$notice->created_at}}</small>
                                    </div>
                                    <p class="mb-1">{{$notice->content}}</p>
                                    <small>{{get_user($user_id)->name}}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
