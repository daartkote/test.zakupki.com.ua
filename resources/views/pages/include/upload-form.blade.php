    </table>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload Image</h4>
                </div>
                {!! Form::open(['route' => 'image.store', 'enctype' => 'multipart/form-data', 'id' => 'uploadForm']) !!}
                {!! Form::hidden('modelId', null, ['id' => 'modelId']) !!}
                {!! Form::hidden('type', null, ['id' => 'type']) !!}
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::file('image', ['class' => 'image', 'id' => 'image']) !!}
                        <ul class="errors-image"></ul>
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Название изображения') !!}
                        {!! Form::text('name', null, ['id' => 'name']) !!}
                        <ul class="errors-name"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    {!! Form::button('Close', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                    {!! Form::submit('Upload', ['class' => 'btn btn-primary', 'id' => 'upload']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (e) {
            $("#uploadForm").on('submit', (function (e) {
                $('ul[class^="errors-"]').empty();
                e.preventDefault();

                $.ajax({
                    url: $("#uploadForm").attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response.errors) {
                            $.each(response.errors, function (name, value) {
                                $.each(value, function (key, error) {
                                    $('.errors-' + name).append('<li class="alert-danger">' + error + '</li>');
                                });

                            });
                        } else {
                            $('a[data-model-id="' + $('#modelId').val() + '"]')
                                    .parent().parent().find('ul').append('<li><a rel="popover" href="' + response.path + '">' + response.name + '</a></li>');
                            $('#myModal').modal('hide');
                        }
                    }
                });
            }));

            $('#myModal').on('hidden.bs.modal', function () {
                $(this).find(".modal-body input").val('').end();
                $('ul[class^="errors-"]').empty();
            });

            $('#myModal').on('show.bs.modal', function (e) {
                $('#modelId').val($(e.relatedTarget).data('model-id'));
                $('#type').val($(e.relatedTarget).data('type'));
            })

            $('td').popover({
                html: true,
                trigger: 'hover',
                selector: '[rel="popover"]',
                content: function () {
                    return '<img width = 200 src="'+$(this).attr('href') + '" />';
                }
            });
        });
    </script>
@stop