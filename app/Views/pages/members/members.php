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
                                <?php if (!empty($breadcrumb)) {
                                    foreach($breadcrumb AS $bread):?>
                                        <li><?= $bread ?></li>
                                    <?php endforeach ;
                                } ?>
                            </ul>
                            <!-- /BREADCRUMBS -->
                            <div class="clearfix">
                                <h3 class="content-title pull-left"><?= $title; ?></h3>
                            </div>
                            <div class="description"><?= $subtitle; ?></div>
                        </div>
                    </div>
                </div>
                <!-- /PAGE HEADER -->

                <div class="row">
                    <div class="col-sm-12"> <hr>
                        <div class="box border primary">
                            <div class="box-title">
                                <h4><i class="fa fa-users"></i>Elenco utenti</h4>
                                <div class="tools hidden-xs">
                                    <a href="javascript:;" class="collapse">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="box-body">
                                <table id="tbl_utenti" class="table datatable table-striped table-bordered table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Utente</th>
                                            <th>Sezione</th>
                                            <th>Ruolo</th>
                                            <th>Azioni</th>
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

<script type="text/javascript">
    $(document).ready(function () {
        function setup_dt() {
            $('#tbl_utenti').DataTable({
                "aaSorting": [[0, 'desc']],
                "fnDrawCallback": function (oSettings) {
                    $('.tip').tooltip();
                },
                "ajax": {
                    "url": 'datatables/members',
                    type: "POST",
                    "data": function (d) {
//                            d.id_dealer = $('.find_dealer').val();
//                            d.id_compagnia = $('.find_compagnia').val();
                    }
                },
                "columns": [
                    {data: 0, width: '10px'},
                    {data: 33},
                    {data: 34},
                    {data: 17},
                    {data: 35, width: '10px', orderable: false, className: "canter_button"}
                ]
            });
        }
        LoadDataTables(setup_dt, 'utenti');
    });

</script>