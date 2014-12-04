$(document).on(
    {
        click: function(evt)
        {
            if (!confirm($(this).data('confirm'))) {
                evt.preventDefault();
            }
        }
    },
    'a[data-confirm]'
);
