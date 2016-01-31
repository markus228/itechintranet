/**
 * Created by markus on 31.01.16.
 */
$(function() {




    $('#example').DataTable( {
        "ajax": "staffSearch/allUsers",
        "columns": [
            { "data": "nachname" },
            { "data": "vorname" },
            { "data": "anschrift" },
            { "data": "telefonDurchwahl" },
            { "data": "telefonPrivat" },
            { "data": "telefonMobil" }
        ]
    } );




});