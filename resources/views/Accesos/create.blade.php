<style>
    .sinlector, .registro {
        display: none;
    }

    .cerrar {
        float: right;
        width: 25px;
        height: 25px;
        background-color: #337ab7;
    }

    .fa-sort-desc {
        position: relative;
        left: 0.8rem;
        color: #ffffff;
    }

    .plus {
        color: red;
        cursor: pointer;
        font-size: 20px;
    }

    .delete_info {
        color: black;
        cursor: pointer;
        font-size: 20px;
    }

    .fa-sort-asc {
        position: relative;
        left: 0.9rem;
        top: 0.5rem;
        color: #ffffff;

    }
</style>


<div class="row">
    <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
        <div class="panel panel-primary table-responsive">
            <div class="cerrar">
                <span class="fa fa-sort-asc" id="mover">
                </span>
            </div>

            <div class="respuesta panel-body">
                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12" style="display: grid; justify-items: right;">
                    <div class="form-group" align="center">
                        <label for="nombre">Usar Registro Civil</label>
                        <br>
                        <label class="switch">
                            <input type="checkbox" id="registro" checked onChange="comprobar_registro(this);">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label for="nombre">Organización <span class="fa fa-plus-circle plus add-modal"></span></label>
                        <div class="input-group">
                            <input class="form-control" id="organizacion_add1" disabled="true" type="text">
                            <span onclick="quitar()" class="input-group-addon"><i class="fa fa-close delete_info"
                                                                                  id="icon_delete"></i></span>
                        </div>
                        <input class="form-control" id="organizacion_add" type="hidden">
                        <p class="errororganizacion text-center alert alert-danger hidden"></p>

                    </div>
                </div>


                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 registro">
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="nombres_add" id="nombres_add" class="form-control"
                               placeholder="Nombre persona..">
                        <p class="errorNombres text-center alert alert-danger hidden"></p>

                    </div>
                </div>

        
              
                
  <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
                    <div class="form-group">
                        <label for="Cedula">Código Tarjeta</label>
                        <input type="text" name="codigo_tarjeta_add" id="codigo_tarjeta_add" maxlength="10"
                               class="form-control"
                               placeholder="Codigo de Tarjeta..">
                        <p class="errorCodigoTarjeta text-center alert alert-danger hidden"></p>
                    </div>
                </div>

                        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 lector">
                    <div class="form-group">
                        <label for="Cedula">Cedula</label>
                        <input type="text" name="cedula_lector_add" id="cedula_lector_add" maxlength="10"
                               class="form-control"
                               placeholder="Cedula personal.." autofocus="">
                        <p class="errorCedula text-center alert alert-danger hidden"></p>
                    </div>
                </div>

                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 registro">
                    <div class="form-group">
                        <label for="Cedula">Sexo</label>

                        <select class="form-control" name="sexo_add" id="sexo_add">
                            <option value="M">Hombre</option>
                            <option value="F">Mujer</option>
                        </select>

                        <p class="errorSexo text-center alert alert-danger hidden"></p>
                    </div>
                </div>


                <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12" style="display: grid; justify-items: center;">
                    <button class="btn btn-primary" id="guargar" type="button">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="addModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <input type="text" id="myInput12" onkeyup="myFunction()"
                       placeholder="Buscar por piso o  organización..."
                       title="Buscar por piso o  organización..." style="text-transform:capitalize;"
                       onkeyup="javascript:this.value=this.value.toCapitalize();">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 table-responsive "
                         style="overflow: scroll; height: 300px;">
                        <table class="table  table-striped table-bordered table-hover" id="postTable12">
                            <thead>
                            <tr>
                                <th>Piso</th>
                                <th>Organizaciones</th>

                            </tr>
                            {{ csrf_field() }}
                            </thead>
                            <tbody id="cuerpo">
                            @foreach($pisos as $post)
                                <tr>
                                    <td style="border-bottom: .5px solid red; text-align: center; vertical-align: middle;">{{$post->Nombre}}</td>
                                    <td style="border-bottom: .5px solid red; ">
                                        @foreach($organizaciones as $orga)
                                            @if($orga->idPiso==$post->idPiso)
                                                <h4 style="cursor: pointer;"
                                                    onclick="copiar('{{$orga->idOrganizacion}}','{{$post->Nombre.' / '.$orga->Nombre}}')">
                                                    *
                                                    <span class="label label-primary">{{$orga->Nombre}}</span>
                                                </h4>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $(document).on('click', '.add-modal', function () {
        $('.modal-title').text('Organizaciones');
        $('#addModal').modal('show');
    });

    function copiar(id, organizacion) {
        $('#organizacion_add').val(id);
        $('#organizacion_add1').val(organizacion);
        $('#icon_delete').removeClass('delete_info');
        $('#icon_delete').addClass('plus');
        $('#addModal').modal('hide');

    }

    function quitar() {
        $('#organizacion_add').val(null);
        $('#organizacion_add1').val(null);
        $('#icon_delete').addClass('delete_info');
        $('#icon_delete').removeClass('plus');
    }

    $('.cerrar').on('click', function (e) {
        $('.respuesta').toggle();
        if ($('#mover').hasClass('fa-sort-desc')) {
            $('#mover').removeClass('fa-sort-desc');
            $('#mover').addClass('fa fa-sort-asc');
        } else {
            if ($('#mover').hasClass('fa fa-sort-asc')) {
                $('#mover').removeClass('fa-sort-asc');
                $('#mover').addClass('fa fa-sort-desc');
            }
        }
        e.preventDefault();
        $("#cedula_lector_add").focus();

    });


    function DibujarTabla(data) {
        $('#postTable').prepend("<tr class=item" + data.idAcceso + ">" +
            "<td>" + data.idAcceso + "</td>" +
            "<td>" + data.nombre_edificio + "</td>" +
            "<td>" + data.nombre_piso + "</td>" +
            "<td>" + data.nombre_organizacion + "</td>" +
            "<td>" + data.CodigoTarjeta + "</td>" +
            "<td>" + data.Nombres + "</td>" +
            "<td>" + data.Cedula + "</td>" +
            "<td><img src='" + "{{asset('public')}}" + (data.Sexo == 'M' ? '/avatar_hombre.png' : '/avatar_mujer.png') + "' width='80px' height='80px'></td>" +

            "<td>" + data.Creacion + "</td>" +
            "<td><h4><span class='label label-success'>Activo</span></h4></td>" +
            (data.tipo == 0 ? "<td>" + " <a href='' data-target='#modal-delete-" + data.idAcceso + "' data-toggle='modal'><button class='delete-modal btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Anular</button></a>" +
                "</td>" : "") +
            "</tr>");

        $('#modal').prepend("<div class='modal fade modal-slide-in-right' aria-hidden='true' role='dialog' tabindex='-1' id='modal-delete-" + data.idAcceso + "'>" +
            "<form method='post' action='" + "{{url('anular_visita')}}/" + data.idAcceso + "'>" +
            '{!! csrf_field() !!}' +
            "<div class='modal-dialog'>" +
            "<div class='modal-content'>" +
            "<div class='modal-header'>" +
            "<button type='button' class='close' data-dismiss='modal' 				aria-label='Close'>" +
            "<span aria-hidden='true'>×</span>" +
            "</button>" +
            "<h4 class='modal-title'>Anulación visita</h4>" +
            "</div>" +
            "<div class='modal-body'>" +
            "<p>Confirme si desea Anulación de visita</p>" +
            "</div>" +
            "<div class='modal-footer'>" +
            "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>" +
            "<button type='submit' class='btn btn-primary'>Confirmar</button>" +
            "</div>" +
            "</div>" +
            "</div>" +
            "</form>" +
            "</div>");
    }

    let registro = 1;

    function Guaradar(nombre_add, cedula_add, organizacion_add, sexo_add, codigo_tarjeta_add, tipo) {
        toastr.success('Petición envida con exito!', 'Success Alert', {timeOut: 5000});

        //$(".loader").fadeIn("slow");
        $.ajax({
            type: 'POST',
            url: "{{url('crear_visita')}}" + "/" + "{{$idvisita}}",
            data: {
                '_token': $('input[name=_token]').val(),
                'txt_nombre_persona': nombre_add,
                'txt_cedula_persona': cedula_add,
                'txt_organizacion': organizacion_add,
                'txt_sexo_persona': sexo_add,
                'txt_codigo_tarjeta': codigo_tarjeta_add,
                'tipo': tipo
            },
            success: function (data) {
                $('.errorNombres').addClass('hidden');
                $('.errororganizacion').addClass('hidden');
                $('.errorCedula').addClass('hidden');
                $('.errorSexo').addClass('hidden');
                $('.errorCodigoTarjeta').addClass('hidden');
                if ((data.errors)) {
                    setTimeout(function () {
                        toastr.error('No guardado!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.txt_error_web_service) {
                        toastr.error(data.errors.txt_error_web_service, 'Error Alert', {timeOut: 5000});
                    }

                    if (data.errors.txt_codigo_tarjeta) {
                        $('.errorCodigoTarjeta').removeClass('hidden');
                        $('.errorCodigoTarjeta').text(data.errors.txt_codigo_tarjeta);
                    }

                    if (data.errors.txt_nombre_persona) {
                        $('.errorNombres').removeClass('hidden');
                        $('.errorNombres').text(data.errors.txt_nombre_persona);
                    }

                    if (data.errors.txt_cedula_persona) {
                        $('.errorCedula').removeClass('hidden');
                        $('.errorCedula').text(data.errors.txt_cedula_persona);
                    }


                    if (data.errors.txt_organizacion) {
                        $('.errororganizacion').removeClass('hidden');
                        $('.errororganizacion').text(data.errors.txt_organizacion);
                    }
                    if (data.errors.txt_sexo_persona) {
                        $('.errorSexo').removeClass('hidden');
                        $('.errorSexo').text(data.errors.txt_sexo_persona);
                    }
                } else {
                    $('#nombre_add').val('');
                    $('#cedula_lector_add').val('');
                    $('#codigo_tarjeta_add').val('');
                    quitar();

                    toastr.success('Se guardo con exito con exito!', 'Success Alert', {timeOut: 5000});
                    if ((data.errors1)) {
                        if (data.errors1.txt_error_impresora) {
                            setTimeout(function () {
                                toastr.error(data.errors1.txt_error_impresora, 'Error Alert', {timeOut: 5000});
                                DibujarTabla(data.data);
                            }, 500);
                        }
                    } else {
                        DibujarTabla(data);
                    }
                }
                //$(".loader").fadeOut("slow");
                $("#cedula_lector_add").focus();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                //$(".loader").fadeOut("slow");
                toastr.error('No guardado!' + "Error 500", 'Error Alert', {timeOut: 5000});
            }
        });
    }

    $("#guargar").click(function () {
        let cedula = $('#cedula_lector_add').val();
        if (cedula.length < 10) {
            for (let i = cedula.length; i < 10; i++) {
                cedula = '0' + cedula;
            }
            $('#cedula_lector_add').val(cedula);
        }
        Guaradar($("#nombres_add").val(), $("#cedula_lector_add").val(), $("#organizacion_add").val(), $("#sexo_add").val(), $("#codigo_tarjeta_add").val(), registro);
    });

    $("#cedula_lector_add").focus();

    $.fn.delayPasteKeyUp = function (fn, ms) {
        var timer = 0;
        $(this).on("propertychange input", function () {
            clearTimeout(timer);
            timer = setTimeout(fn, ms);
        });
    };
    $(document).ready(function () {
        $("#cedula_lector_add").delayPasteKeyUp(function () {

        }, 200);
    });


    function comprobar_registro(obj) {
        if (!obj.checked) {
            registro = 0;
            $(".registro").css("display", "block");
            $("#cedula_lector_add").focus();


        } else {
            registro = 1;
            $(".registro").css("display", "none");
            $("#cedula_lector_add").focus();

        }
    }

    $(".respuesta").on('keyup', function (e) {
        if (e.keyCode == 13) {
            $('#guargar').click();
        }
    });

</script>
