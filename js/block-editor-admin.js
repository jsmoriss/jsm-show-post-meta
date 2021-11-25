
var isSavingMetaBoxes = wp.data.select( 'core/edit-post' ).isSavingMetaBoxes;
var jsmspmWasSavingMb = false;

wp.data.subscribe( function(){

	var jsmspmIsSavingMb = isSavingMetaBoxes();

	if ( jsmspmWasSavingMb ) {	// Last check was saving post meta.

		if ( ! jsmspmIsSavingMb ) {	// Saving the post meta is done.

			var pluginId      = 'jsmspm';
			var adminPageL10n = 'jsmspmAdminPageL10n';

			sucomBlockPostbox( pluginId, adminPageL10n );
		}
	}

	jsmspmWasSavingMb = jsmspmIsSavingMb;
});
