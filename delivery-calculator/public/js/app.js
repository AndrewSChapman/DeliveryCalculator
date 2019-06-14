(function($) {
    const loaderManager = {
        loaderSelector: $('#loader'),

        showLoader: function() {
            this.loaderSelector.show();
        },

        hideLoader: function() {
            this.loaderSelector.hide();
        }
    }

    $(document).ready(function() {
        // Define form and field selectors
        const $form = $('#frmDeliveryCalculator');
        const $regionSelect = $('#regionId');
        const $dateSelect = $('#orderDate');
        const $timeSelect = $('#orderTime');
        const $resultSelect = $('#result');

        // Hide the result area
        $resultSelect.hide();

        // Setup date picker
        $dateSelect.datepicker({ dateFormat: 'yy-mm-dd' });

        // Load the regions from the API
        loaderManager.showLoader();

        apiClient.loadRegions(function(regions) {
            for (let i in regions) {
                let thisRegion = regions[i];

                $regionSelect.append($('<option>', {
                    value: thisRegion.region_id,
                    text: thisRegion.region_name
                }));
            }

            loaderManager.hideLoader();
        });

        // Handle form submit
        $form.on('submit', function(evt) {
            evt.preventDefault();

            loaderManager.showLoader();

            apiClient.getDeliveryDate(
                '23d7ee40-8ba0-471d-a807-fc5c9a98494f',
                $regionSelect.val(),
                $dateSelect.val() + ' ' + $timeSelect.val() + ':00',
                function(delivery_date) {
                    loaderManager.hideLoader();
                    $resultSelect.find('p').html(delivery_date);
                    $resultSelect.show();
                }
            );
        });
    });
})(jQuery);