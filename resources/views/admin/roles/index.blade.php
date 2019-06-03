@extends('admin.layouts.app',['title'=>'Roles'])
@section('content')
    <div class="container">
        {{--<div class="bg-transparent  w-100  ">--}}

        {{--<form name="search_form" method="get"  class="flex my-4">--}}
        {{--<div class="w-50 mx-auto  py-2 ">--}}
        {{--<input name="keyword" type="text" placeholder="Search...."--}}
        {{--class="bg-white-smoke appearance-none rounded-full px-5 outline-none border-none p-2 m-0 w-100">--}}
        {{--</div>--}}



        {{--</form>--}}
        {{--</div>--}}
        <div class=" w-80 mx-auto  flex">
            <div class="w-80">
                <h4 class=" py-0 font-primary   text-xl">Roles</h4>
            </div>
            <div class="w-20 my-3 mx-0 text-right">
                <button data-toggle="#add-post-form" class="btn  btn-primary text-sm rounded-xlg border-0  toggler ">
                    {{__('ADD NEW')}}
                </button>
            </div>

        </div>


        <div id="add-post-form"
             class="card w-80 mx-auto hidden-temp rounded-xlg py-5 border-1 border-solid border-grey-light">
            <div class="">
                <form action="{{action('Admin\RolesController@store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class=" w-90 flex mx-auto">
                        <div class="w-70 ">
                            <div class="border-1 border-solid border-grey relative">
                                <label for="password"
                                       class="my-0 absolute  z-99 bg-white px-1 mx-2 text-grey-darker text-sm line-height-small"
                                       style="top: -25%;">name</label>
                                <input id="password" type="name"
                                       class="form-input my-0 border-none px-3 w-100 py-1 relative shadow-none py-0 mt-2 rounded-none"
                                       autocomplete="false"
                                       name="email"
                                       required>
                            </div>
                        </div>
                        <div class="w-30 mx-4">
                            <button class="btn btn-success rounded py-2 ">{{__('save')}}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <br>

        @if(count($roles))
            @foreach($roles as $role)
                <div class=" w-80 xs:w-100 mx-auto xl:mt-3">
                    <div
                        class="  xs:mx-0 bg-white border-1 border-solid border-grey-light rounded-xlg w-100 mb-4 p-2 py-5">
                        <div class="flex">
                            <div class="w-60 xs:mx-2 font-primary font-bold mx-5">
                                <p class="my-0 capitalize">{{$role->name}}</p>
                            </div>


                            <div class=" w-40 text-right xs:mr-2 mr-3">
                                <button data-toggle="#mod-post-form{{$role->id}}"
                                        class="btn btn-outline-success rounded-xlg px-3 text-sm py-2 font-primary toggler">{{__('Modify')}}
                                </button>


                                <a href="{{action('Admin\RolesController@delete',[$role->id])}}">
                                    <button
                                        class="btn btn-outline-danger rounded-xlg px-3 text-sm py-2 font-primary ">{{__('Delete')}}</button>
                                </a>
                            </div>
                        </div>
                        <div id="mod-post-form{{$role->id}}" class="card hidden-temp rounded-none border-none">
                            <div class="card-body">
                                <form action="{{action('Admin\RolesController@update',[$role->id])}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class=" w-90 flex mx-auto">
                                        <div class="w-70">
                                            <div class="border-1 border-solid border-grey relative">
                                                <label for="password"
                                                       class="my-0 absolute  z-99 bg-white px-1 mx-2 text-grey-darker text-sm line-height-small"
                                                       style="top: -25%;">name</label>
                                                <input id="password" type="name"
                                                       class="form-input my-0 border-none px-3 w-100 py-1 relative shadow-none py-0 mt-2 rounded-none"
                                                       autocomplete="false"
                                                       name="email"
                                                       value="{{$role->name}}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="w-30 mx-4">
                                            <button class="btn btn-success rounded py-2 ">{{__('save')}}</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <br>
                </div>
            @endforeach
        @endif

    </div>
@endsection
