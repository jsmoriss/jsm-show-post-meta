
var jsmspmBlockEditor = ( function(){

	var isSavingMetaBoxes = wp.data.select( 'core/edit-post' ).isSavingMetaBoxes;
	var wasSavingMb       = false;
	var pluginId          = 'jsmspm';
	var adminPageL10n     = 'jsmspmAdminPageL10n';

	return {
		refreshPostbox: function(){						// Called by wp.data.subscribe().

			var isSavingMb = isSavingMetaBoxes();				// Check if we're saving metaboxes.

			if ( wasSavingMb ) {						// Last check was saving metaboxes.

				if ( ! isSavingMb ) {					// Saving metaboxes is done.

					sucomBlockPostbox( pluginId, adminPageL10n );	// Refresh our metabox(es).
				}
			}

			wasSavingMb = isSavingMb;
		},
	}
})();

wp.data.subscribe( jsmspmBlockEditor.refreshPostbox );
