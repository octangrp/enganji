@extends('admin.layouts.app')
@section('content')
    {{--@if(Auth::guard('admin')->user()->canManageAffiliates())--}}
        <div class="container xs:mx-2">
            @if(Session::has('success'))
                <div class="alert alert-info">
                    {{Session::get('success')}}
                </div>
            @endif

            @if($errors->any())

                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <ul>
                            <li>{{$error}}</li>
                        </ul>
                    @endforeach
                </div>

            @endif

            <div class="w-100 flex pb-4 border-0 border-b-1 border-solid border-grey">
                <div class="w-70">
                    <h1 class="font-normal text-2xl font-primary">{{__('Ads')}}</h1>
                </div>
                <div class="w-30 text-right">
                    <button data-toggle="#add-post-form"
                            class="btn btn-outline-dark rounded-full px-3 text-sm py-2 font-primary toggler">{{__('ADD NEW')}}</button>
                </div>
            </div>

            <div class="w-50 md:w-75 sm:w-70 xs:w-100 text-center mx-auto py-4 ">
                <div class="bg-white rounded-full border-1 border-solid border-grey-light">
                    <form name="search_form" method="get" action="{{action('Admin\AdsController@search')}}">
                        <input name="keyword" type="text" placeholder="Search.." value="{{$keyword ?? null}}"
                               class="bg-transparent appearance-none outline-none border-none p-3 xs:text-xs m-0 w-80 md:w-70 xs:w-60"
                               required>
                        <button class="rounded-full btn bg-primary text-white ">Search</button>
                    </form>
                </div>
            </div>

            <div id="add-post-form" class="card hidden-temp rounded-none border-none shadow">
                <div class="card-body">
                    <form action="{{action('Admin\AdsController@store')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">Title</label>
                            <input class="form-control" type="text" name="title">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">body</label>
                            <input class="form-control" type="text" name="body">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>
                                <input type="checkbox" name="home_page" value="1">
                                <span class="ml-2">Home Page</span>
                            </label>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label>
                                <input type="checkbox" name="product_listing" value="1">
                                <span class="ml-2">Product Listing</span>
                            </label>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="mr-3">Link</label>
                            <input class="form-control" type="text" name="link">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">Start</label>
                            <input class="form-control" type="date" name="starting_on">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">End</label>
                            <input class="form-control" type="date" name="ending_on">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">Picture</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                        <button class="btn btn-primary btn-block mt-4">Save</button>
                    </form>
                </div>
            </div>
            <br/>
            @foreach($ads as $ad)
                <div class="px-4 py-2 bg-white  border-none mb-3 shadow">
                    <div class="row py-4">
                        <div class="col-md-3">
                            <h5 class="font-normal font-primary">
                                <img src="{{asset($ad->getFirstMediaUrl())}}" class="h-25 w-fit" >
                                
                                <p class="mt-4">{{$ad->title}}</p>

                            </h5>
                        </div>
                        <div class="col-md-7 text-right">
                        <span data-toggle="#mod-category-{{$ad->id}}" class="mr-3 cursor-pointer text-xl toggler">
                           <i class="fi flaticon-edit"></i>
                        </span> <a class=" my-0 text-xl text-red" title="Delete"
                                   href="{{action('Admin\AdsController@destroy',[$ad->id])}}"> <i
                                    class="fi flaticon-trash"></i>
                            </a>
                        </div>
                    </div>
                    <div id="mod-category-{{$ad->id}}" class="hidden-temp py-3">
                        <form action="{{action('Admin\AdsController@update',[$ad->id])}}" method="POST"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('put')
                            
                            {{csrf_field()}}

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">Title</label>
                            <input class="form-control" type="text" name="title" value="{{ $ad->title }}">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">body</label>
                            <input class="form-control" type="text" name="body" value="{{ $ad->body }}">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>
                                <input type="checkbox" name="home_page" value="1" {{ ($ad->home_page == 1) ? 'checked' : '' }}>
                                <span class="ml-2">Home Page</span>
                            </label>
                        </div>

                        <div class="col-md-12 mt-2">
                            <label>
                                <input type="checkbox" name="product_listing" value="1" {{ ($ad->product_listing == 1) ? 'checked' : '' }}>
                                <span class="ml-2">Product Listing</span>
                            </label>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="mr-3">Link</label>
                            <input class="form-control" type="text" name="link" value="{{ $ad->link }}">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">Start</label>
                            <input class="form-control" type="date" name="starting_on" value="{{ $ad->starting_on }}">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">End</label>
                            <input class="form-control" type="date" name="ending_on" value="{{ $ad->ending_on }}">
                        </div>

                        <div class="col-md-12 mt-2">
                            <label class="mr-3">Picture</label>
                            <input type="file" name="file" class="form-control">
                        </div>

                        <button class="btn btn-success btn-block mt-4">Save</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

@endsection
