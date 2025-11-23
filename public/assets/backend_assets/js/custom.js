document.addEventListener("DOMContentLoaded", function () {
    // Loading Profile Section Start
    $(document).on("click","#show_profile",function (e) {
        e.preventDefault();
        console.log("Create Admin clicked");

        $.ajax({
            url:"/admin/admin-profile",
            method:"GET",
            success:function(response){
                $("#content").html(response);
            },
            error:function(xhr, status, error){
                console.error('Error loading form:', error);
                alert('Failed to load the Create Product form.');
            }
        });
    });
    // Loading Profile section End

});