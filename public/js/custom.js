function loadCSS(href) {
    'use strict';
    var cssLink = jQuery("<link>");
    jQuery("head").append(cssLink);

    cssLink.attr({
        rel: "stylesheet",
        type: "text/css",
        href: href
    });

}

function loadScriptByURL(settings) {
    const isScriptExist = document.getElementById(settings.id);

    if (!isScriptExist) {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = settings.url;
        script.id = settings.id;
        script.onload = function () {
            loadCSS(settings.css);
            if (settings.callback) {
                if (settings.success) {
                    settings.success.call(this);
                }
                settings.callback();
            }
        };
        document.body.appendChild(script);
    }

    if (isScriptExist && settings.callback) {
        settings.callback();
    }
}

function LoadDataTables(callback, plurali = 'elementi') {
    loadScriptByURL({
        'id': 'datatablesFRA',
        'url': '../js/datatales.1.10.24/datatables.js',
        'css': '../js/datatales.1.10.24/datatables.css',
        'callback': callback,
        'success': function () {
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    "sEmptyTable": "Nessun dato presente nella tabella",
                    "sInfo": "Vista da _START_ a _END_ di _TOTAL_ " + plurali,
                    "sInfoEmpty": "Vista da 0 a 0 di 0 " + plurali,
                    "sInfoFiltered": "(filtrati da _MAX_ " + plurali + " totali)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ",",
                    "sLengthMenu": "Visualizza _MENU_ " + plurali,
                    "sLoadingRecords": "Caricamento...",
                    "sProcessing": "Elaborazione...",
                    "sSearch": "Cerca:",
                    "sZeroRecords": "La ricerca non ha portato alcun risultato.",
                    "oPaginate": {
                        "sFirst": "Inizio",
                        "sPrevious": "Precedente",
                        "sNext": "Successivo",
                        "sLast": "Fine"
                    },
                    "oAria": {
                        "sSortAscending": ": attiva per ordinare la colonna in ordine crescente",
                        "sSortDescending": ": attiva per ordinare la colonna in ordine decrescente"
                    }
                },
                "sDom": "<'row'<'dataTables_header clearfix'<'col-md-4'l><'col-md-8'f>r>>t<'row'<'dataTables_footer clearfix'<'col-md-6'i><'col-md-6'p>>>",
                "processing": true,
                "serverSide": true
            });
        }
    });
}

jQuery.fn.extend({
    select2Ajax: function (data) {
        'use strict';
        var defaults = {
            url: null,
            addNew: false,
            placeholder: null,
            dataDefault: 'null',
            callback: null
        };

        var settings = jQuery.extend({}, defaults, data);

        var $sel = jQuery(this);
        typeof $sel.attr('data-readonly') === 'undefined' ? false : $sel.attr('data-readonly');

        settings.dataDefault = $sel.attr('data-dataDefault') === 'undefined' ? settings.dataDefault : $sel.attr('data-dataDefault');

        $sel.select2({
            placeholder: settings.placeholder,
            allowClear: true,
            theme: "bootstrap",
            language: "it",
            ajax: {
                url: settings.url,
                dataType: 'json',
                data: function (params) {
                    var query = {
                        q: params.term,
                        addNew: settings.addNew
                    };
                    return query;
                },
                processResults: function (data) {

                    return {results: data};
                }
            },

            initSelection: function (element, callback) {

                var data = [];
                if (typeof settings.dataDefault !== "undefined" && settings.dataDefault.length > 0) {
                    return jQuery.getJSON(settings.url + "?dataDefault=" + settings.dataDefault, null, function (data) {

                        var evt = $.Event('select2:selecting',{
                                params:
                                    { args:
                                            { data:
                                                    data[0]
                                            }
                                    }
                            }
                        );
                        element.trigger(evt);
                        settings.callback.call(this, data[0]);
                        callback(data[0]);

                    });
                } else {
                    return callback(data);
                }

            }

        });

        $sel.on('select2:selecting', this, function(e){
            var o = $("<option/>", {value: e.params.args.data.id, text: e.params.args.data.text});

            $sel.append(o);
            $sel.prop('selected',true);
        });

    }
});

jQuery.fn.extend({
    resetForm: function () {
        'use strict';

        var $form = jQuery(this);

        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
        $form.find('select').empty().trigger('change');
    }
});






