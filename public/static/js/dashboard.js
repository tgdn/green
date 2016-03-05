$(document).ready(function(e) {

    /* different forms */
    $('form#house-settings-form').submit(function(event) {
        var nameInput = $('#name-id');
        var name = $('#name-id').val();

        /* remove class by default */
        nameInput.parent('.form-group').removeClass('has-error');

        if (name == null || name.length == 0) {
            event.preventDefault();

            /* add error */
            nameInput.parent('.form-group').addClass('has-error');
        }
    });

    /* members */

    /* remove confirmation */
    /*$('.house-members-list button[data-action=remove-from-house]').confirmation({
        container: 'body',
        singleton: true,
        popout: true
    });*/

        /*opacity: 1,
		trigger: 'click',
		animation: 'none',
		gravity: 'south',
		confirm: true,
        yes: 'Proceed',
        no: 'Cancel',
        size: 'small',
		onYes: function(){
			alert("This is a custom event for 'Yes' option");
		},
		onNo: function(){
			alert("This is a custom event for 'No' option");
		}
	});*/

});
