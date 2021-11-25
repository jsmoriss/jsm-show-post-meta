
var isSavingMetaBoxes = wp.data.select( 'core/edit-post' ).isSavingMetaBoxes;
var jsmspmWasSaving   = false;

wp.data.subscribe( function(){

	var pluginId       = 'jsmspm';
	var adminPageL10n  = 'jsmspmAdminPageL10n';
	var jsmspmIsSaving = isSavingMetaBoxes();

	if ( jsmspmWasSaving ) {	// Last check was saving post meta.

		if ( ! jsmspmIsSaving ) {	// Saving the post meta is done.

			sucomBlockPostbox( pluginId, adminPageL10n );
		}
	}

	jsmspmWasSaving = jsmspmIsSaving;
});
