        <form action="../Controladores/clienteControlador.php" method="POST" class="mainNuevo no-mostrar" id="formulario">
            <section class="cabecera">
                <div class="atras">
                    <span class="material-symbols-sharp flecha-atras" id="pa-tras">arrow_back</span><h1>Nuevo Cliente</h1>
                </div>
                <div >
                    <input class="guardar botones" type="submit" value="GUARDAR" name="guardar">
                </div>
            </section>
            <section class="form-generales">
                <h2 class="titulo-form">Datos generales</h2>
                <div class="form-generales-izquierdo">
                    <input type="hidden" id="id" name="id">
                    <label for="rfc" class="label-form">RFC <span class="asterisco">*</span></label>
                    <input type="text" id="rfc" name="rfc" min="12" maxlength="13" required>

                    <label for="cfdi" class="label-form">Usa CFDI</label>
                    <select name="cfdi" id="cfdi">
                        <option value="" disabled selected> |</option>
                    </select>

                    <label for="estatus" class="label-form">Estatus</label>
                    <select name="estatus" id="estatus" >
                        <option value="0" disabled selected>Activo x</option>
                        <option value="1">Inactivo</option>
                        <option value="2">Baja</option>
                    </select>
                </div>

                <div class="form-generales-derecho">
                    <div class="no-mostrar" id="nombre">
                        <label for="nombreG" class="label-form">Nombre <span class="asterisco">*</span></label>
                        <input type="text" id="nombreG" name="nombreG" required>
                    </div>
                    <div class="no-mostrar" id="paterno">
                        <label for="apellidoP" class="label-form ">Apellido paterno</label>
                        <input type="text" id="apellidoP" name="apellidoP">
                    </div>
                    <div class="no-mostrar" id="materno">
                        <label for="apellidoM" class="label-form">Apellido materno</label>
                        <input type="text" id="apellidoM" name="apellidoM">
                    </div>

                    <div id="nomCom">
                        <label for="nombreComercial" class="label-form">Nombre comercial</label>
                        <input type="text" id="nombreComercial" name="nombreComercial">
                    </div>
                    <div id="razon">
                        <label for="razonSocial" class="label-form">Razón social <span class="asterisco">*</span></label>
                        <input type="text" id="razonSocial" name="razonSocial" required>
                    </div>
                </div>

                <div class="form-izquierdo">
                    <h2>Dirección</h2>
                    <label for="codigoPostal" class="label-form">Código postal</label>
                    <input type="text" id="codigoPostal" name="codigoPostal" value="0">

                    <label for="pais" class="label-form">País</label>
                    <select name="pais" id="pais">
                        <option value="" disabled selected> |</option>
                        <option value="0">México</option>
                    </select>
                    <label for="estado" class="label-form">Estado</label>
                    <select name="estado" id="estado">
                        <option value="" disabled selected> |</option>
                    </select>
                    <label for="municipio" class="label-form">Municipio</label>
                    <select name="municipio" id="municipio">
                        <option value="" disabled selected> |</option>
                    </select>

                    <label for="colonia" class="label-form">Colonia</label>
                    <input type="text" id="colonia" name="colonia">
                    <label for="calle" class="label-form">Calle</label>
                    <input type="text" id="calle" name="calle">
                    <label for="numEstarior" class="label-form">Número exterior</label>
                    <input type="text" id="numEstarior" name="numEstarior" value="0">
                </div>

                <div class="form-derecho">
                    <h2>Datos de contacto</h2>

                    <label for="nombreCompleto" class="label-form">Nombre</label>
                    <input type="text" id="nombreCompleto" name="nombreCompleto">
                    <label for="tel" class="label-form">Teléfono</label>
                    <input type="text" id="tel" name="tel" value="0">
                    <label for="cel" class="label-form">Teléfono móvil</label>
                    <input type="text" id="cel" name="cel" value="0">
                    <label for="email" class="label-form">E-mail</label>
                    <input type="text" id="email" name="email">
                    <label for="observaciones" class="label-form">Observaciones</label>
                    <input type="text" id="observaciones" name="observaciones">
                </div>
            </section>
        </form>