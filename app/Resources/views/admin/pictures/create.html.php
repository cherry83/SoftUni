<form class="form-horizontal" action="/admin/pictures/upload" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Добавяне на картинка</legend>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="title">Име на картинката</label>
            <div class="col-sm-4 ">
                <input type="text" class="form-control" id="title" placeholder="Име" name="picture[name]" required>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-4 control-label" for="sel1">Категория:</label>
            <div class="col-sm-4 ">
                <select class="form-control " id="sel1" name="category" required>
                    <?=$categories?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-xs-12 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" disabled="disabled">
                        <span class="input-group-btn">
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Изчисти
                    </button>

                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">Изберри файл</span>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="file_name"/> 
                    </div>
                </span>
                    </div>
                    <?=$file_error?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-5">
                <a class="btn btn-default" href="/admin/pictures">Откажи</a>
                <button type="submit" class="btn btn-success">Качи</button>
            </div>
        </div>
    </fieldset>
</form>
            
<script type='text/javascript'>            
$(document).on('click', '#close-preview', function () {
    $('.image-preview').popover('hide');
    $('.image-preview').hover(
        function () {
            $('.image-preview').popover('show');
        },
        function () {
            $('.image-preview').popover('hide');
        }
    );
});

$(function () {
    var closebtn = $('<button/>', {
        type: "button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class", "close pull-right");
    $('.image-preview').popover({
        trigger: 'manual',
        html: true,
        title: "<strong>Преглед</strong>" + $(closebtn)[0].outerHTML,
        content: "Няма избрана снимка",
        placement: 'bottom'
    });
    $('.image-preview-clear').click(function () {
        $('.image-preview').attr("data-content", "").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Изберри файл");
    });
    $(".image-preview-input input:file").change(function () {
        var img = $('<img/>', {
            id: 'dynamic',
            width: 250,
            height: 200
        });
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Смени");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content", $(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});
</script>