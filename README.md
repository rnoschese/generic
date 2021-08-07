# GENERIC LOGIN (Codeigniter 4)

## CONNESSIONE DB 

HOST: 62.149.181.41\
USERNAME: **_mysql_generic_**\
PASSWORD: **_9eRRA1dAfOzqu8gs_**

## PLUGIN

### SELECT2

#### HTML (view)
```
<select id="select_test" name="test" class="form-control" style="width: 100%"></select>
```
#### jQuery
Utilizzo:\
L'url deve puntare a classe/funzione\
addNew se impostato su true permette di aggiungere option alla select (valore di default false)\
```
$('#select_test').select2Ajax({
    url: '../select2/test',<br>
    placeholder: 'Seleziona / inserisci modulo',<br>
    addNew: true
});
```
#### PHP (app/Controllers/Select2)
___
### DATATABLES

#### HTML (view)
```
<table id="authorizations" class="table datatable table-striped table-bordered table-hover" style="width:100%"> 
    <thead>
        <tr>
            <th>Key</th>
            <th>Modulo</th>
            <th>Oggetto</th>
            <th>Descrizione</th>
        </tr>
    </thead>
</table>
```
### jQuery

```
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
```

### PHP (app/Controllers/Datatables)

___
# TEMPLATE

Il template è gestito dall'helper view_template (app/Helpers/template_helper.php)\

    ```
        public function index() {
          $page = 'dashboard/dashboard'; //controller::view
          $data['title'] = 'Dashboard'; //titolo della pagina 
          $data['description'] = 'Pannello di controllo'; // descrizione della pagina

          $data['data_array'] = $_ENV; // array di dati da passare alla pagina

          view_template($page, $data);
        }
    ```
L'helper view_template, oltre alla visualizzazione della pagina ed ai parametri inviati, gestisce la funzione _get_menu_ (da aggiornare con le pagine che verranno aggiunte) e la funzione _breadcrumb_
___
#### get_menu
La funzione _get_menu_ restituisce un'array che deve essere aggiornata manualmente

```
if (!function_exists('getMenu')) {
    function getMenu($page = 'dashboard')
    {

        $menu = array(
            array(//primo livello
                'nome' => 'Dashboard', //nome della pagina
                'url' => 'dashboard', //url della pagina
                'active' => $page === 'dashboard/dashboard' ? 'active' : '', //attiva pagina nel menu
                'icon' => 'fa-tachometer', //icona del menu
                'sottoMenu' => array()
            ),
            array(
                'nome' => 'Servizio',
                'url' => 'servizio',
                'icon' => 'fas fa-key',
                'sottoMenu' => array(
                    array( //menu di secondo livello
                        'nome' => 'Setup permessi (dev)',
                        'url' => 'authorizations/authorizations_edit',
                        'active' => $page === 'authorizations/authorizations_edit' ? 'active' : ''
                    ),
                    array(
                        'nome' => 'Gestione permessi',
                        'url' => 'authorizations/authorizations_management',
                        'active' => $page === 'authorizations/authorizations_management' ? 'active' : ''
                    ),
                )
            )
        );

        return $menu;
    }
}
```
___