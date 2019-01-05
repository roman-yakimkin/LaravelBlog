<label for="">Заголовок</label>
<input type="text" class="form-control" name="title" placeholder="Название события"
       value="{{$event->title ?? ""}}" reruired >

<label for="">Даты</label>
<event-dates :dates="{{json_encode($event_dates)}}"></event-dates>
<hr />

<input type="submit" class="btn btn-primary" value="Сохранить">
