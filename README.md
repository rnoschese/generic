# GENERIC LOGIN (Codeigniter 4)

## CONNESSIONE DB 

HOST: 62.149.181.41<br>
USERNAME: **_mysql_generic_**<br>
PASSWORD: **_9eRRA1dAfOzqu8gs_**

## PLUGIN

### SELECT2

#### HTML (view)
```
<select id="select_test" name="test" class="form-control" style="width: 100%"></select>
```
#### jQuery
Utilizzo:
L'url deve puntare a classe/funzione <br>
addNew se impostato su true permette di aggiungere option alla select (valore di default false)
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