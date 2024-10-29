jQuery(function ($) {
    // -------------------------------------------------------------------

    // Extract the ID from the URL
    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id');

    // Only proceed if the ID is present
    if (id) {
        // Get the root domain
        var domain = window.location.protocol + '//' + window.location.hostname;

        // Create the new button
        var livePreviewButton = $('<a/>', {
            class: 'button-primary',
            href: domain + '/?na=view&id=' + id,
            target: '_blank',
            html: '<i class="fas fa-eye"></i>'
        });

        // Append the button to the menu
        $('.tnpb-actions').append(livePreviewButton);
    }

    // -------------------------------------------------------------------
});