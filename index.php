<?php include 'func/conexiones.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="css/demo_page.css">
    <link rel="stylesheet" href="css/demo_table.css">

    <script>
        var procedimiento = 'nuevo';
        $(document).ready(function(){
            var num = 1;
            $('#loader').hide();
            $('#formularioRegistrar').hide();
            $('#tabla').dataTable();

            $('#btnNuevo').click(function () {
               $('#leyenda').html('Registrar Nuevo Estudiante');
                procedimiento = 'nuevo';
                num = num+1;
                if(num % 2 == 0){
                    $('#formularioRegistrar').show();
                    $('#btnNuevo').val('cancelar');
                }else{
                    $('#formularioRegistrar').hide();
                    $('#btnNuevo').val('Agregar Nuevo estudiante');
                }
            });

            $('#btnProcesar').click(function(){
                $('#loader').show();
                var datos = $('#frmRegistrar').serialize();
                if(procedimiento == 'nuevo'){
                    $.ajax({
                        url : 'guardar.php',
                        type : 'POST',
                        data : datos,
                        success : function(r){
                            alert(r);
                            $('#loader').hide();
                            location.reload(true);
                        }
                    });
                }else if(procedimiento == 'editar'){
                    $.ajax({
                        url : 'editar.php',
                        type : 'POST',
                        data : datos,
                        success : function (r) {
                            alert(r);
                            $('#loader').hide()
                            location.reload(true);
                        }
                    });
                }

            });
        });

        var user_id = $(this).colsest('td').find('.userId').text();
        function eliminar(cedula){
            var ced = "cedula="+cedula;
            $.ajax({
                url:"eliminar.php",
                data: ced,
                type: "POST",
                success : function (resultado) {
                    alert(resultado);
                    location.reload(true);
                }
            });
        }

        function editar(cedula)
        {
            $("#leyenda").html("Actualizar Paciente");
            procedimiento = "editar";
            var ced = "cedula="+cedula;
            $.ajax({
                url:"buscarestudiante.php",
                data: ced,
                type: "POST",
                dataType: "json",
                success:
                    function(respuesta)
                    {
                        $("#formularioRegistrar").show();
                        $("#btnNuevo").val("Cancelar");
                        $("#txtCedula").val(respuesta.ced);
                        $("#txtNombres").val(respuesta.nom);
                        $("#txtApellidos").val(respuesta.apel);
                        $("#txtFechaNac").val(respuesta.fn);
                        $("#txtTel").val(respuesta.tel);
                        $("#txtDir").val(respuesta.dir);
                    }
            })
        }
    </script>
</head>
<body>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="tabla">
    <thead>
    <tr>
        <th>Cedula</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha Nac</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php

    $sql = "select CEDULA, NOMBRES, APELLIDOS, FECHA_NAC, TEL, DIR from datospersonales order by nombres, apellidos";

    $registros = $link->query($sql);
    while ($reg = $registros->fetch_array() ) {
        ?>
        <tr class="odd gradeX">
            <td><?php echo $reg['CEDULA'] ?></td>
            <td><?php echo $reg['NOMBRES'] ?></td>
            <td><?php echo $reg['APELLIDOS'] ?></td>
            <td><?php echo $reg['FECHA_NAC'] ?></td>
            <td><?php echo $reg['TEL'] ?></td>
            <td><?php echo $reg['DIR'] ?></td>
            <td><img src="images/refresh.png" style="cursor: pointer" onclick="editar(<?php echo $reg['CEDULA'] ?>)">
                <img src="images/delete.png" style="cursor: pointer;" onclick="eliminar('<?php echo $reg['CEDULA']; ?>')"
            </td>

        </tr>
        <?php
    }
    ?>
    </tbody>

    <tfoot>
    <th>Cedula</th>
    <th>Nombres</th>
    <th>Apellidos</th>
    <th>Fecha Nac</th>
    <th>Telefono</th>
    <th>Direccion</th>
    <th></th>
    </tfoot>
</table>

<div id="botonNuevo" align="center">
    <input type="button" id="btnNuevo" name="btnNuevo" value="Agregar Nuevo Estudiante" />
</div>
<br>
<div id="formularioRegistrar" align="center">
    <div id="procedimiento"></div>
    <form name="frmRegistrar" id="frmRegistrar">
        <fieldset style="display: inline;">
            <legend id="leyenda">Registrar</legend>
            <table>
                <tr>
                    <td>Cedula : </td>
                    <td>
                        <input type="text" id="txtCedula" name="txtCedula" />
                    </td>
                </tr>
                <tr>
                    <td>Nombres : </td>
                    <td>
                        <input type="text" id="txtNombres" name="txtNombres" />
                    </td>
                </tr>
                <tr>
                    <td>Apellidos : </td>
                    <td>
                        <input type="text" id="txtApellidos" name="txtApellidos" />
                    </td>
                </tr>
                <tr>
                    <td>Fecha de Nacimiento : </td>
                    <td>
                        <input type="text" id="txtFechaNac" name="txtFechaNac" />
                    </td>
                </tr>
                <tr>
                    <td>Telefono : </td>
                    <td>
                        <input type="text" id="txtTel" name="txtTel" />
                    </td>
                </tr>
                <tr>
                    <td>Direccion : </td>
                    <td>
                        <input type="text" id="txtDir" name="txtDir" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" id="btnProcesar" name="btnProcesar" value="Procesar Estudiantes" />
                    </td>
                    <td>
                        <input type="reset" name="btnBorrar" id="btnBorrar" value="Borrar Formulario" />
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <div id="loader">
                            <img src="images/loader.gif" />
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</div>
</div>

</body>
</html>