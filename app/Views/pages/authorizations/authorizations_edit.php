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
                                        <label>Modulo</label>
                                        <select id="select_modulo" name="modulo" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>

                                    <div class="form-group">
                                        <label>Oggetto</label>
                                        <select id="select_oggetto" name="oggetto" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>
                                    <div class="form-group">
                                        <label>Descrizione</label>
                                        <textarea class="form-control" name="descrizione" rows="3"></textarea>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button id="inviaForm" class="btn btn-primary pull-right">Inserisci</button>
                                        </div>
                                    </div>
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
                                <table id="authorizations" class="table datatable table-striped table-bordered table-hover"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Key</th>
                                        <th>Modulo</th>
                                        <th>Oggetto</th>
                                        <th>Descrizione</th>
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

        $('#select_modulo').select2Ajax({
            url: '../select2/moduli',
            placeholder: 'Seleziona / inserisci modulo',
            addNew: true
        });

        $('#select_oggetto').select2Ajax({
            url: '../select2/oggetto',
            placeholder: 'Seleziona / inserisci oggetto',
            addNew: true
        });

        $('#select_modulo').on('select2:selecting', this, function (e) {
            $(this).val(e.params.args.data.id);
            $('#authorizations').DataTable().draw();
        })

        $('#select_oggetto').on('select2:selecting', this, function (e) {
            $(this).val(e.params.args.data.id);
            $('#authorizations').DataTable().draw();
        })


        $('#select_modulo').on('select2:clearing', this, function (e) {
            $(this).val(null);
            $('#authorizations').DataTable().draw();
        })

        $('#select_oggetto').on('select2:clearing', this, function (e) {
            $(this).val(null);
            $('#authorizations').DataTable().draw();
        })

        function setup_dt() {
            $('#authorizations').DataTable({
                "aaSorting": [[0, 'desc']],
                "fnDrawCallback": function (oSettings) {
                    $('.tip').tooltip();
                },
                "ajax": {
                    "url": '../../datatables/authorizations',
                    "type": "POST",
                    "data": function (d) {
                        d.modulo = $('#select_modulo').val();
                        d.oggetto = $('#select_oggetto').val();
                    }
                },
                "columns": [
                    {data: 0, width: '10px'},
                    {data: 1},
                    {data: 2},
                    {data: 3},
                ]
            });
        }

        LoadDataTables(setup_dt, 'permessi');

        $("#inviaForm").click(function (e) {
            e.preventDefault();
            var dati = $("#formSubmit").serialize();

            $.ajax({
                type: "POST",
                url: "../authorizations/add",
                data: dati,
                dataType: "json",
                success: function (e) {
                    console.log(e);
                    $('#authorizations').DataTable().draw();
                    $('#formSubmit').resetForm();
                }
            });

        });
    });
</script>
