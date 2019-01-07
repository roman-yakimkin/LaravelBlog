@extends('admin.layouts.app_admin')

@section('content')

    <div class="container">

        @component('admin.components.breadcrumbs')
            @slot('title') Редактирование события @endslot
            @slot('parent') Главная @endslot
            @slot('active') События @endslot
        @endcomponent

        <hr />

        <form class="form-horizontal" action="{{route('admin.event.update', $event)}}" method="post">
            <input type="hidden" name="_method" value="PUT">
            {{csrf_field()}}

            @include('admin.events.partials.form')
        </form>

    </div>

@endsection