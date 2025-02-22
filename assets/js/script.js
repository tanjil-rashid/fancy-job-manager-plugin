jQuery(document).ready(function ($) {
    $("#job-filter").on("submit", function (e) {
        e.preventDefault();

        let company = $("#filter-company").val();
        let location = $("#filter-location").val();

        $.ajax({
            url: job_ajax.ajax_url,
            type: "POST",
            data: {
                action: "filter_jobs",
                company: company,
                location: location,
            },
            beforeSend: function () {
                $("#job-results").html("<p>Loading...</p>");
            },
            success: function (response) {
                $("#job-results").html(response);
            },
        });
    });
});
