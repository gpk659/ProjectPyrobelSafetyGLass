/**
 * Created by Grégory on 20-09-18.
 */

$(document).ready(function(){

  // Setup - add a text input to each footer cell
  $('#office').each(function () {
    var title = $(this).text();
    $(this).html('<input type="text" placeholder="Filtrer ' + title + '" />');
  });

  var tableVol = $('#tableVolToDo').DataTable({
    "language" : {
      "url" : "../JS/French.json"
    },
    "lengthMenu": [50, 100, 200]
  });

  tableVol.columns().every(function () { // Apply the search
          var that = this;
          $('input', this.header()).on('keyup change', function () {
              if (that.search() !== this.value) {
                  that
                  .search(this.value)
                  .draw();
              }
          });
      });

/*------------------------------------------------------ */

    $('#listRack').DataTable( {
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            },
            "lengthMenu": [ 50,100,200 ]
        } );

// Table liste des chutes
    // Setup - add a text input to each footer cell


// Table modifrack
/*------------------------------------------------------------*/

    // DataTable
    var table = $('#modiftable').DataTable({
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        } );
// Table modifrack
/*---------------------------------------------------------------*/
    // DataTable
    var tablemodif = $('#usevoltable').DataTable({
            "language": {
                "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
            }
        } );

// Bouton de retour sur la page UseVol
$('#backUseVol').click(function(){
		history.back();
	});

});
