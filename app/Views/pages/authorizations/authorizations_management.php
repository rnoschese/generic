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
                                        <label>Ruolo</label>
                                        <select id="select_ruolo" name="ruolo" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>

                                    <div class="form-group">
                                        <label>Utente</label>
                                        <select id="select_utente" name="utente" class="form-control"
                                                style="width: 100%"></select><br>
                                    </div>

                                    <div class="form-group">
                                        <label>Modulo</label>
                                        <select id="select_modulo" name="modulo" class="form-control"
                                                style="width: 100%"></select><br>
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

        $('#select_ruolo').select2Ajax({
            url: '../select2/ruoli',
            placeholder: 'Seleziona ruolo'
        });

        $('#select_utente').select2Ajax({
            url: '../select2/members',
            placeholder: 'Seleziona utente'
        });

        $('#select_modulo').select2Ajax({
            url: '../select2/moduli',
            placeholder: 'Seleziona modulo'
        });
    });
</script>
