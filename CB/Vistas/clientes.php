<?php
    require './includses/header.php';
?>
        <main class="main" id="main">
            <section class="cabecera">
                <h1>Clientes</h1>
                <span class="material-symbols-sharp agregar botones" id="add">add</span>
            </section>
            <section class="tabla">
                <table id="myTable" class="hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre comercial</th>
                            <th>RFC</th>
                            <th>E-mail</th>
                            <th>Teléfono</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </section>
        </main>
    <?php
        require 'altaCliente.php';
    ?>
    </section>
<?php
    require './includses/footer.php';
?>
    