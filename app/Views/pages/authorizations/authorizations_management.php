<div id="main-content">
    <div class="container">
        <div class="row">
            <div id="content" class="col-lg-12">
                <!-- PAGE HEADER-->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header">
                            <!-- STYLER -->

                            <!-- /STYLER -->
                            <!-- BREADCRUMBS -->
                            <ul class="breadcrumb">
                                <li>
                                    <i class="fa fa-home"></i>
                                    <a href="/dashboard">Home</a>
                                </li>
                                <?php foreach ($breadcrumb as $bread): ?>
                                    <li><?= $bread ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <!-- /BREADCRUMBS -->
                            <div class="clearfix">
                                <h3 class="content-title pull-left"><?= $title; ?></h3>
                            </div>
                            <div class="description"><?= $description ?></div>
                        </div>
                    </div>
                </div>
                <!-- /PAGE HEADER -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="box border">
                            <div class="box-title">
                                <h4><i class="fas fa-tools"></i>Filter & insert</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body">

                                <form class="form" id="formSubmit" action="#">
                                    <div class="form-group">
                                        <label>Clona permessi utente</label>
                                        <select id="select_clona" name="clona" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>

                                    <div class="form-group">
                                        <label>Utente</label>
                                        <select id="select_utente" name="utente" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>

                                    <div class="form-group" id="div_modulo">
                                        <label>Modulo</label>
                                        <select id="select_modulo" name="modulo" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>



                                    <input type="text" name="permessi_clona" id="permessi_clona">
                                    <input type="text" name="permessi_utente" id="permessi_utente">
                                    <input type="text" name="permessi_add" id="permessi_add">
                                    <input type="text" name="permessi_merge" id="permessi_merge">
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="box border">
                            <div class="box-title">
                                <h4><i class="fas fa-table"></i>Permessi</h4>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="authorizations"
                                       class="table datatable table-striped table-bordered table-hover"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Modulo</th>
                                        <th>Oggetto</th>
                                        <th>Descrizione</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>


                    </div>
                </div>

            </div><!-- /CONTENT-->
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#select_clona').select2Ajax({
            url: '../select2/members',
            placeholder: 'Seleziona utente da clonare'
        });

        $('#select_clona').on('select2:selecting',this,function(e){
            $(this).val(e.params.args.data.id);
            getPermessi();
        })

        $('#select_clona').on('select2:clearing',this,function(){

            $('#permessi_clona').val('');
            $('#permessi_merge').val('');

            getPermessi();
            $('#authorizations').DataTable().draw();
        })

        $('#select_utente').select2Ajax({
            url: '../select2/members',
            placeholder: 'Seleziona utente'
        });

        $('#select_utente').on('select2:selecting', this, function(e){
            $(this).val(e.params.args.data.id);
            getPermessi();
        })

        $('#select_utente').on('select2:clearing',this,function(){

            $('#permessi_utente').val('');
            $('#permessi_merge').val('');
            getPermessi();
            $('#authorizations').DataTable().draw();
        })

        $('#select_modulo').select2Ajax({
            url: '../select2/moduli',
            placeholder: 'Seleziona modulo'
        });

        $('#select_modulo').on('select2:selecting', this, function(e){
            $(this).val(e.params.args.data.id);
            $('#authorizations').DataTable().draw();
        })

        $('#select_modulo').on('select2:clearing', this, function(){
            $('#authorizations').DataTable().draw();
        })

        function getPermessi(){
            $.ajax({
                type: "POST",
                url: "../authorizations/get_permises_user",
                data: { user_id: $('#select_clona').val() },
                dataType: "json",
                success: function (e) {
                    $('#permessi_clona').val(e);

                    $.ajax({
                        type: "POST",
                        url: "../authorizations/mergeAuth",
                        data: {
                            permessi: $('#permessi_utente').val(),
                            clone: $('#permessi_clona').val()
                        },
                        dataType: "json",
                        success: function (e) {
                            $('#permessi_merge').val(e);
                        }
                    });
                }
            });

            $.ajax({
                type: "POST",
                url: "../authorizations/get_permises_user",
                data: { user_id: $('#select_utente').val() },
                dataType: "json",
                success: function (e) {
                    $('#permessi_utente').val(e);

                    $.ajax({
                        type: "POST",
                        url: "../authorizations/mergeAuth",
                        data: {
                            permessi: $('#permessi_utente').val(),
                            clone: $('#permessi_clona').val()
                        },
                        dataType: "json",
                        success: function (e) {
                            $('#permessi_merge').val(e);
                            update_user();
                            $('#authorizations').DataTable().draw();
                        }
                    });
                }
            });

        }

        function update_user(){
            $.ajax({
                type: "POST",
                url: "../authorizations/update_user",
                data: {
                    permessi: $('#permessi_merge').val(),
                    user_id: $('#select_utente').val()
                },
                dataType: "json"
            });
        }

        function setup_dt() {
            $('#authorizations').DataTable({
                "aaSorting": [[0, 'desc']],
                "fnDrawCallback": function (oSettings) {
                    switchAuth();
                    $('.tip').tooltip();
                    loadScriptByURL({
                        'id': 'switch',
                        'url': '<?= base_url('../js/bootstrap-switch/bootstrap-switch.min.js') ?>',
                        'css': '<?= base_url('../js/bootstrap-switch/bootstrap-switch.min.css') ?>',
                        'callback': function () {
                            $('[data-toggle="switch"]').bootstrapSwitch();
                        }
                    });
                },
                "ajax": {
                    "url": '../../datatables/authorizations',
                    "type": "POST",
                    "data": function (d) {
                        d.modulo = $('#select_modulo').val();
                        d.user_id = $('#select_utente').val();
                        d.permessi = $('#permessi_merge').val();
                    }
                },
                "columns": [
                    {data: 0, width: '10px'},
                    {data: 1},
                    {data: 2},
                    {data: 3},
                    {data: 5}
                ]
            });
        }

        function switchAuth(){
            $('.switchAuth').on('change',this,function(e){
                if($(this).prop('checked')){
                    console.log('selezionato');
                }else{
                    console.log('non selezionato');
                }
            })
        }

        LoadDataTables(setup_dt, 'permessi');

        loadScriptByURL({
            'id': 'switch',
            'url': '<?= base_url('../js/bootstrap-switch/bootstrap-switch.min.js') ?>',
            'css': '<?= base_url('../js/bootstrap-switch/bootstrap-switch.min.css') ?>'
        });

    });
</script>
