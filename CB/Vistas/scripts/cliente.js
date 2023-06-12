$(function($){
    listarDT();
    //  CARGA DE CAMPOS CFDI Y ESTADOS
    cargarSelects('../Vistas/Archivos/municipios.json',document.getElementById('estado'));
    cargarSelects('../Vistas/Archivos/cfdi.json',document.getElementById('cfdi'));
    
    $( "#add" ).click(function() {
        $("#rfc").removeClass("no-valido valido");
        mostrarInfoLead();
    });

    $( "#pa-tras" ).click(function() {
        $("#formulario").addClass("no-mostrar");
        $("#main").removeClass("no-mostrar");
        localStorage.setItem('rfc', '');
        //recargar();
    });

    $( "#rfc" ).on( "keyup", function() {
        if ( $("#rfc").val().trim().length > 12 ) {
            $("#nomCom, #razon").addClass("no-mostrar");
            $("#nombre, #materno, #paterno").removeClass("no-mostrar");
            $('#nombreG').attr('required', true);
            $('#razonSocial').attr('required', false);

        } else{
            $("#nombre, #materno, #paterno").addClass("no-mostrar");
            $("#nomCom, #razon").removeClass("no-mostrar");
            $('#razonSocial').attr('required', true);
            $('#nombreG').attr('required', false);
        }
      } );

      $("#rfc").focusout(function(){
        validarRfc($("#rfc").val());
      });

})


function listarDT(){
    let urlController = '../Controladores/clienteControlador.php';
    tabla="";
    
    try {
        tabla=$('#myTable').dataTable({
                "aProcessing": true,//Activamos el procesamiento del datatables
                "aServerSide": true,//Paginación y filtrado realizados por el servidor
                dom: 'Bfrtip',//Definimos los elementos del control de tabla
                buttons: [		          
                            'excelHtml5',
                            'csvHtml5',
                            'pdf'
                        ],
                "ajax":
                        {
                            url:  urlController,
                            type : "get",
                            dataType : "json",						
                            error: function(e){
                                console.log(e.responseText);	
                            }
                        },
                "bDestroy": true,
                "iDisplayLength": 10,//Paginación
                "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
                language: {//Cambiar idioma a español
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            }
            ).DataTable();
      } catch (error) {
        console.log(error);
      }
}

function eliminarLead(identificador) {
    let url = '../Controladores/clienteControlador.php?opcion=eliminar&identificador='+identificador+'';  
    let isExecuted = confirm("Este contacto se eliminara permanentemente");
    if (isExecuted) {            
        $.getJSON(url, function (data) {
            //
        });
    }
    recargar();
}

function mostrarInfoLead(identificador = null) {
    $("#main").addClass("no-mostrar");
    $("#formulario").removeClass("no-mostrar");
    document.getElementById("formulario").reset();
    if (identificador >= 0) {
        let url = '../Controladores/clienteControlador.php?opcion=actualizar&identificador='+identificador+'';  
        $.getJSON(url, function (data) {
            $.each(data, function (index, valor) {
                $(`#${index}`).val(valor);
                if (index == 'rfc') {
                    localStorage.setItem('rfc', valor);
                    if (valor.length > 12) {
                        $("#nomCom, #razon").addClass("no-mostrar");
                        $("#nombre, #materno, #paterno").removeClass("no-mostrar");
                        $('#nombreG').attr('required', true);
                        $('#razonSocial').attr('required', false);
                    }
                }
            });

        });
    }
} 

function validarRfc(identificador = null) {
    let url = '../Controladores/clienteControlador.php?opcion=validar&rfc='+identificador+'';  
    $.getJSON(url, function (data) {
        if (data && data["rfc"] != localStorage.getItem('rfc')) {
            alert("Numero RFC ya registrado");
            $("#rfc").addClass("no-valido");
        }else{
            $("#rfc").addClass("valido");
        }
    });
    if ($("#rfc").val().trim().length < 12) {
        $("#rfc").addClass("no-valido");
    }
} 

function recargar() {
    location.reload();
    localStorage.setItem('rfc', valor);
}

function campos() {
    let est = document.getElementById('estado').value;
    est = est.normalize('NFD').replace(/[\u0300-\u036f]/g,"");
    fetch('../Vistas/Archivos/municipios.json')
        .then(response => response.json())  // convertir a json
        .then((json) => {
            var selectElement = document.getElementById('municipio');
            document.getElementById("municipio").innerHTML = "";
            Object.entries(json[est]).forEach(([key, value]) => {
                selectElement.add(new Option(value)) 
            })
        })
        .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}
document.getElementById('estado').addEventListener('change', limpiar);

function limpiar() {
document.getElementById("municipio").innerHTML = "";
campos();
}

function cargarSelects(ruta,elemento) {
    //let est = document.getElementById('estado');
    fetch(ruta)
        .then(response => response.json())  // convertir a json
        .then((json) => {
            Object.keys(json).forEach(element => elemento.add(new Option(element)));
        })
        .catch(err => console.log('Solicitud fallida', err)); // Capturar errores
}