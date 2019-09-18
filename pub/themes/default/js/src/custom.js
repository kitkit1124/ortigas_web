/**
 * @package		Codifire
 * @version		1.0
 * @author 		Randy Nivales <randynivales@gmail.com>
 * @copyright 	Copyright (c) 2014-2015, Randy Nivales
 * @link		randynivales@gmail.com
 */
$(function() {
	// frame buster
    if( self != top ) { 
        top.location = self.location;
    }

	// tooltip
	$("body").tooltip({ selector: '[tooltip-toggle=tooltip]' });

    // disable caching of ajax content
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
        restore_modal();
    });

});


function restore_modal()
{
	$('.modal-content').empty();

	var html = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title" id="myModalLabel">Loading...</h4></div><div class="modal-body"><div class="text-center"><img src="' + app_url + 'assets/images/loading3.gif" alt="Loading..." /><p>Loading...</p></div></div>';

	$('.modal-content').html(html);
}