@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Создание события @endslot
            @slot('parent') Главная @endslot
            @slot('active') События @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.event.store')}}" method="post">
            {{csrf_field()}}

            @include('admin.events.partials.form')
        </form>

    </div>

@endsection