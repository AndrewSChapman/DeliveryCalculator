(function($) {
    window.apiClient = {
        apiUrl: 'http://api.deliverycalculator.local/',

        loadRegions: function(successCallback) {
            $.get(this.apiUrl + 'api/delivery/regions', function(response) {
                successCallback(response.data);
            });
        },

        getDeliveryDate: function(supplierId, regionId, orderDate, successCallback) {
            const endpoint = 'api/delivery/calculate-delivery-date/' + encodeURI(supplierId + '/' + regionId + '/' + orderDate);

            $.get(this.apiUrl + endpoint, function(response) {
                successCallback(response.data.delivery_date);
            });
        }
    };
})(jQuery);