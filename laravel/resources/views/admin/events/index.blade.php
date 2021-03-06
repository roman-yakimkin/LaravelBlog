@extends("admin.layouts.app_admin");

@section("content")

    <div class="container">
        @component("admin.components.breadcrumbs")
            @slot("title") Список событий @endslot
            @slot("parent") Главная @endslot
            @slot("active") Новости @endslot
        @endcomponent

        <hr />

        <a href="{{route("admin.event.create")}}" class="btn btn-primary pull-right"><i class="fa fa-plus-square-o"></i>Добавить событие</a>

        <table class="table table-striped">
            <thead>
            <th>Наименование</th>
            <th>Даты события</th>
            <th class="text-right">Действия</th>
            </thead>
            <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{$event->dates_str()}}</td>
                    <td class="text-right">
                        <form onsubmit="if(confirm('Удалить?')){return true} else {return false}"
                              action="{{route('admin.event.destroy', $event)}}"
                              method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{csrf_field()}}
                            <a class="btn btn-default" href="{{route("admin.event.edit", $event)}}"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>

                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center"><h2>Данные отсутствуют</h2></td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3">
                    <ul class="pagination pull-right">
                        {{$events->links()}}
                    </ul>
                </td>
            </tr>
            </tfoot>
        </table>

    </div>

@endsection
