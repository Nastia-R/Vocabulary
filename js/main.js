function deleteWord(id) {
	$.get( "index.php?page=ajax-delete-word", function( data ) {
	  //$( ".result" ).html( data );
	 //alert( data );
	});
}